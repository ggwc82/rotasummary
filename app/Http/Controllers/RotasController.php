<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RotaSlotStaff;

class RotasController extends Controller
{
    public function show($rotaid)

    {	

    	$rota = RotaSlotStaff::where('rotaid', intval($rotaid))->get();


    	return view('rotas.show', ['rota' => $rota ]);
    }
}
