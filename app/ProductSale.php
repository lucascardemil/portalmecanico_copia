<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSale extends Pivot
{
    public $table = 'productsales';
    protected $fillable = ['sale_id', 'code_id', 'price', 'utility', 'quantity'];

    public function sale() {
        return $this->belongsTo('App\Sale');
    }

    public function codes() {
        return $this->hasMany('App\Code', 'id', 'code_id');
    }

    public function products() {
        return $this->hasManyThrough('App\Product', 'App\Code', 'product_id', 'id', 'code_id', 'id');
    }

}
