<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withTrashed()->get();

        return view('admin.departments', compact('departments'));
    }

    public function create()
    {
        return view('admin.department-form');
    }

    public function store(Request $request)
    {
        if(Department::create($request->all()))
        {
            Session::flash('success', 'Department saved');
        }
        else
        {
            Session::flash('error', 'Error creating new department');
        }
        return view('admin.department-form');
    }

    public function edit($id)
    {
        try{
            $department = Department::findOrFail($id);
            return view('admin.department-form', compact('department'));
        }
        catch(\Exception $e)
        {
            Session::flash('error', 'Department not found');
        }

        return redirect()->route('departments');
    }

    public function update(Request $request, $id)
    {
        try{
            $department = Department::findOrFail($id);
            $department->update($request->all());
            Session::flash('success', 'Update was successful!');
        }
        catch(\Exception $e)
        {
            Session::flash('error', 'Department update failed');
        }

        return redirect()->back()->withInput();
    }

    public function destroy($id)
    {
        try{
            $department = Department::findOrFail($id);
            if($department->profiles->count())
            {
                $department->delete();
                Session::flash('success', 'Department was trashed successfully');
            }
            else {
                $department->forceDelete();
                Session::flash('success', 'Department deleted permanently');
            }

        }
        catch(\Exception $e)
        {
            Session::flash('error', 'Department not found');
        }

        return redirect()->route('departments');
    }

    public function restore($id)
    {
        try
        {
            $dept = Department::withTrashed()->findOrFail($id);
            $dept->restore();
            Session::flash('success', 'Department has been restored!!');
        }
        catch(\Exception $e)
        {
            Session::flash('error', 'Department not found');
        }

        return redirect()->route('departments');
    }
}
