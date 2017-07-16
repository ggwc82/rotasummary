<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RotaSlotStaff;

class RotasController extends Controller
{
    public function show($rotaid)

    {	
    	// stage 1 -  filter by single rota id
    	$rota = RotaSlotStaff::where(
    		['rotaid' => intval($rotaid),]
    	)->whereNotNull('staffid')->get();

    	
    	// stage 2 - sort by staff id
    	$rota = RotaSlotStaff::sortStaffIdByAscendingOrder($rota);

    	$daysCount = [0, 1, 2, 3, 4, 5, 6];


    	$uniqueStaffIds = RotaSlotStaff::whereNotNull('staffid')->distinct()->get(['staffid']);
    	

    	// $rota = RotaSlotStaff::groupShiftDataByStaffId($rota);
    	
    	return view('rotas.show', ['rota' => $rota, 'days' => $daysCount, 'staffids' => $uniqueStaffIds]);
    }
}
