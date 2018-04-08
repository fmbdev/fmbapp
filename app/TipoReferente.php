<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoReferente extends Model
{
    protected $table = "tipo de referente";

    protected $fillable = [
        'id', 'Tipo de Referente'
    ];
}
