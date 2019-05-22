<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario4 extends Model
{
    protected $table='horario4s'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hora_inicio_op1','minutos_inicio_op1','hora_fin_op1','minutos_fin_op1','hora_inicio_op2','minutos_inicio_op2','hora_fin_op2','minutos_fin_op2','hora_inicio_op3','minutos_inicio_op3','hora_fin_op3','minutos_fin_op3'
    ];
}
