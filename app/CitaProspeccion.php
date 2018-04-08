<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CitaProspeccion extends Model
{
    protected $table = "cita de prospección";

    protected $fillable = [
        'id', 'RegardingObjectId', 'crmit_fechacierre', 'ScheduledStar', 'ScheduledEnd', 'crmit_nocita', 'Subject', 'statuscode'
    ];
}
