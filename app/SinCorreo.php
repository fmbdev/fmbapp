<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SinCorreo extends Model
{
    protected $table = "sin correo";

    protected $fillable = [
        'id', 'crmit_sincorreo'
    ];
}
