<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();


        return view('admin.users', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.create', compact('roles'));
    }

    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $user_roles = $user->roles()->get()->pluck('id')->toArray();
        $user_roles = array_flip($user_roles);

        return view('admin.create', compact('user', 'user_roles'));
    }

    public function edit(UserUpdateRequest $request, $id)
    {
        $input = $request->all();
        try
        {
            $user = User::findOrFail($id);
            // update not allowed for other users
            if (($user->id == 1))
            {
                if(!Auth::user()->isRole('developer'))
                {
                    throw new \Exception('Your are not authorized to modify this account');
                }
                else
                {
                    //for user with role :developer
                    $role = Role::where('name', 'developer')->first();
                    if(isset($role->id))
                    {
                        $input['roles'][] = $role->id;
                    }
                }
            }
            if(empty($input['password']))
            {
                unset($input['password']);
            }
            $user->update($input);

            if (!empty($input['roles']))
            {
                $role_ids = array_values($input['roles']);
                $user->roles()->sync($role_ids);
            }
        }
        catch(\Exception $e)
        {
            if($e instanceof \Exception)
            {
                Session::flash('error', $e->getMessage());
            }
            else
            {
                Session::flash('error', 'Profile updated failed!');
            }
            return redirect()->back()->withInput();
        }

        Session::flash('success', 'Profile updated successfully');
        return redirect()->back();
    }

    public function store(CreateUserRequest $request)
    {
//        DB::beginTransaction();
        $pwd = null;
        try{
            $input = $request->all();
            if(empty($input['password']))
            {
                $pwd = $this->generatePwd($input['lastname']);
                $input['password'] = Hash::make($pwd);
            }
            $user = User::create($input);
            if (!empty($input['roles']))
            {
                $role_ids = array_values($input['roles']);
                $user->roles()->sync($role_ids);

//                $user->attachRole($role_ids);
            }
        }
        catch(\Exception $e) {

            Session::flash('error', 'Error creating new user');
//            dd($e->getMessage());
            return redirect()->back()->withInput();
        }

        Session::flash('success', "Account has been created successfully" . ($pwd ? " Password: <b>{$pwd}</b>":null));
        return redirect()->back();
    }

    public function resetPassword($id)
    {
        $pwd = null;
        try
        {
            $user = User::findOrfail($id);
            $pwd = $this->generatePwd($user->lastname);
            $user->password = $pwd;
            $user->save();
        }
        catch(\Exception $e)
        {
            Session::flash('error', 'Password reset failed');
            return redirect()->back();
        }

        Session::flash('success', "<b>{$user->lastname} {$user->firstname}</b> (new password): <b>$pwd</b> ");
        return redirect()->back();
    }

    protected function generatePwd($str)
    {
        $pwd = $str . 12345678;
        for($i=0; $i<5; $i++)
        {
            $pwd = str_shuffle($pwd);
        }

        $pwd = strtoupper(substr($pwd, 0, 10));

        return $pwd;
    }
}
