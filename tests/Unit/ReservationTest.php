<?php

namespace Tests\Unit;

use App\Reservation;
use App\Ticket;
use Mockery;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    /** @test */
    function calculating_the_total_cost()
    {
        $tickets = collect([
            (object)['price' => 1200],
            (object)['price' => 1200],
            (object)['price' => 1200],
        ]);

        $reservation = new Reservation($tickets);

        $this->assertEquals(3600, $reservation->totalCost());
    }

    /** @test */
    function retrieving_the_reservations_tickets()
    {
        $tickets = collect([
            (object)['price' => 1200],
            (object)['price' => 1200],
            (object)['price' => 1200],
        ]);

        $reservation = new Reservation($tickets);

        $this->assertEquals($tickets, $reservation->tickets());

    }

    /** @test */
    function reserved_tickets_are_released_when_a_reservation_cancelled()
    {
        $tickets = collect([
//            Mockery::mock(Ticket::class)->shouldReceive('release')->once()->getMock(),
            Mockery::spy(Ticket::class),
            Mockery::spy(Ticket::class),
            Mockery::spy(Ticket::class),
        ]);

        $reservation = new Reservation($tickets);

        $reservation->cancel();

        foreach ($tickets as $ticket) {
            $ticket->shouldHaveReceived('release');
        }
    }
}