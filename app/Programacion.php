<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    protected $table = "programacion";

    protected $fillable = [
        'id', 'crmit_programacionllamada'
    ];
}
