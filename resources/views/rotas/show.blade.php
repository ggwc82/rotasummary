<h1>Rota ID: {{$rota[0]->rotaid }}</h1>

<table style="width:100%; text-align: center">
	<tr>
		<th>Day Number</th>
		<th>Staff ID</th>
		<th>Slot Type</th>
		<th>Start Time</th>
		<th>End Time</th>
		<th>Work Hours</th>
	</tr>

	@foreach ($rota as $record)

	<tr>
		<td>{{ $record->daynumber }}</td>
		<td>{{ $record->staffid }}</td>
		<td>{{ $record->slottype }}</td>
		<td>{{ $record->starttime }}</td>
		<td>{{ $record->endtime }}</td>
		<td>{{ number_format($record->workhours, 2) }}</td>

	</tr>

	@endforeach

</table>