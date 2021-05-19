<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cant_client', 'cant_vehicle', 'url', 'token','logo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token'
    ];

    public function vehicles()
    {
        return $this->hasMany('App\Vehicle');
    }

    public function quotations()
    {
        return $this->hasMany('App\Quotation');
    }

    public function clients()
    {
        return $this->hasMany('App\Client');
    }

}
