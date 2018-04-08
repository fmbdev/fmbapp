<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EscuelaEmpresa extends Model
{
    protected $table = "escuela-empresa";

    protected $fillable = [
        'id', 'crmit_claveescuelaempresacrm', 'TerritoryId', 'Name', 'crmit_calidadid', 'crmit_descturno1', 'crmit_descturno2', 'crmit_descturno3'
    ];
}
