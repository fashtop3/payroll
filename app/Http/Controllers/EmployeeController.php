<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee\Account;
use App\Employee\Basic;
use App\Employee\EmpDate;
use App\Employee\PayType;
use App\Employee\Personal;
use App\Employee\Profile;
use App\Employee\Rateable;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mockery\CountValidator\Exception;

class EmployeeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function employeeProfiles()
    {
        $profiles = Profile::paginate(100);
        return view('employee.profiles')->withProfiles($profiles);
    }

    public function addForm()
    {
        $profile = new Profile();
        $states = DB::table('states')->get();
        $banks = DB::table('banks')->get();
        $categories = DB::table('categories')->get();
        $basics = DB::table('basics')->get();
        $departments = Department::orderBy('name', 'asc')->get();

        return view('employee.add' , compact('states', 'banks', 'categories', 'basics', 'departments'))
            ->withProfile($profile);
    }

    public function rateableForm()
    {
        $profiles = Profile::with('account')
            ->with('recentRateables')->get();//->first();

        $payTypes = PayType::all();
        $basics = Basic::all();

        return view('employee.rateable', compact('profiles', 'payTypes', 'basics'));
    }

    public function storeEmployee(Request $request)
    {
        try{

            DB::beginTransaction();

            $input = $request->all();
            $input['approved'] = $request->get('approved') ? 1 : 0;
            $input['active'] = $request->get('active') ? 1 : 0;
            $input['taxable'] = $request->get('taxable') ? 1 : 0;
            $input['hold_pay'] =  $request->get('hold_pay') ? 1 : 0;

            $input['created_by'] = Auth::user()->id;

            if($user = Profile::create($input)) {
                $user->eid = 'CON'. str_pad($user->id, 7, "0", STR_PAD_LEFT);
                $user->save();

                $input['profile_id'] = $user->id;
                Personal::create($input);
                EmpDate::create($input);
                Account::create($input);

                DB::commit();

                Session::flash('flash_message', 'Employee successfully added!');

                return redirect()->route('employee.add')->withInput();
            }
        }
        catch(\Exception $e) {

            Session::flash('error', 'Employee registration failed!');

            return redirect()->back('employee.add')->withInput();
        }

    }

    public function storeRateable(Request $request)
    {
        //Todo: validate
        $basic = Basic::findOrFail($request->get('basic_id'));
        $paytype = PayType::findOrFail($request->get('paytype_id'));
        $profile = Profile::findOrFail($request->get('profile_id'));
        $base_amount = $profile->account->base_amount;
        $input = $request->all();
        $input['taxable'] = $request->get('taxable') ? 1 : 0;
        $input['total'] = $this->recalculate($paytype, $base_amount, $request->get('hours'));
        $input['approved_by'] = Auth::user()->id;
        $input['umonth'] = Carbon::now();

        try{
            Rateable::firstOrCreate([
                'profile_id' =>$input['profile_id'] ,
                'paytype_id' =>$input['paytype_id'],
                'umonth' =>$input['umonth']
            ], $input);
        }
        catch(\Exception $e) {
            Session::flash('error', 'Selected Transaction Exists!');
            return redirect()->back()->withInput();
        }


        Session::flash('flash_message', 'Transaction saved!');

        return redirect()->route('employee.rateable')
            ->with('profile', $profile)
            ->withInput();
    }

    public function updateEmployee(Request $request, $id)
    {
        $input = $request->all();
        $employee = Profile::findOrFail($id);
        $input['profile_id'] = $employee->id;
        $input['approved'] = $request->get('approved') ? 1 : 0;
        $input['active'] = $request->get('active') ? 1 : 0;
        $input['taxable'] = $request->get('taxable') ? 1 : 0;
        $input['hold_pay'] =  $request->get('hold_pay') ? 1 : 0;


        $employee->update($input);
        $employee->empDate->update($input);
        $employee->account->update($input);
        $employee->personal->update($input);

        Session::flash('update_message', 'Employee profile updated!');
        return redirect()->back();
    }

    protected function recalculate($paytype, $base_amount, $hours)
    {
        if ($paytype->label == 'OVERTIME') {
            return $total = ($base_amount / ($hours * 8)) * $paytype->value;
        }
        if ($paytype->label == 'SHIFT') {
            return $total = ($base_amount / ($hours)) * $paytype->value;
        }
    }

    public function showEmployeeProfile($id)
    {
        return redirect()->back();
    }

    public function deleteTransaction($id)
    {
        try{
            $transaction = Rateable::find($id);
            $transaction->delete();
            return redirect()->back();
        } catch(\Exception $e) {

            return response('Transaction error', 403);
        }
    }

    public function editEmployee($id)
    {
        $profile = Profile::findOrFail($id)
            ->with('account')
            ->with('personal')
            ->with('empDate')->get()->first();
        $states = DB::table('states')->get();
        $banks = DB::table('banks')->get();
        $categories = DB::table('categories')->get();
        $basics = DB::table('basics')->get();

        return view('employee.add' , compact('states', 'banks', 'categories', 'basics'))
            ->withProfile($profile);
    }
}
