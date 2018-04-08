<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PalabrasBasura extends Model
{
    protected $table = "palabras basura";

    protected $fillable = [
        'id', 'crmit_codigounico', 'crmit_name', 'crmit_quedefine'
    ];
}
