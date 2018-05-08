<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $table = "carrera";

    protected $fillable = [
        'ID', 'productnumber', 'crmit_nombremostrarcliente'
    ];

    public function campus()
    {
        return $this->belongsToMany('App\Campus', 'campus_carrera', 'carreraId', 'campusId');
    }

    public function niveles()
    {
        return $this->belongsToMany('App\Nivel', 'carreras_nivel', 'carreraId', 'nivelId');
    }

    public function modalidades()
    {
        return $this->belongsToMany('App\Modalidad', 'carreras_modalidad', 'carreraId', 'nivelId');
    }
}
