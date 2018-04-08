<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canales extends Model
{
    protected $table = "canales";

    protected $fillable = [
        'id', 'crmit_codigounico', 'crmit_name', 'crmit_quedefine'
    ];
}
