<?php

namespace App;
use Bican\Roles\Models\Role as BRole;

//use Illuminate\Database\Eloquent\Model;

class Role extends BRole
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'level'
    ];
}