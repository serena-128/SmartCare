<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Resident;
use App\Models\MealPlan;
use App\Models\MealPlanEntry;


class DietaryController extends Controller
{
    /**
     * Show the dietary dashboard.
     * If ?resident_id=xx&plan_date=YYYY‑MM‑DD present, load that plan.
     */
    public function index(Request $request)
{
    $residents        = Resident::with('dietaryRestrictions')->get();
    $foodItems        = [];
    $allergyInfo      = null;
    $activeTab        = $request->query('activeTab', 'preferences');
    $selectedResident = $request->query('resident_id');
    $planDate         = $request->query('plan_date', today()->toDateString());

    // Load or initialize the MealPlan (so we can group its entries)
    $meals = [];
    $entriesByCat = [];
    if ($activeTab === 'meal-plan' && $selectedResident) {
        $plan  = MealPlan::firstOrNew([
            'resident_id' => $selectedResident,
            'plan_date'   => $planDate,
        ]);
        $meals = $plan->entries()->get(); // Collection of MealPlanEntry
        $entriesByCat = $meals
            ->groupBy('category')
            ->map->toArray()
            ->toArray();
    }

    // Always default recipes to an array
    $recipes = [];

    return view('dietary.index', [
        'residents'        => $residents,
        'foodItems'        => $foodItems,
        'allergyInfo'      => $allergyInfo,
        'activeTab'        => $activeTab,
        'selectedResident' => $selectedResident,
        'planDate'         => $planDate,
        'meals'            => $meals,
        'entriesByCat'     => $entriesByCat,
        'recipes'          => $recipes,
    ]);
}


    /**
     * Search Spoonacular for ingredients
     */
    public function searchFood(Request $request)
{
    $residents        = Resident::with('dietaryRestrictions')->get();
    $allergyInfo      = null;
    $activeTab        = 'meal-plan';
    $selectedResident = $request->input('resident_id');
    $planDate         = $request->input('plan_date', today()->toDateString());

    // load existing MealPlan entries
    $plan = MealPlan::firstOrNew([
        'resident_id' => $selectedResident,
        'plan_date'   => $planDate,
    ]);
    $meals = $plan->entries()->get();
    $entriesByCat = $meals
        ->groupBy('category')
        ->map->toArray()
        ->toArray();

    // Spoonacular search
    $query   = $request->input('food_item');
    $apiKey  = config('services.spoonacular.key');
    $resp    = Http::get('https://api.spoonacular.com/food/ingredients/search', [
        'query'  => $query,
        'number' => 10,
        'apiKey' => $apiKey,
    ]);
    $foodItems = $resp->successful() ? ($resp->json('results') ?? []) : [];

    // Still default recipes to []
    $recipes = [];

    return view('dietary.index', [
        'residents'        => $residents,
        'foodItems'        => $foodItems,
        'allergyInfo'      => $allergyInfo,
        'activeTab'        => $activeTab,
        'selectedResident' => $selectedResident,
        'planDate'         => $planDate,
        'meals'            => $meals,
        'entriesByCat'     => $entriesByCat,
        'recipes'          => $recipes,
    ]);
}


    /**
     * Lookup an allergy via Wikipedia
     */
    public function searchAllergy(Request $request)
    {
        $residents    = Resident::with('dietaryRestrictions')->get();
        $foodItems    = [];
        $activeTab    = 'allergies';
        $selectedResident = null;
        $planDate     = null;
        $meals        = [];

        $term = trim($request->input('allergy'));
        if (! $term) {
            $allergyInfo = [
                'title'   => '',
                'extract' => 'Please enter an allergy to search.',
                'thumbnail'=>null,
                'url'     => null,
            ];
        } else {
            $resp = Http::get(
              'https://en.wikipedia.org/api/rest_v1/page/summary/'.urlencode($term)
            );

            if (! $resp->successful() ||
                ($resp->json('type') ?? '') ===
                  'https://mediawiki.org/wiki/HyperSwitch/errors/not_found'
            ) {
                $allergyInfo = [
                    'title'   => $term,
                    'extract' => 'No article found.',
                    'thumbnail'=>null,
                    'url'     => null,
                ];
            } else {
                $j = $resp->json();
                $allergyInfo = [
                    'title'     => $j['title'] ?? $term,
                    'extract'   => $j['extract'] ?? 'No summary available.',
                    'thumbnail' => $j['thumbnail']['source'] ?? null,
                    'url'       => $j['content_urls']['desktop']['page'] ?? null,
                ];
            }
        }

        return view('dietary.index', [
  'residents'        => $residents,
  'foodItems'        => $foodItems   ?? [],
  'allergyInfo'      => $allergyInfo,
  'activeTab'        => $activeTab,
  'selectedResident' => $selectedResident,
  'planDate'         => $planDate,
  'meals'            => $meals,
  'recipes'          => $recipes      ?? [],
  'entriesByCat'     => $entriesByCat ?? [],
]);

    }

    /**
     * Persist a resident’s meal plan.
     */
    public function storeMealPlan(Request $request)
    {
        $data = $request->validate([
            'resident_id'    => 'required|exists:resident,id',
            'plan_date'      => 'required|date',
            'meals'          => 'nullable|array',
            'meals.*.name'   => 'required|string',
            'meals.*.qty'    => 'required|integer|min:1',
        ]);

        $plan = MealPlan::updateOrCreate(
            [
              'resident_id'=> $data['resident_id'],
              'plan_date'  => $data['plan_date'],
            ],
            [
              'meals'      => $data['meals'],
              'created_by' => Auth::id(),
              'updated_by' => Auth::id(),
            ]
        );

        return back()
          ->with(['activeTab'=>'meal-plan','selectedResident'=>$data['resident_id'],'planDate'=>$data['plan_date']])
          ->withToast('Meal plan saved!');
    }
    
        /**
     * AJAX: Add a new meal entry (breakfast, lunch, etc.).
     */
    public function addEntry(Request $request)
    {
        $data = $request->validate([
            'resident_id'  => 'required|exists:resident,id',
            'plan_date'    => 'required|date',
            'category'     => 'required|in:breakfast,lunch,dinner,snacks,treats',
            'name'         => 'required|string|max:100',
            'quantity'     => 'required|integer|min:1',
        ]);

        // Get or create that day's plan
        $plan = MealPlan::firstOrCreate([
            'resident_id' => $data['resident_id'],
            'plan_date'   => $data['plan_date'],
        ], [
            'created_by'  => Auth::id(),
            'updated_by'  => Auth::id(),
        ]);

        // Create the entry
        $entry = $plan->entries()->create([
            'category'    => $data['category'],
            'name'        => $data['name'],
            'quantity'    => $data['quantity'],
            'consumed'    => 'none',
        ]);

        return response()->json($entry);
    }

    /**
     * AJAX: Update the “consumed” status on one entry.
     */
    public function updateEntry(Request $request, MealPlanEntry $entry)
    {
        $request->validate([
            'consumed' => 'required|in:none,some,all',
        ]);

        $entry->update([
            'consumed'   => $request->input('consumed'),
            'updated_at' => now(),
        ]);

        return response()->json($entry);
    }

    /**
     * AJAX: Delete one entry.
     */
    public function removeEntry(MealPlanEntry $entry)
    {
        $entry->delete();
        return response()->json(['deleted' => true]);
    }
/**
 * Search Spoonacular for recipes and show them in the "Recipe Search" tab.
 */
public function searchRecipe(Request $request)
{
    $residents        = Resident::with('dietaryRestrictions')->get();
    $allergyInfo      = null;
    $activeTab        = 'recipe-search';
    $selectedResident = $request->input('resident_id');
    $planDate         = $request->input('plan_date', today()->toDateString());
    $meals            = [];

    $query = trim($request->input('recipe', ''));
    $recipes = [];

    if ($query !== '') {
        $apiKey = config('services.spoonacular.key');
        // 1) Get a list of recipes (IDs+titles+images)
        $search = Http::get('https://api.spoonacular.com/recipes/complexSearch', [
            'query'                => $query,
            'number'               => 10,
            'apiKey'               => $apiKey,
        ])->json('results', []);

        // 2) For each, fetch full info
        foreach ($search as $r) {
            $info = Http::get("https://api.spoonacular.com/recipes/{$r['id']}/information", [
                'includeNutrition' => false,
                'apiKey'           => $apiKey,
            ])->json();

            $recipes[] = [
                'id'                   => $r['id'],
                'title'                => $info['title']                ?? $r['title'] ?? '',
                'image'                => $info['image']                ?? $r['image'] ?? '',
                'summary'              => $info['summary']              ?? 'No summary available.',
                'instructions'         => $info['instructions']         ?? 'No instructions available.',
                'extendedIngredients'  => $info['extendedIngredients']  ?? [],
                'dishTypes'            => $info['dishTypes']            ?? [],
                'diets'                => $info['diets']                ?? [],
                'glutenFree'           => $info['glutenFree']           ?? false,
                'vegan'                => $info['vegan']                ?? false,
            ];
        }
    }

    return view('dietary.index', compact(
        'residents','allergyInfo','activeTab',
        'selectedResident','planDate','meals','recipes'
    ));
}
 /**
     * Fetch products from OpenFoodFacts.
     *
     * @param  string  $term      Search term (e.g. "apple")
     * @param  int     $pageSize  Number of results to return
     * @return array              Array of OFF products
     */
    protected function fetchOffProducts(string $term, int $pageSize = 20): array
    {
        $term = trim($term);
        if ($term === '') {
            return [];
        }

        $resp = Http::get('https://world.openfoodfacts.org/cgi/search.pl', [
            'search_terms'  => $term,
            'search_simple' => 1,
            'action'        => 'process',
            'json'          => 1,
            'page_size'     => $pageSize,
        ]);

        if (! $resp->successful()) {
            return [];
        }

        return $resp->json('products', []);
    }

/**
 * Show Food Search using OpenFoodFacts.
 */
public function searchOff(Request $request)
{
    $residents   = Resident::with('dietaryRestrictions')->get();
    $allergyInfo = null;
    $activeTab   = 'food-search';
    $query       = $request->input('food_item', '');

    // pull products from OFF
    $foodItems = $this->fetchOffProducts($query, 30);

    // no meals/recipes here
    return view('dietary.index', [
        'residents'        => $residents,
        'foodItems'        => $foodItems,
        'allergyInfo'      => $allergyInfo,
        'activeTab'        => $activeTab,
        'selectedResident' => null,
        'planDate'         => null,
        'meals'            => [],
        'entriesByCat'     => [],
        'recipes'          => [],
    ]);
}
}  