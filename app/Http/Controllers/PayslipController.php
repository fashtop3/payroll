<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;

class PayslipController extends Controller
{
    public function index(Request $request)
    {
        $dept_id = $request->get('dept_id', -1);
        $department = null;
        $profiles = null;

        try{
            if($dept_id != -1)
            {
                $department = Department::findOrFail($dept_id);//->with('profiles');
                $profiles = $department->profiles()->paginate(100);
            }
        }
        catch(\Exception $e)
        {

        }

        return view('report.payslip.payslip', compact('department', 'profiles'));
    }

    public function printUserPayCarf($id)
    {

    }

    public function printUserPaySlip($id)
    {

    }
}
