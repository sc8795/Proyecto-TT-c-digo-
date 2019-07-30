<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitacionestudiante extends Model
{
    protected $table='invitacionestudiantes'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_invita_id','user_invitado_id','solitutoria_id','fecha_invita'
    ];
}
