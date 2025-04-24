<?php

namespace App\Http\Controllers;

use App\Models\MedicalHistory;
use Illuminate\Http\Request;
use App\Models\Resident;
use TCPDF;

class MedicalHistoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'diagnosed_at' => 'nullable|date',
            'source' => 'nullable|string|max:255',
            'visibility' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        MedicalHistory::create([
            ...$request->all(),
            'added_by' => auth('staff')->id(), // make sure you have a staff auth guard
        ]);

        return back()->with('success', 'Medical history added.');
    }

    public function index($residentId)
    {
        $histories = \App\Models\MedicalHistory::where('resident_id', $residentId)->latest()->get();
        return view('medical_history.index', compact('histories', 'residentId'));
    }
    
 public function overview(Request $request)
{
    $type = $request->query('type');
    $search = $request->query('search');
    $from = $request->query('from');
    $to = $request->query('to');

    // Fetch all residents that have medical histories within the date range
    $residents = Resident::whereHas('medicalHistories', function ($query) use ($type, $from, $to) {
        // Apply filters to medical histories if provided
        if ($type) {
            $query->where('type', $type);
        }
        if ($from) {
            $query->whereDate('diagnosed_at', '>=', $from);
        }
        if ($to) {
            $query->whereDate('diagnosed_at', '<=', $to);
        }
        // Only consider medical histories with relevant date range
    })
    ->with(['medicalHistories' => function ($query) use ($type, $from, $to) {
        // Apply filters to medical histories if provided
        if ($type) {
            $query->where('type', $type);
        }
        if ($from) {
            $query->whereDate('diagnosed_at', '>=', $from);
        }
        if ($to) {
            $query->whereDate('diagnosed_at', '<=', $to);
        }
        // Order medical histories by diagnosed date descending to get the most recent one
        $query->orderByDesc('diagnosed_at');
    }])
    ->when($search, function ($query, $search) {
        // Apply search filter by resident name
        $query->where(function ($q) use ($search) {
            $q->where('firstname', 'like', "%$search%")
              ->orWhere('lastname', 'like', "%$search%");
        });
    })
    ->get();

    return view('medical_history.overview', compact('residents', 'type', 'search', 'from', 'to'));
}


    public function timeline($id)
{
    $resident = Resident::with(['medicalHistories' => function($q) {
        $q->orderBy('diagnosed_at', 'desc');
    }])->findOrFail($id);

    return view('medical_history.timeline', compact('resident'));
}
public function exportPdf($residentId)
{
    // Fetch the medical histories for the resident
    $medicalHistories = MedicalHistory::where('resident_id', $residentId)->get();
    $resident = Resident::findOrFail($residentId); // Fetch resident details

    // Fetch the full name of the resident
    $residentFullName = $resident->firstname . ' ' . $resident->lastname;

    // Prepare the HTML content for the PDF
    ob_start();

    // Start the HTML content with a title
    echo '<h1 style="text-align: center;">Medical History of ' . $residentFullName . '</h1>';

    // Adding some styling to the table
    echo '<style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            table, th, td {
                border: 1px solid black;
            }
            th, td {
                padding: 10px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            .divider {
                border-top: 2px solid #000;
                margin-top: 20px;
                margin-bottom: 20px;
            }
        </style>';

    // Table Header
    echo '<table>';
    echo '<thead>';
    echo '<tr><th>Title</th><th>Type</th><th>Description</th><th>Diagnosed At</th></tr>';
    echo '</thead>';
    echo '<tbody>';

    // Loop through the medical histories and populate the table
    foreach ($medicalHistories as $index => $entry) {
        echo '<tr>';
        echo '<td>' . $entry->title . '</td>';
        echo '<td>' . $entry->type . '</td>';
        echo '<td>' . $entry->description . '</td>';
        echo '<td>' . \Carbon\Carbon::parse($entry->diagnosed_at)->format('M Y') . '</td>';
        echo '</tr>';

        // Add a divider after each medical history entry
        if ($index < count($medicalHistories) - 1) {
            echo '<tr><td colspan="4" class="divider"></td></tr>';
        }
    }

    // Close table tags
    echo '</tbody>';
    echo '</table>';

    // Get the HTML content
    $htmlContent = ob_get_clean();

    // Use TCPDF to generate the PDF
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->writeHTML($htmlContent);  // Write the HTML content as PDF

    // Set the filename dynamically based on the resident's full name
    $pdfFilename = 'medical_history_' . $residentFullName . '.pdf';

    // Output the PDF to the browser for download
    $pdfOutput = $pdf->Output($pdfFilename, 'S'); // 'S' means output as a string

    // Return the PDF file as a download with the resident's name in the filename
    return response($pdfOutput, 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="' . $pdfFilename . '"');
}



}
