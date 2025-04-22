<table>
    <thead>
        <tr>
            <th>Resident</th>
            <th>Medication</th>
            <th>Last Missed</th>
            <th>Total Missed</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($missed as $residentId => $meds)
            @php $resident = $meds->first()->resident; @endphp
            @foreach ($meds->groupBy('medication_name') as $medName => $group)
                <tr>
                    <td>{{ $resident->full_name ?? 'Unknown' }}</td>
                    <td>{{ $medName }}</td>
                    <td>{{ \Carbon\Carbon::parse($group->max('scheduled_time'))->toDateTimeString() }}</td>
                    <td>{{ $group->count() }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
