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
    public function scopeParalelo_a($query, $paralelo){
        if($paralelo){
            return $query->where('paralelo_a','LIKE',"%$paralelo%");
        }
    }
    public function scopeParalelo_b($query, $paralelo){
        if($paralelo=="B"){
            return $query->where('paralelo_b','LIKE',"%$paralelo%");
        }
    }
    public function scopeParalelo_c($query, $paralelo){
        if($paralelo=="C"){
            return $query->where('paralelo_c','LIKE',"%$paralelo%");
        }
    }
    public function scopeParalelo_d($query, $paralelo){
        if($paralelo=="D"){
            return $query->where('paralelo_d','LIKE',"%$paralelo%");
        }
    }
}
