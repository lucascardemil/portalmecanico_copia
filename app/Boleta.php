<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    protected $guarded = ['id', 'fecha', 'ruta', 'created_at', 'updated_at'];
}
