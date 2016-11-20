<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;

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

        return view('report.payslip.payslip-print-view');
//        try{

            $profile = Profile::findOrFail($id);
            Excel::create('Filename', function($excel) use($profile) {

                $fullname = $profile->lastname.'('.$profile->eid.')';
                $excel->setTitle("{$fullname} PaySlip");

                $excel->setCreator('Grand Cereal')
                    ->setCompany('Grand Cereal');

                $excel->setDescription('Grand cereal payslip generator');

                $excel->sheet('slip', function($sheet) {

                    $sheet->setPageMargin(array(
                        0.25, 0.30, 0.25, 0.30
                    ));
                    $sheet->setAllBorders('none');

                    $sheet->loadView('report.payslip.payslip-print-view');

                });

            })->export('pdf');

//        }
//        catch(\Exception $e)
//        {
//
//        }
    }
}
