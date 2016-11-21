<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee\Account;
use App\Employee\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Knp\Snappy\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;

class PayslipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['printUserPaySlip', 'printUserPayCarf'] ]);
    }

    public function index(Request $request)
    {
        $snappy = App::make(/*'snappy.pdf.wrapper'*/'snappy.pdf');
        $dept_id = $request->get('dept_id', -1);
        $action = $request->get('action', -1);
        $department = null;
        $profiles = null;

        try{
            $department = Department::findOrFail($dept_id);//->with('profiles');
            $profiles = $department->profiles()->paginate(100);
            $links = [];

            if($action == 'paycarf')
            {
                $this->printMembersCarf($profiles, $links, $department, $snappy);
            }
            if($action == 'payslip')
            {
                $this->printMembersPayslip($profiles, $links, $department, $snappy);
            }
        }
        catch(\Exception $e)
        {
            Session::flash('error', 'Please select a valid department');
        }

        return view('report.payslip.payslip', compact('department', 'profiles'));
    }

    public function printUserPayCarf(Request $request, $id)
    {
        $snappy = App::make(/*'snappy.pdf.wrapper'*/'snappy.pdf');
        $action = $request->get('action', -1);

        if($action == 'print') {
            try{
                $profile = Profile::findOrFail($id);
                $date =  \Carbon\Carbon::now()->format('M_Y');
                $filename = "paycarf_{$profile->lastname}_{$date}.pdf";
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="'.$filename.'"');
                echo $snappy->getOutput([route('report.payslip.upc', $id)]);
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

        return view('report.payslip.paycarf-pdf', compact('profile'));
    }


    public function printUserPaySlip(Request $request, $id)
    {
        $snappy = App::make(/*'snappy.pdf.wrapper'*/'snappy.pdf');
        $action = $request->get('action', -1);

        if($action == 'print') {
            try{
                $profile = Profile::findOrFail($id);
                $date =  \Carbon\Carbon::now()->format('M_Y');
                $filename = "payslip_{$profile->lastname}_{$date}.pdf";
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="'.$filename.'"');
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

        return view('report.payslip.payslip-pdf', compact('profile'));
    }

    /**
     * @param $profiles
     * @param $links
     * @param $department
     * @param $snappy
     */
    protected function printMembersCarf($profiles, $links, $department, $snappy)
    {
        foreach ($profiles as $profile) {
            $links[] = route('report.payslip.upc', $profile->id);
        }
        $date = \Carbon\Carbon::now()->format('M_Y');
        $filename = "payslip_".str_replace(' ','_', $department->name)."_{$date}.pdf";
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        echo $snappy->getOutput($links);
        exit;
    }

    /**
     * @param $profiles
     * @param $links
     * @param $department
     * @param $snappy
     */
    protected function printMembersPayslip($profiles, $links, $department, $snappy)
    {
        foreach ($profiles as $profile) {
            $links[] = route('report.payslip.ups', $profile->id);
        }
        $date = \Carbon\Carbon::now()->format('M_Y');
        $filename = "payslip_".str_replace(' ','_', $department->name)."_{$date}.pdf";
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        echo $snappy->getOutput($links);
        exit;
    }

}
