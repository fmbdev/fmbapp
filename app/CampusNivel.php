<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampusNivel extends Model
{
    protected $table = 'campus_nivel';

    protected $fillable = [
        'id', 'carrera_codigounico', 'nivelestudios_crmit_codigounico', 'modalidad_crmit_codigounico', 'campus_crmit_codigounico'
    ];
}
