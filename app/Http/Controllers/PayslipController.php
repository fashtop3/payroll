<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee\Account;
use App\Employee\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Knp\Snappy\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;

class PayslipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['printUserPaySlip'] ]);
    }

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

    public function printUserPaySlip(Request $request, $id)
    {
        $snappy = App::make(/*'snappy.pdf.wrapper'*/'snappy.pdf');
        $action = $request->get('action', -1);

        if($action == 'print') {
            try{
                $profile = Profile::findOrFail($id);

                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="file.pdf"');
                echo $snappy->getOutput([route('report.payslip.ups', $id)]);
                exit;
            }
            catch(\Exception $e)
            {
                return redirect()->back();
            }
        }

        try{
            $profile = Profile::findOrFail($id);
        }
        catch(\Exception $e)
        {
            return redirect()->back();
        }

        return view('report.payslip.payslip-api', compact('profile'));
    }

}
