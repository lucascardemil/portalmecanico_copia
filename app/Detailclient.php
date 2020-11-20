<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailclient extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function quotationclient()
    {
        return $this->belongsTo('App\Quotationclient');
    }
}
