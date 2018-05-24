<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calidad extends Model
{
    protected $table = 'calidad';

    protected $fillable = [
        'crmit_empresaescuela', 'crmit_calidadidname'
    ];
}
