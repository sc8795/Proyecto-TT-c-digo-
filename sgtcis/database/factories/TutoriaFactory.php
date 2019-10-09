<?php

use Faker\Generator as Faker;

$factory->define(App\Solitutoria::class, function (Faker $faker) {
    return [
        'dia'=>'Lunes en la mañana',
        'hora_inicio'=>'7',
        'minutos_inicio'=>'30',
        'hora_fin'=>'9',
        'minutos_fin'=>'30',
        'materia_id'=>1,
        'docente_id'=>1,
        'estudiante_id'=>1,
        'modalidad'=>'presencial',
        'tipo'=>'individual',
        'motivo'=>'Dudas sobre la clase recibida',
        'fecha_solicita'=>now(),
    ];
});
