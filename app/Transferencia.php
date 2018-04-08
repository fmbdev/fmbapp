<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    protected $table = "transferencia";

    protected $fillable = [
        'id', 'crmit_transferencialinea'
    ];
}
