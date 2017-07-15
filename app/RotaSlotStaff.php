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

    public static function groupShiftDataByStaffId($query)
    {
    	// for each unique staff id
    	$uniqueArray = array_unique($query);
    	var_dump($uniqueArray);

    	// if slot type is shift, then pop [starttime, endtime, workhours]

    	// else if slot type is dayoff, then pop []


    }

}
