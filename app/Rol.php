<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //protected $table = 'roles';
    protected $table = 'rol_landing';

    protected $fillable = [
        'id', 'RolID', 'Rolidname', 'Landingname', 'Landingurl'
    ];
}
