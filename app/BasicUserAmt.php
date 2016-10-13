<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicUserAmt extends Model
{
    protected $fillable = ['profile_id', 'basic_id', 'amount'];
}
