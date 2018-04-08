<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTipoActividad extends Model
{
    protected $table = "sub tipo de actividad";

    protected $fillable = [
        'id', 'Sub tipo de actividad'
    ];
}
