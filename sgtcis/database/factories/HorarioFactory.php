<?php

use Faker\Generator as Faker;

$factory->define(App\Horario::class, function (Faker $faker) {
    return [
        'usuario_id' => 2,
        'dia1_op1' => 'Lunes en la mañana',
        'hora_inicio_op1' => '7',
        'minutos_inicio_op1' => '30',
        'hora_fin_op1' => '9',
        'minutos_fin_op1' => '30',
        'cont_dia'=>'1',
        'cont_tarde'=>'0'
    ];
});
