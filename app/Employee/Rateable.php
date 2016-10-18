<?php

namespace App\Employee;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Rateable extends Model
{
    protected $fillable = [ 'profile_id', 'paytype_id', 'durations', 'basic_id', 'taxable', 'total', 'approved_by', 'umonth'];

    public function setUmonthAttribute($date)
    {
        $this->attributes['umonth'] = Carbon::parse($date)->format('Y-m');
    }

    public function profile()
    {
        return $this->belongsTo('App\Employee\Profile');
    }

    public function paytype()
    {
        return $this->belongsTo('App\Employee\PayType');
    }

    public function basic()
    {
        return $this->belongsTo('App\Employee\Basic');
    }
}
