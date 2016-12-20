<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AppKey extends Model
{
    protected static $freeware = [
        'key' => '$2y$10$zKLLB.8IQeF/eyqQDtIsMehWG86n9N3mZph583RQKgxvNrgbXv.TK',
//        'expiry' => "2016-09-20 12:21:30.000000",
        'expiry' => "2017-06-20 12:20:57.000000",
    ];

    static public function access()
    {
        if(Carbon::now() > static::$freeware['expiry'])
            return false;

        return true;
    }
}