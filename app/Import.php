<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function detailimports()
    {
        return $this->hasMany('App\Detailimport');
    }

    public function archiveimports()
    {
        return $this->hasMany('App\Archiveimport');
    }
}
