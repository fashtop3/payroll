<?php

namespace App\Employee;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $fillable = [
        'profile_id',
        'gender',
        'status',
        'nationality',
        'state_of_origin',
        'paye_state',
        'language',
        'location',
        'cost_center',
        'notes',
    ];

    public function profile()
    {
        return $this->belongsTo('App\Employee\Profile');
    }

    public function stateOfOrigin()
    {
        return $this->belongsTo('App\Employee\State');
    }

    public function payeState()
    {
        return $this->belongsTo('App\Employee\State');
    }
}
