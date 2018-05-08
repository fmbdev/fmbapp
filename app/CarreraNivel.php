<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarreraNivel extends Model
{
    protected $table = 'carreras_nivel';

    protected $fillable = [
        'carreraId', 'nivelId'
    ];
}
