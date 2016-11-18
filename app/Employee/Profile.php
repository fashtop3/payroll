<?php

namespace App\Employee;

use App\Http\Controllers\EmployeeController;
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
    const __BASIC_ID__ = 1; //from basics table .... the id for user relation baseAmount

    public function recentRateables()
    {
        return $this->hasMany('App\Employee\Rateable')->whereUmonth(Carbon::now()->format('Y-m'));
    }

    public function getAmountBasisById($id)
    {
        $amount = 0.00;
        $basis =  $this->basisById($id)->first();
        if(!empty($basis))
        {
            $amount = $basis->amount;
        }

        return $amount;
    }


    /**
     * get the staff tax from its basic amount
     * @return mixed
     */
    public function tax()
    {
        $basic_amount = $this->basicPay()->first()->amount;
        return (0.05*$basic_amount);
    }

    public function basisById($id)
    {
        return $this->hasMany('App\Employee\BasicUserAmt')->whereBasicId($id);
    }

    public function userBasicId()
    {
        return $this->hasMany('App\Employee\BasicUserAmt')->whereBasicId(self::__BASIC_ID__)->with('basic');
    }

    /**
     * Get the user basi
     * @return mixed
     */
    public function basicPay()
    {
        return $this->hasMany('App\Employee\BasicUserAmt')->whereBasicId(self::__BASIC_ID__);
    }

    /**
     * Get the number of days the staff worked for using {month}
     * @param $shift_id
     * @param $date
     * @return mixed
     */
    public function workShift($shift_id, $date)
    {
        return $this->hasMany('App\Employee\Rateable')->wherePaytypeId($shift_id)->whereUmonth($date);
    }

    public function resolveShiftRate($shift_id, $basic_pay)
    {
        $paytype = PayType::find($shift_id); //use this to get the paytype value for calculations

        //Todo: make the constant 23 to be variable
        if ($paytype->label == 'OVERTIME') {
            return (double) ($basic_pay/23) / 8;
        }

        return (double) $rate = ($basic_pay/23) * $paytype->value;
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
