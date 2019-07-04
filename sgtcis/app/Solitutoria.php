<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solitutoria extends Model
{
    protected $table='solitutorias'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dia','hora_inicio','minutos_inicio','hora_fin','minutos_fin','materia_id','docente_id','estudiante_id','fecha_solicita','fecha_confirma','fecha_tutoria','fecha_evalua'
    ];
}
