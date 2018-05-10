<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Csq extends Model
{
    protected $table = "csq";

    protected $fillable = [
        'crmit_csq', 'crmit_name', 'canalId'
    ];
}
