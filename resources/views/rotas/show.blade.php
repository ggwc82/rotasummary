<style type="text/css">

h1, h2 {
  font-family: sans-serif;
}

table, th, td {
   border: 1px solid grey;
   border-collapse:collapse;
}

th, td {
  padding: 15px;
  text-align: center;
  font-family: sans-serif;
  font-size: 14px;
}

#tableheader {
  background-color: cyan;
}

#totals {
	font-weight: bold;
	background-color: lightgrey;
}

#rotaview {
  margin-left: 40px;
}

</style>


<div id="rotaview">
	
  <h1>Weekly Staff Shift Rota</h1>

  <h2>Rota ID: {{$rota[0]->rotaid }}</h2>

	<table>
		
    <tr id="tableheader">
			
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

    <tr id="totals">
      
      <td>Total Hours</td>
     
      @foreach ($hoursworked as $totalhours)
      
        <td>{{$totalhours}}</td>
     
      @endforeach
    
    </tr>
 
  </table>

</div>
