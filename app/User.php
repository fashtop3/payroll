<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements
    HasRoleAndPermissionContract
{
    use Notifiable, HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname', 'firstname', 'mobile', 'address', 'email', 'password'
    ];

    protected $dates = ['expire'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'expire',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function userRoles()
    {
        return $this->hasMany('App\Role');
    }
}
