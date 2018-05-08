<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    protected $table = "modalidad";

    protected $fillable = [
        "crmit_codigounico", "crmit_name"
    ];

    public function Carreras()
    {
        return $this->belongsToMany('App\Carrera');
    }
}
