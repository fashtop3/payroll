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


Route::group(['middleware' => 'auth'], function () {

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
});
