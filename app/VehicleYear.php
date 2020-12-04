<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleYear extends Model
{
    protected $fillable = [
        'id', 'v_id', 'v_year'
    ];

    
    public function vehicleBrandModel(){
        return $this->belongsTo('App\VehicleBrandModel');
    }


    public function vehicleEngine(){
        return $this->hasMany('App\VehicleEngine','year_id');
    }
}
