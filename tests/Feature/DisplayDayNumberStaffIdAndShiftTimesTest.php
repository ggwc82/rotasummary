<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\RotaSlotStaff;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DisplayDayNumberStaffIdAndShiftTimesTest extends TestCase
{   
    use DatabaseMigrations;

    /** @test */
    function user_can_view_staff_shift_day_of_a_shop_for_one_week()
    {

        // Arrange
        $rota = RotaSlotStaff::where([
            'daynumber' => 6,
            'staffid' => 3,
        ])->first();

        // Act
        // View the rota staff data

        $response = $this->get('/rotas/' . $rota->rotaid);

        $response->assertStatus(200);
        //Assert
        // See the rota staff details
        $response->assertSee('332');
        $response->assertSee('6');
        $response->assertSee('3');
        $response->assertSee('shift');
        $response->assertSee('19:00:00');
        $response->assertSee('03:00:00');
        $response->assertSee('8.00');
    }


}
