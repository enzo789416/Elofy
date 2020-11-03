<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\People;
use Faker\Generator as Faker;

$factory->define(People::class, function (Faker $faker) {
    $boolean = rand(0, 1);
    $height = "1.90";
    $weith = "70.5";
    return [
        'name'=>$faker->name,
        'height'=>$height,
        'lactose'=>$boolean,
        'weight'=>$weith,
        'athlete'=>$boolean
    ];
});
