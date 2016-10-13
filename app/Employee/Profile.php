<?php

namespace App\Employee;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'created_by',
        'eid',
        'title',
        'lastname',
        'firstname',
        'middlename',
        'active',
        'address1',
        'address2',
        'state_id',
        'city',
        'postal',
        'country',
        'mobile_phone',
        'home_phone',
        'office_phone',
        'email',
        'category_id',
        'department_id',
        'designation',
        'approved'
    ];

    /*
     * uses filter
     */
    public function recentRateables()
    {
        return $this->hasMany('App\Employee\Rateable')->whereUmonth(Carbon::now()->format('Y-m'));
    }

    public function userBasicId()
    {
        return $this->hasMany('App\Employee\BasicUserAmt')->whereBasicId(1)->with('basic');
    }

    public function account()
    {
        return $this->hasOne('App\Employee\Account');
    }

    public function empDate()
    {
        return $this->hasOne('App\Employee\EmpDate');
    }

    public function personal()
    {
        return $this->hasOne('App\Employee\Personal');
    }

    public function state()
    {
        return $this->belongsTo('App\Employee\State');
    }

    public function department()
    {
        return $this->belongsTo('App\Employee\Department');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Employee\Category');
    }

    public function basisAmounts()
    {
        return $this->hasMany('App\Employee\BasicUserAmt');
    }

}
