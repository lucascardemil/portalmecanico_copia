<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationUserDescription extends Model
{
    protected $fillable =[
        'user_id',
        'vehicle_id',
        'description',
        'is_completed',
        'email'
    ];

    public function user(){
        return $this->hasOne('App\QuotationUser');
    }

    public function vehicle(){
        return $this->hasOne('App\QuotationUserVehicle');
    }
}
