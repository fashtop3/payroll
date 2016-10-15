<?php

namespace App\Employee;

use Illuminate\Database\Eloquent\Model;

class Basic extends Model
{
    protected $fillable = ['name'];

    /**
     * checks for basicUserAmt table
     * and sum all the amount for the model [by id]
     */
    public function sumAll()
    {
        return $this->hasMany('App\Employee\BasicUserAmt');//->sum('amount');
    }
}
