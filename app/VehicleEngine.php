<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleEngine extends Model
{
    protected $fillable = [
        'id', 'year_id', 'v_engine'
    ];

    public function vehicleYear()
    {
        return $this->belongsTo('App\VehicleYear');
    }
}
