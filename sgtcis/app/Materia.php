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
        'name','ciclo','usuario_id','paralelo'
    ];

    /* Funciones para la búsqueda de materia */
    public function scopeName($query, $name){
        if($name){
            return $query->where('name','LIKE',"%$name%");
        }
    }
    public function scopeCiclo($query, $ciclo){
        if($ciclo){
            return $query->where('ciclo','LIKE',"%$ciclo%");
        }
    }
}
