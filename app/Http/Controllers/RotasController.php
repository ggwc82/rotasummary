<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RotaSlotStaff;

class RotasController extends Controller
{
    public function show($rotaid)

    {	

    	$rota = RotaSlotStaff::where(
    		[
    		'rotaid' => intval($rotaid),
    		// 'slottype' => 'shift',
    		]
    	)->whereNotNull('staffid')->get();

    	$rota = RotaSlotStaff::sortStaffIdByAscendingOrder($rota);

    	$rota = RotaSlotStaff::groupShiftDataByStaffId($rota);
    	
    	return view('rotas.show', ['rota' => $rota ]);
    }
}
