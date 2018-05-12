<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadAgenda extends Model
{
    protected $table = 'actividad_agenda';

    protected $fillable = [
        'id', 'crmit_actividadid', 'crmit_actividadname'
    ];
}
