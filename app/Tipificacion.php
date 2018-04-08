<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipificacion extends Model
{
    protected $table = "tipificación";

    protected $fillable = [
        'id', 'Tipificación'
    ];
}
