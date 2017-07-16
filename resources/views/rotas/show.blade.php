<h1>Rota ID: {{$rota[0]->rotaid }}</h1>

<table style="width:100%; text-align: center">
	<tr>
		<th>Staff ID</th>
		
		@foreach($days as $day)
			<th>Day {{$day}}</th>
		@endforeach
	</tr>

	@foreach ($staffids as $staffid)
	<tr>
	<td>{{ $staffid->staffid }}</td>
		@foreach ($rota as $record)
			@if ($record->staffid == $staffid->staffid)
				<td>{{ $record->starttime }} - {{ $record->endtime }}</td>
			@endif

		@endforeach
	</tr>
	@endforeach


	<tr>
		<td>Total Hours</td>
		@foreach ($hoursworked as $totalhours)
			<td>{{$totalhours}}</td>
		@endforeach
	</tr>
</table>


