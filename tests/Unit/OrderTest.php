<?php

namespace Tests\Unit;

use App\Concert;
use App\Exceptions\NotEnoughTicketsException;
use App\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function tickets_are_released_when_an_order_is_canceled()
    {
        $concert = factory(Concert::class)->create();
        $concert->addTickets(10);
        $order = $concert->orderTickets('jane@example.com', 5);

        $this->assertEquals(5, $concert->ticketsRemaining());

        $order->cancel();
        $this->assertEquals(10, $concert->ticketsRemaining());
        $this->assertNull(Order::find($order->id));
    }
}