<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee\Account;
use App\Employee\Basic;
use App\Employee\BasicUserAmt;
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
            ->with('recentRateables')
            ->with('userBasicId')
            ->get();//->first();

        $payTypes = PayType::all();
        $basic = Basic::find(1)->first();

        return view('employee.rateable', compact('profiles', 'payTypes', 'basic'));
    }

    public function storeEmployee(Request $request)
    {
//        dd($request->all());
        $input = $request->all();

        try{

            DB::beginTransaction();

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

                if(!empty($input['basis_amount'])) {
                    foreach($input['basis_amount'] as $k => $v) {
                        BasicUserAmt::create(['profile_id'=> $user->id, 'basic_id' => $k, 'amount' => (float) $v]);
                    }
                }

                DB::commit();

                Session::flash('success', 'Employee successfully added!');

                return redirect()->route('employee.add')->withInput();
            }
        }
        catch(\Exception $e) {

            Session::flash('error', 'Employee registration failed!');
//            dd($e->getMessage());
            return redirect()->back()->withInput();
        }

    }

    public function storeRateable(Request $request)
    {
        //Todo: validate

        try{
            $basic = Basic::findOrFail($request->get('basic_id'));
            $paytype = PayType::findOrFail($request->get('paytype_id'));
            $profile = Profile::findOrFail($request->get('profile_id'));
            $base_amount = $profile->userBasicId()->first()->amount;//amount;

            $input = $request->all();
            $input['taxable'] = $request->get('taxable') ? 1 : 0;
            $input['total'] = $this->recalculate($paytype, $base_amount, $request->get('durations'), $input['taxable']);
            $input['approved_by'] = Auth::user()->id;
            $input['umonth'] = Carbon::now();

            Rateable::firstOrCreate([
                'profile_id' =>$input['profile_id'] ,
                'paytype_id' =>$input['paytype_id'],
                'umonth' =>$input['umonth']
            ], $input);
        }
        catch(\Exception $e)
        {
//            dd($e->getMessage());
            Session::flash('error', 'Selected Transaction Exists!');
            return redirect()->back()->withInput();
        }


        Session::flash('success', 'Transaction saved!');

        return redirect()->route('employee.rateable')
            ->with('profile', $profile)
            ->withInput();
    }

    public function updateEmployee(Request $request, $id)
    {
        $input = $request->all();

        try
        {
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

            if(!empty($input['basis_amount'])) {
                foreach($input['basis_amount'] as $k => $v) {
                    $emp_basis = BasicUserAmt::firstOrNew(['profile_id'=>$employee->id, 'basic_id' => $k]);
                    $emp_basis->amount = (float) $v;
                    $emp_basis->save();
                }
            }
        }
        catch(\Exception $e)
        {
            Session::flash('error', 'Employee profile update failed!');
            return redirect()->back();
        }

        Session::flash('update_message', 'Employee profile updated!');
        return redirect()->back();
    }

    protected function recalculate($paytype, $base_amount, $durations, $taxable = false)
    {
        $total = 0;

        if ($paytype->label == 'OVERTIME') {
            $total = ($base_amount / ($durations * 8)) * $paytype->value;
        }
        if ($paytype->label == 'SHIFT') {
            $total = ($base_amount / ($durations)) * $paytype->value;
        }

        if($taxable) {
            $total -= ((5/100)*$total);
        }

        return $total;
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

        try{
            $profile  = Profile::with('account')
                ->with('personal')
                ->with('empDate')
                ->findOrFail($id);
            $states = DB::table('states')->get();
            $banks = DB::table('banks')->get();
            $categories = DB::table('categories')->get();
            $basics = DB::table('basics')->get();
            $departments = DB::table('departments')->get();
        }
        catch(\Exception $e)
        {
            Session::flash('error', 'Employee profile not found');
            return redirect()->back();
        }


        return view('employee.add' , compact('states', 'banks', 'categories', 'basics', 'departments'))
            ->withProfile($profile);
    }
}
