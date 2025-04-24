<!DOCTYPE html>
<html>
<head>
    <title>Medical History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Medical History for Resident: {{ $resident->firstname }} {{ $resident->lastname }}</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Description</th>
                <th>Diagnosed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicalHistories as $entry)
                <tr>
                    <td>{{ $entry->title }}</td>
                    <td>{{ $entry->type }}</td>
                    <td>{{ $entry->description }}</td>
                    <td>{{ \Carbon\Carbon::parse($entry->diagnosed_at)->format('M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
