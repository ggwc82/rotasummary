<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DisplayDayNumberStaffIdAndShiftTimesTest extends TestCase
{
    /** @test */
    function user_can_view_staff_shift_day_of_a_shop_for_one_week()
    {

        // Arrange
        // Import the data for table 'rota_slot_staff'
        $singleShift = SingleShift::create([
            'rotaid' => 332,
            'daynumber' => 6,
            'staffid' => 3,
            'slottype' => 'shift',
            'starttime' => '19:00:00', //this will need to be converted to time object
            'endtime' => '03:00:00',
            'workhours' => 8.00, // consider saving this as an integer to avoid floating point errors
        ]);

        // Act
        // View the rota staff data

        $this->visit('/rotas/' . $singleShift->rotaid);

        //Assert
        // See the rota staff details
        $this->see(332);
        $this->see(6);
        $this->see(3);
        $this->see('shift');
        $this->see('19:00:00');
        $this->see('03:00:00');
        $this->see(8.00);
    }
}
