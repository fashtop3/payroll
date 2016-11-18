<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class TaxReportController extends Controller
{
    public function department(Request $request)
    {
        $departments = [];
        $dept_id = $request->get('dept_id', -1);
        $year = $request->get('year', -1);
        $month = $request->get('month', -1);


        if($dept_id > 0) {
            try{

                $departments[] = Department::find($dept_id);
            }
            catch(\Exception $e)
            {
                Session::flash('error', 'Department not found');
                return redirect()->back();
            }
        }
        else if($dept_id == -1)
        {
            $departments = Department::all();
        }

        return view('admin.tax.departments', compact('departments'));
    }

    public function staff()
    {

       return view('admin.tax.staff');
    }
}
