<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleBrandModel extends Model
{

    protected $fillable = [
        'id', 'brand', 'model', 'tipo_id'
    ];
    
    public $timestamps = false;


    public function vehicleYears()
    {
        return $this->hasMany('App\VehicleYear','v_id');
    }

}
