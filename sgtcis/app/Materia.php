<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Materia extends Model
{
    protected $table='materias'; 
    /* se indican los campos de la tabla materias para
    que el controlador pueda hacer uso de ellos (buscarlos,
    actualizarlos o eliminarlos) */
    protected $fillable = [
        'usuario_id','name','ciclo','paralelo'
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
