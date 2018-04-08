<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pnn extends Model
{
    protected $table = "pnn_publico";

    protected $fillable = [
        "clave_censal", "poblacion", "municipio", "estado", "presuscripcion", "region",
        "asl", "nir", "serie", "numeracion_inicial", "numeracion_final",
        "ocupacion", "tipo_red", "modalidad", "razon_social", "fecha_asignacion",
        "fecha_consolidacion", "fecha_migracion", "nir_aterior", "_serie"
    ];
}
