<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'lastname','is_admin','is_docente','is_estudiante','paralelo_a','paralelo_b','paralelo_c','paralelo_d','ciclo','provider','provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //SCOPE -> Funciones de búsqueda
    public function scopeName($query, $name){
        if($name){
            return $query->where('name','LIKE',"%$name%");
        }
    }
    public function scopeLastname($query, $lastname){
        if($lastname){
            return $query->where('lastname','LIKE',"%$lastname%");
        }
    }
    public function scopeEmail($query, $email){
        if($email){
            return $query->where('email','LIKE',"%$email%");
        }
    }
}
