<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function quotation()
    {
        return $this->belongsTo('App\Quotation');
    }
}
