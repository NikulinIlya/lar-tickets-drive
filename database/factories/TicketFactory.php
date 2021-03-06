<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Ticket::class, function (Faker $faker) {
    return [
        'concert_id' => function () {
            return factory(App\Concert::class)->create()->id;
        }

    ];
});

$factory->state(App\Ticket::class, 'reserved', function ($faker) {
    return [
        'reserved_at' => Carbon::now(),
    ];
});