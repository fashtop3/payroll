<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function profileForm()
    {
        return view('profile');
    }

    public function passwordForm()
    {
        return view('password');
    }

    public function updateProfile(Request $request)
    {
        //Todo: validate

        $user =  Auth::user();
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->mobile = $request->get('mobile');
        $user->address = $request->get('address');
        $user->save();

        Session::flash('update_message', 'Profile updated!');

        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        //Todo: validate
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        $current = $request->get('current_password');
        $new = $request->get('new_password');
        $confirm = $request->get('confirm_password');
        $credentials = ['email'=>Auth::user()->email, 'password'=> $current];

        if(Hash::check($current, Auth::user()->password)) {
            $user = Auth::user();
            $user->password = $new; //password has been hashed in the model
            $user->save();

            Session::flash('update_message', 'Password Changed. It will effective on next login!');

            return redirect()->back();
        }

        Session::flash('error', 'Invalid credentials!');

        return redirect()->back();
    }
}
