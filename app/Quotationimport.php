<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotationimport extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function import()
    {
        return $this->belongsTo('App\Import');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
