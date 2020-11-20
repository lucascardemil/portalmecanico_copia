<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function quotationclients()
    {
        return $this->hasMany('App\Quotationclient');
    }


    public function scopeType($query)
    {
        $keyword = request('type');
        if ($query) {
            $query->where('type', '=', $keyword);
        }

        return $query;
    }
    /**
     * Filter user data based on query
     *
     * @params $query
     * @return Eloquent
     */
    public function scopeRazonSocial($query)
    {
        $keyword = request('client');
        if ($query) {
            $query->where('razonSocial', 'LIKE', '%'. $keyword . '%');
        }
        return $query;
    }
}
