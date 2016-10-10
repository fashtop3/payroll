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

        $sort_date = Carbon::today();//->addMonth(2);
        if(!empty($request->all())) {
            $sort_date = Carbon::createFromDate($request->get('year'), $request->get('month'));
        }

//        dd($sort_date);

        return view('report.departments', compact('departments', 'basics', 'sort_date'));
    }

    public function departmentById(Request $request, $id)
    {
        try{
            $department = Department::with('profiles')->findOrFail($id);
            $sort_date = Carbon::today()->subMonth(1);//->addMonth(2);
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

        $sort_date = Carbon::today();//->addMonth(2);
        if(!empty($request->all())) {
            $sort_date = Carbon::createFromDate($request->get('year'), $request->get('month'));
        }

        return view('report.bank', compact('banks', 'sort_date'));
    }

    public function paycard(Request $request)
    {
        $profiles = Profile::all();
        $basics = Basic::all();
        $sort_date = Carbon::today();//->addMonth(2);
        if(!empty($request->all())) {
            $sort_date = Carbon::createFromDate($request->get('year'), $request->get('month'));
        }

        return view('report.paycard', compact('profiles', 'basics', 'sort_date'));
    }

    public function shift(Request $request)
    {
        $departments = Department::with('profiles')->get();
        $sort_date = Carbon::today();//->addMonth(2);
        if(!empty($request->all())) {
            $sort_date = Carbon::createFromDate($request->get('year'), $request->get('month'));
        }

        return view('report.shift', compact('departments', 'sort_date'));
    }

    public function overtime(Request $request)
    {
        $departments = Department::with('profiles')->get();
        $sort_date = Carbon::today();//->addMonth(2);
        if(!empty($request->all())) {
            $sort_date = Carbon::createFromDate($request->get('year'), $request->get('month'));
        }

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
