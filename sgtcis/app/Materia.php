<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Materia extends Model
{
    //use Notifiable;

    protected $table='materias'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','ciclo','usuario_id','paralelo_a','paralelo_b','paralelo_c','paralelo_d'
    ];
}
