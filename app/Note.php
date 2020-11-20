<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
