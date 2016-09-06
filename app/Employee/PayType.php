<?php

namespace App\Employee;

use Illuminate\Database\Eloquent\Model;

class PayType extends Model
{
    protected $fillable = ['label', 'name', 'value'];

}
