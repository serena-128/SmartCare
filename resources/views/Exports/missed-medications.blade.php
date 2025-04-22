@if ($missed->isEmpty())
    <p>No missed medications to report.</p>
@else
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Resident</th>
                <th>Medication</th>
                <th>Last Missed</th>
                <th>Total Missed</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach ($missed as $residentId => $medications)
                @php
                    $residentName = $medications->first()->resident->full_name ?? 'Unknown';
                    $residentTotal = 0;
                @endphp

                @foreach ($medications->groupBy('medication_name') as $medName => $group)
                    @php $count = $group->count(); $residentTotal += $count; @endphp
                    <tr>
                        <td>{{ $residentName }}</td>
                        <td>{{ $medName }}</td>
                        <td>{{ \Carbon\Carbon::parse($group->max('scheduled_time'))->toDateTimeString() }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach

                <tr style="font-weight: bold; background-color: #f0f0f0;">
                    <td colspan="3" align="right">Subtotal for {{ $residentName }}:</td>
                    <td>{{ $residentTotal }}</td>
                </tr>

                @php $grandTotal += $residentTotal; @endphp
            @endforeach

            <tr style="font-weight: bold; background-color: #dcdcdc;">
                <td colspan="3" align="right">Grand Total:</td>
                <td>{{ $grandTotal }}</td>
            </tr>
        </tbody>
    </table>
@endif
