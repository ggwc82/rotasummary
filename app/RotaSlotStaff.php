<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RotaSlotStaff extends Model
{
    
    protected $table = 'rota_slot_staff';

    public static function sortDayByAscendingOrder($query)
    {
    	return $query->sortBy('daynumber');
    }
}
