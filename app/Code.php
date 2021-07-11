<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function inventories()
    {
        return $this->hasMany('App\Inventory');
    }

    public function sales()
    {
        return $this->belongsToMany('App\ProductSale', 'sale_id')
            ->withPivot('code_id', 'price', 'utility', 'quantity');
    }

    
}
