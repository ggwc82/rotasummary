<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RotaSlotStaff extends Model
{
    
    protected $table = 'rota_slot_staff';

    public static function sortStaffIdByAscendingOrder($query)
    {
    	return $query->sortBy(function($record) {
   			return sprintf('%-12s%s', $record->staffid, $record->daynumber);
		});
    }


}
