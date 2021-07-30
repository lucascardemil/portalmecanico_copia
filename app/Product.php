<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function codes()
    {
        return $this->hasMany('App\Code');
    }

    public function productpagos()
    {
        return $this->hasOne('App\ProductPago');
    }
    

    public function client()
    {
        return $this->belongsToMany(Client::class, 'codes', 'product_id', 'client_id');
    }

    public function scopeName($query)
    {
        $keyword = request('name');
        if ($query) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        }

        return $query;
    }
}
