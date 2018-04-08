<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = "nivel de estudios";

    protected $fillable = [
        'ID','crmit_name', 'crmit_codigounico'
    ];
}
