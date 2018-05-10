<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubSubTipoActividad extends Model
{
    protected $table = 'subysubsubtipo';
    //protected $table = 'subsubtipo_actividad';

    protected $fillable = [
        'id', 'crmit_subsubname', 'crmit_subtipoactividadid', 'crmit_codigounico', 'crmit_subname'
    ];
}
