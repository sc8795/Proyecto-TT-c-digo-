<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table='evaluacions'; 

    protected $fillable = [
        'user_evaluado_id','evaluacion'
    ];
}
