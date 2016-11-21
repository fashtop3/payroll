<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/login', function () {
    if(Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('login');


Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::get('/report/payslip/ups/{id}', 'PayslipController@printUserPaySlip')->name('report.payslip.ups');
Route::get('/report/payslip/upc/{id}', 'PayslipController@printUserPayCarf')->name('report.payslip.upc');


Route::group(['middleware' => ['auth', 'expired'] ], function () {

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/dashboard/profile', 'DashboardController@profileForm')->name('profile');
    Route::post('/dashboard/profile', 'DashboardController@updateProfile')->name('profile.update');

    Route::get('/dashboard/password', 'DashboardController@passwordForm')->name('password');
    Route::post('/dashboard/password', 'DashboardController@changePassword')->name('password.change');


    /**
     * protects employee route
     */
    Route::group(['middleware' => 'role:developer|hr.manager|staff.manager'], function () {
        Route::get('/employee/profiles', 'EmployeeController@employeeProfiles')->name('employee.profiles');
        Route::get('/employee/profiles/{id}/edit', 'EmployeeController@editEmployee')->name('employee.edit');
        Route::put('/employee/profiles/{id}/edit', 'EmployeeController@updateEmployee')->name('employee.update');
        Route::get('/employee/profiles/{id}', 'EmployeeController@showEmployeeProfile')->name('employee.view');

        Route::get('/employee/add', 'EmployeeController@addForm')->name('employee.add');
        Route::post('/employee/add', 'EmployeeController@storeEmployee')->name('employee.store');
    });


    /**
     * Protect this route
     */
    Route::group(['middleware' => 'role:developer|hr.manager'], function () {
        Route::get('/employee/rateable/{id}/delete', 'EmployeeController@deleteTransaction')->name('employee.rateable.delete');
        Route::get('/employee/rateable', 'EmployeeController@rateableForm')->name('employee.rateable');
        Route::post('/employee/rateable', 'EmployeeController@storeRateable')->name('rateable.store');
    });

    Route::group([], function() {
        Route::get('/report/department/{id}', 'ReportController@departmentById')->name('report.department.view');
        Route::get('/report/department', 'ReportController@departments')->name('report.department');
        Route::post('/report/department', 'ReportController@departments')->name('report.department');

        Route::get('/report/bank', 'ReportController@banks')->name('report.bank');
        Route::get('/report/bank/{id}/order', 'ReportController@bankOrder')->name('report.bank.order');

        Route::get('/report/paycard', 'ReportController@paycard')->name('report.paycard');

        Route::get('/report/shift', 'ReportController@shift')->name('report.shift');

        Route::get('/report/overtime', 'ReportController@overtime')->name('report.overtime');

        //tax
        Route::get('/report/tax/department', 'TaxReportController@department')->name('report.department-tax');
        Route::get('/report/tax/staff', 'TaxReportController@staff')->name('report.staff-tax');
        Route::get('/report/payslip', 'PayslipController@index')->name('report.payslip');
//        Route::get('/report/payslip/upc/{id}', 'PayslipController@printUserPayCarf')->name('report.payslip.upc');
//        Route::get('/report/payslip/ups/{id}', 'PayslipController@printUserPaySlip')->name('report.payslip.ups');
    });

    Route::group(['middleware' => 'role:developer|ict'], function() {
        Route::get('/user/add', 'UserController@create')->name('user.add');
        Route::post('/user/add', 'UserController@store')->name('user.add');

        Route::get('/user/{id}', 'UserController@show')->name('user.show');
        Route::post('/user/{id}', 'UserController@edit')->name('user.update');
        Route::get('/user/{id}/reset', 'UserController@resetPassword')->name('user.reset');

        Route::get('/user', 'UserController@index')->name('user');
        Route::get('/departments', 'DepartmentController@index')->name('departments');
        Route::get('/departments/{id}/restore', 'DepartmentController@restore')->name('department.restore');
        Route::get('/departments/create', 'DepartmentController@create')->name('department.create');
        Route::post('/departments/create', 'DepartmentController@store')->name('department.create');
        Route::get('/departments/{id}/edit', 'DepartmentController@edit')->name('department.edit');
        Route::post('/departments/{id}/edit', 'DepartmentController@update')->name('department.edit');
        Route::get('/departments/{id}/delete', 'DepartmentController@destroy')->name('department.delete');
    });
});
