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
        'name', 'email', 'password','url', 'ip_acceso','logo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'ip_acceso'
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
