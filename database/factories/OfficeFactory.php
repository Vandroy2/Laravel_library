<?php

namespace Database\Factories;

/** @var Factory $factory */

use App\Models\City;
use App\Models\Delivery;
use App\Models\Office;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;


$factory->define(Office::class, function (Faker $faker) {

    return [

        'office_number' => $faker->unique( true)->numberBetween(1,50)
    ];

});




