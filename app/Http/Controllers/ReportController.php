<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee\Bank;
use App\Employee\Basic;
use App\Employee\Profile;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function departments(Request $request)
    {
        $departments = Department::all();
        $basics  = Basic::all();
        $sort_date = Carbon::createFromDate($request->get('year', Carbon::now()->format('Y')), $request->get('month', Carbon::now()->format('m')));

//        dd($sort_date);

        return view('report.departments', compact('departments', 'basics', 'sort_date'));
    }

    public function departmentById(Request $request, $id)
    {
        $sort_date = Carbon::today();//->addMonth(2);
        if(!empty($request->get('sort'))) {
            $sort = explode('-', $request->get('sort'));
            $sort_date = Carbon::createFromDate($sort[0], $sort[1]);
        }

        try{
            $department = Department::with('profiles')->findOrFail($id);
            $basics  = Basic::all();
        }
        catch(\Exception $e) {
            return redirect()->back();
        }
        return view('report.department', compact('department', 'basics', 'sort_date'));
    }

    public  function banks(Request $request)
    {
        $banks = Bank::with('accounts')->get();
        $sort_date = Carbon::createFromDate($request->get('year', Carbon::now()->format('Y')), $request->get('month', Carbon::now()->format('m')));

        return view('report.bank', compact('banks', 'sort_date'));
    }

    public function paycard(Request $request)
    {
        $department_name = "All";
        $dept_id = $request->get('dept_id', -1);
        $profiles = Profile::where(function($query) use($dept_id) {
            if($dept_id != -1)
            {
                $query->where('department_id', $dept_id);
            }
        })->paginate(20);

        if($dept_id != -1) $department_name = Department::find($dept_id)->name;

        $basics = Basic::all();
        $sort_date = Carbon::createFromDate($request->get('year', Carbon::now()->format('Y')));

        return view('report.paycard', compact('profiles', 'basics', 'sort_date', 'department_name'));
    }

    public function shift(Request $request)
    {
        $departments = Department::with('profiles')->get();
        $sort_date = Carbon::createFromDate($request->get('year', Carbon::now()->format('Y')), $request->get('month', Carbon::now()->format('m')));

        return view('report.shift', compact('departments', 'sort_date'));
    }

    public function overtime(Request $request)
    {
        $departments = Department::with('profiles')->get();
        $sort_date = Carbon::createFromDate($request->get('year', Carbon::now()->format('Y')), $request->get('month', Carbon::now()->format('m')));

        return view('report.overtime', compact('departments', 'sort_date'));
    }

    public function bankOrder(Request $request, $id)
    {
        $sort_date = Carbon::today();//->addMonth(2);
        if(!empty($request->get('sort'))) {
            $sort = explode('-', $request->get('sort'));
            $sort_date = Carbon::createFromDate($sort[0], $sort[1]);
        }

        try{
            $bank = Bank::with('accounts')->findOrFail($id);
        }
        catch(\Exception $e) {

        }
        return view('report.order', compact('bank', 'sort_date'));
    }
}
