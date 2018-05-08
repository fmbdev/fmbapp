<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampusCarrera extends Model
{
    protected $table = 'campus_carrera';

    protected $fillable = [
        'campusId', 'carreraId'
    ];
}
