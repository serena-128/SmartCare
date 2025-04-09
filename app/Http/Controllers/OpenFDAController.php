<?php>

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenFDAController extends Controller
{
    public function fetchDrugInfo($name)
    {
        $response = Http::get("https://api.fda.gov/drug/label.json", [
            'search' => "openfda.generic_name:\"$name\"",
            'limit' => 1,
        ]);

        if ($response->successful() && isset($response['results'][0])) {
            $info = $response['results'][0];
            return view('staff.drug-details', compact('info', 'name'));
        }

        return back()->with('error', 'Drug information not found.');
    }
}
