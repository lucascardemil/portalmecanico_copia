<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotationclient extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function detailclients()
    {
        return $this->hasMany('App\Detailclient');
    }

    /**
     * Filter user data based on query
     *
     * @params $query
     * @return Eloquent
     */
    public function scopeId($query)
    {
        $keyword = request('id');
        if ($query) {
            $query->where('id', 'LIKE', '%'. $keyword . '%');
        }

        return $query;
    }
    /**
     * Filter user data based on query
     *
     * @params $query
     * @return Eloquent
     */
    public function scopeDate($query)
    {
        $day = request('day');
        $month = request('month');
        $year = request('year');
        if ($query) {
            if($day!=''){
                $query->whereDay('created_at',$day);
            }
            if($month!=''){
                $query->whereMonth('created_at',$month);
            }
            if($year!=''){
                $query->whereYear('created_at',$year);
            }
        }
        return $query;
    }
}
