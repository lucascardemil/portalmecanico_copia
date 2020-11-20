<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationUserVehicle extends Model
{
    protected $fillable = [
        'user_id',
        'patentchasis',
        'brand',
        'model',
        'year',
        'engine'
    ];

    public function user(){
        return $this->hasOne('App\QuotationUser');
    }

    public function descriptions(){
        return $this->hasMany('App\QuotationUserDescription');
    }
}
