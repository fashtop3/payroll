<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicUserAmt extends Model
{
    protected $fillable = ['profile_id', 'basic_id', 'amount'];

    public function profile()
    {
        return $this->belongsTo('App\Employee\Profile');
    }

    public function basic()
    {
        return $this->belongsTo('App\Employee\Basic');
    }
}
