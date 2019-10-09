<?php

use Faker\Generator as Faker;

$factory->define(App\Materia::class, function (Faker $faker) {
    return [
        'usuario_id' => 1,
        'name' => 'Desarrollo de software',
        'ciclo' => 'Primero',
        'paralelo' => 'A',
    ];
});
