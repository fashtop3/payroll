<?php

namespace App\Employee;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EmpDate extends Model
{
    protected $fillable = [
        'profile_id',
        'dob',
        'doe',
        'doc',
        'last_promotion',
        'pension_scheme',
        'last_salary',
    ];

    public function setDobAttribute($date)
    {
        $this->attributes['dob'] = $date != '' ? Carbon::parse($date)->format('Y-m-d'):null;
    }

    public function setDoeAttribute($date)
    {
        $this->attributes['doe'] = $date != '' ? Carbon::parse($date)->format('Y-m-d'):null;
    }

    public function setDocAttribute($date)
    {
        $this->attributes['doc'] = $date != '' ? Carbon::parse($date)->format('Y-m-d'):null;
    }

    public function setLastPromotionAttribute($date)
    {
        $this->attributes['last_promotion'] = $date != '' ? Carbon::parse($date)->format('Y-m-d'):null;
    }

    public function setPensionSchemeAttribute($date)
    {
        $this->attributes['pension_scheme'] = $date != '' ? Carbon::parse($date)->format('Y-m-d'):null;
    }

    public function setLastSalaryAttribute($date)
    {
        $this->attributes['last_salary'] = $date != '' ? Carbon::parse($date)->format('Y-m-d'):null;
    }

    public function profile()
    {
        return $this->belongsTo('App\Employee\Profile');
    }
}
