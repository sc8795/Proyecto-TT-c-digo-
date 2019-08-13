<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arrastre extends Model
{
    protected $table='arrastres'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_estudiante_id','materia','paralelo','docente'
    ];
}
