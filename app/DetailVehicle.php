<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailVehicle extends Model
{
    protected $fillable = [
        'vehicle_id', 'km', 'note'
     ];

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

}
