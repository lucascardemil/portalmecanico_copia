<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationUser extends Model
{
    protected $fillable = [
        'name', 'email'
    ];

    public function vehicles(){
        return $this->hasMany('App\QuotationUserVehicle');
    }

    public function descriptions(){
        return $this->hasMany('App\QuotationUserDescription');
    }
}
