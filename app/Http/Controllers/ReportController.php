<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function departments()
    {
        $departments = Department::with('profiles')->get();
//        dd($departments[1]->profiles());

        $raw = DB::select("select sum(total) as total from rateables where profile_id in(select id from profiles where department_id = 2) and basic_id = 1 and umonth = '2016-09'");

        $rate = DB::table('rateables')
            ->whereIn('profile_id', [26])->sum('total');

        dd($raw);
    }
}
