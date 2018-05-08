<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarreraModalidad extends Model
{
    protected $table = 'carreras_modalidad';

    protected $fillable = [
        'carreraId', 'modalidadId'
    ];
}
