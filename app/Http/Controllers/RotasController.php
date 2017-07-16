<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\RotaSlotStaff;

class RotasController extends Controller
{
    public function show($rotaid)

    {	
    	// stage 1 -  filter by single rota id
    	$rota = RotaSlotStaff::where(
    		['rotaid' => intval($rotaid),]
    	)->whereNotNull('staffid')->get();

    	
    	// stage 2 - sort rota by staff id
    	$rota = RotaSlotStaff::sortStaffIdByAscendingOrder($rota);


    	// stage 3 - find unique staff ids
    	$uniqueStaffIds = RotaSlotStaff::whereNotNull('staffid')->distinct()->get(['staffid']);


    	$daysCount = [0, 1, 2, 3, 4, 5, 6];

    	//stage 4 - build array of total hours worked per day
    	$hoursWorked = [];

    	foreach($daysCount as $day) {
    		$sumHoursForDay = RotaSlotStaff::whereNotNull('staffid')->where('daynumber', $day)->sum('workhours');
    		$hoursWorked[] = number_format($sumHoursForDay, 2);
    	}
    

    	return view('rotas.show', ['rota' => $rota, 'days' => $daysCount, 'staffids' => $uniqueStaffIds, 'hoursworked' => $hoursWorked]);
    }
}
