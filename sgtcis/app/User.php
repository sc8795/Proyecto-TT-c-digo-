<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /*
    |protected              ===> se puede acceder al atributo o método desde la clase que lo define y desde cualquier otra 
    |                            que herede de esta.
    |$fillable              ===> propiedad que se usa para asignamiento de datos en masa 
    |protected $fillable=[] ===> especifica los datos que se guardarán, modificarán y eliminarán en la base de datos
    */
    protected $fillable = [
        'name', 'email', 'password', 'lastname','is_admin','is_docente',
        'is_estudiante','paralelo','ciclo','provider','provider_id'
    ];

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
