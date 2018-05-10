<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    protected $table = "asesor cita";

    protected $fillable = [
        'asesorid','Nombre_Asesor'
    ];
}
