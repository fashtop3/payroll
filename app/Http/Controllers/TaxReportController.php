<?php

namespace App\Http\Controllers;

use App\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class TaxReportController extends Controller
{

    public function department(Request $request)
    {
        $departments = [];
        $dept_id = $request->get('dept_id', -1);
        $year = $request->get('year', 2016);
        $month = $request->get('month', -1);
        $action = $request->get('action', null);

        if($month>12) $month = 12;
        if($month<1) $month = -1;

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

        static::makeDepartmentTax($departments, $year, $month, $action);

        return view('report.tax.departments', compact('departments', 'year', 'month'));
    }

    public function staff()
    {

       return view('report.tax.staff');
    }

    protected static function makeDepartmentTax($departments, $year, $month, $action)
    {
        if($action != 'download') return;
        $dept_name = count($departments)==1?$departments[0]->name:'Departmental';
        $filename = $year;
        if($month>0) $filename = Carbon::createFromDate(2016, $month)->format('M') . '_'. $filename;
        $filename = $dept_name.'_Tax_Reports_'.$filename;

        self::xslxHeaders($filename);
        static::xlsBOF();
        self::xslxColumns();

        $row = 1;
        if(count($departments))
        {
            $total_tax = 0;
            foreach($departments as $department)
            {
                $dept_tax = 0;
                if($department->profiles->count())
                {
                    foreach($department->profiles as $profile)
                    {
                        if($profile->registeredDateHigher($year)) continue;
                        if($profile->registeredDateHigher($year, $month)) continue;
                        $dept_tax += $tax = $profile->tax($year, $month);

                        static::xlsWriteLabel($row, 0, $profile->eid);
                        static::xlsWriteNumber($row, 1, 5000);
                        static::xlsWriteLabel($row, 2, "Grand Cereals Ltd.");
                        static::xlsWriteLabel($row, 3, $department->name);
                        static::xlsWriteLabel($row, 4, $profile->firstname.' '. $profile->lastname.' '. $profile->middlename);
                        static::xlsWriteLabel($row, 5, $profile->personal->payeStateName());
                        static::xlsWriteLabel($row, 6, '-'.number_format($tax, 2));
                        static::xlsWriteLabel($row, 7, $profile->created_at->format('D, M j, Y'));
                        ++$row;
                    }
                    $total_tax += $dept_tax;
                    if($dept_tax>0){
                        static::xlsWriteLabel($row, 0, "TOTAL");
                        static::xlsWriteLabel($row, 6, '-'.number_format($dept_tax, 2));
                    }
                }
            }

            if($total_tax>0) {
                static::xlsWriteLabel($row, 0, "GRAND TOTAL");
                static::xlsWriteLabel($row, 6, '-'.number_format($total_tax, 2));
            }
        }

        static::xlsEOF();
        exit();
    }


    /**
     * @return string
     */
    protected static function xslxColumns()
    {
        static::xlsWriteLabel(0, 0, "PERSONNEL NUMBER");
        static::xlsWriteLabel(0, 1, "COMPANY CODE ID");
        static::xlsWriteLabel(0, 2, "COMPANY CODE DESCRIPTION");
        static::xlsWriteLabel(0, 3, "DEPARTMENT");
        static::xlsWriteLabel(0, 4, "EMPLOYEE NAME");
        static::xlsWriteLabel(0, 5, "REGION");
        static::xlsWriteLabel(0, 6, "TAX PAYMENT");
        static::xlsWriteLabel(0, 7, "REGISTERED");
    }

    protected static function xslxHeaders($filename)
    {
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment; filename=\"{$filename}.xls\"");
        header("Content-Transfer-Encoding: binary");
        header("Pragma: no-cache");
        header("Expires: 0");
    }

    protected static function xlsBOF() {
        echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
    }
    protected static function xlsEOF() {
        echo pack("ss", 0x0A, 0x00);
    }
    protected static function xlsWriteNumber($Row, $Col, $Value) {
        echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
        echo pack("d", $Value);
    }
    protected static function xlsWriteLabel($Row, $Col, $Value) {
        $L = strlen($Value);
        echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
        echo $Value;
    }

}
