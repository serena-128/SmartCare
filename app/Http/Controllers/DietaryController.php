<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Resident;
use App\Models\MealPlan;
use App\Models\MealPlanEntry;
use App\Models\StaffMember;



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
        'resident_id' => 'required|exists:resident,id',
        'plan_date'   => 'required|date',
        'category'    => 'required|in:breakfast,lunch,dinner,snacks,treats',
        'meals'       => 'required|string',
        'time'        => 'nullable|date_format:H:i',
        'quantity'    => 'nullable|integer|min:1',
    ]);

    // ✅ Get the staff member ID from session
    $staffId = session('staff_id');

    if (!$staffId) {
        return response()->json(['error' => 'Not logged in as staff.'], 401);
    }

    $plan = MealPlan::create([
        'resident_id' => $data['resident_id'],
        'plan_date'   => $data['plan_date'],
        'category'    => $data['category'],
        'meals'       => $data['meals'],
        'time'        => $data['time'] ?? null,
        'quantity'    => $data['quantity'] ?? null,
        'created_by'  => $staffId,  // 👈 uses the session
    ]);

    return response()->json($plan, 201);
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
    public function edit($id)
{
    $meal = \App\Models\MealPlan::findOrFail($id);
    $residents = \App\Models\Resident::with('dietaryRestrictions')->get();

    return view('dietary.index', [
        'residents'        => $residents,
        'activeTab'        => 'meal-plan',
        'selectedResident' => $meal->resident_id,
        'planDate'         => $meal->plan_date,
        'editMeal'         => $meal, // 👈 used in view to trigger edit modal
        'meals'            => [],
        'entriesByCat'     => [],
        'recipes'          => [],
        'foodItems'        => [],
        'allergyInfo'      => null,
    ]);
}
public function update(Request $request, $id)
{
    $meal = MealPlan::findOrFail($id);

    $data = $request->validate([
        'category'  => 'required|in:breakfast,lunch,dinner,snacks,treats',
        'meals'     => 'required|string',
        'time'      => 'nullable|date_format:H:i',
        'quantity'  => 'nullable|integer|min:1',
    ]);

    // Get the staff member ID from session
    $staffId = session('staff_id');
    if (!$staffId) {
        return response()->json(['error' => 'Not logged in as staff.'], 401);
    }

    $data['updated_by'] = $staffId;

    $meal->update($data);

    return response()->json(['message' => 'Meal updated successfully']);
}


    /**
     * AJAX: Delete one entry.
     */
public function destroy($id)
{
    $meal = MealPlan::findOrFail($id);
    $meal->delete();

    return response()->json(['message' => 'Meal deleted successfully']);
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
    $resp = Http::get('https://world.openfoodfacts.org/cgi/search.pl', [
        'search_terms'  => $term,
        'search_simple' => 1,
        'action'        => 'process',
        'json'          => 1,
        'page_size'     => $pageSize,
        // ask OFF to also send these fields:
        'fields'        => 'code,product_name,brands,quantity,generic_name,ingredients_text,image_front_small_url,nutriments'
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
public function calendarEvents(Request $request)
{
    $residentId = $request->query('resident_id');

    if (!$residentId) {
        return response()->json([]);
    }

    $entries = \App\Models\MealPlan::where('resident_id', $residentId)->get();

    return $entries->map(function ($plan) {
        return [
            'id'       => $plan->id,
            'title'    => ucfirst($plan->category) . ': ' . $plan->meals,
            'start'    => $plan->plan_date,
            'allDay'   => true,
            'category' => $plan->category, // for color/icon logic
            'extendedProps' => [
                'meals'    => $plan->meals,
                'time'     => $plan->time,
                'quantity' => $plan->quantity,
                'createdBy'=> $plan->created_by,
            ],
        ];
    });
}

public function historyCalendar(Request $request)
{
    $residentId = $request->query('resident_id');

    if (!$residentId) {
        return response()->json([]);
    }

    $entries = \App\Models\MealPlan::where('resident_id', $residentId)
        ->whereDate('plan_date', '<=', now()->toDateString())
        ->get();

    return $entries->map(function ($plan) {
        return [
            'id'       => $plan->id,
            'title'    => ucfirst($plan->category) . ': ' . $plan->meals,
            'start'    => $plan->plan_date,
            'allDay'   => true,
            'category' => $plan->category,
            'extendedProps' => [
                'category' => $plan->category
            ]
        ];
    });
}
public function storeMealHistory(Request $request, $mealPlanId)
{
    $validated = $request->validate([
        'resident_id' => 'required|exists:resident,id',
        'consumed'    => 'required|in:none,some,all',
        'notes'       => 'nullable|string',
        'time'        => 'nullable'
    ]);

    \App\Models\MealPlanEntry::updateOrCreate(
        [
            'meal_plan_id' => $mealPlanId,
            'resident_id'  => $validated['resident_id'],
            'time'         => $validated['time']
        ],
        [
            'consumed' => $validated['consumed'],
            'notes'    => $validated['notes']
        ]
    );

    return response()->json(['status' => 'success']);
}

public function updatePreferences(Request $request)
{
    $request->validate([
        'resident_id' => 'required|exists:resident,id',
        'allergies' => 'nullable|string',
        'foodrestrictions' => 'nullable|string',
        'foodpreferences' => 'nullable|string',
        'notes' => 'nullable|string',
    ]);

    $resident = Resident::findOrFail($request->resident_id);

    // Update allergies in resident table
    $resident->update([
        'allergies' => $request->allergies,
    ]);

    // Update or create dietary restriction
    $resident->dietaryRestrictions()->updateOrCreate(
        ['residentid' => $resident->id],
        [
            'foodrestrictions' => $request->foodrestrictions,
            'foodpreferences' => $request->foodpreferences,
            'notes' => $request->notes,
        ]
    );

    return back()->with('success', 'Resident preferences updated successfully.');
}

}  