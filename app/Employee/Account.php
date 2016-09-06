<?php

namespace App\Employee;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'profile_id',
        'category_id',
        'work_rotation',
        'bank_id',
        'bank_address',
        'account_type',
        'account_name',
        'account_number',
        'bank_reference',
        'routine_number',
        'hold_pay',
        'currency',
        'taxable',
        'pfa',
        'pfa_number',
        'base_amount',
    ];

    public function profile()
    {
        return $this->belongsTo('App\Employee\Profile');
    }
    public function category()
    {
        $this->belongsTo('App\Employee\Category');
    }

    public function bank()
    {
        $this->belongsTo('App\Employee\Category');
    }
}
