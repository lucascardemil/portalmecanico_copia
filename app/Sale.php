<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public $table = "sales";
    protected $fillable = ['user_id', 'client_id', 'total'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // public function codes() {
    //     return $this->hasManyThrough('App\ProductSale', 'App\Code', 'id', 'code_id', 'sale_id', 'id');
    // }

    // public function codes() {
    //     return $this->hasManyThrough('App\Code', 'App\ProductSale', 'code_id', 'id', 'id', 'sale_id');
    // }

    public function products() {
        return $this->hasMany('App\ProductSale');
    }

    public function client() {
        return $this->belongsTo('App\Client');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
