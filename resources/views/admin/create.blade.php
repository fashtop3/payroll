
@extends('app')

@section('content')

    <div id="page-title">
        <h2>User Support</h2>
        <p>Create new user.</p>
    </div>

    <div class="panel">
        <form action="{{isset($user->id)?route('user.update', ['id'=>$user->id]):route('user.add')}}" class="form-horizontal" method="post">
            {{csrf_field()}}
            <div class="panel-body">
                <h3 class="title-hero">
                    Add new user
                </h3>

                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <strong>Great!</strong> {!! Session::get('success') !!}
                    </div>
                @endif

                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        <strong>Failed!</strong> {{Session::get('error')}}
                    </div>
                @endif

                @if(count($errors->all()) > 0)
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1 alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $message)
                                    <li>{{$message}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif


                <div class="bordered-row">

                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Last Name <abbr class="text-danger" title="required">*</abbr></label>
                            <div class="col-sm-5">
                                <input type="text" value="{{old('lastname', isset($user->lastname)?$user->lastname:null) }}" class="form-control" placeholder="Last Name" name="lastname" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">First Name <abbr class="text-danger" title="required">*</abbr></label>
                            <div class="col-sm-5">
                                <input type="text" value="{{old('firstname', isset($user->firstname)?$user->firstname:null)}}" class="form-control" placeholder="First Name" name="firstname" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="mobile" class="col-sm-3 control-label">Mobile <abbr class="text-danger" title="required">*</abbr></label>
                            <div class="col-sm-5">
                                <input type="text" value="{{old('mobile', isset($user->mobile)?$user->mobile:null)}}" class="form-control" placeholder="Mobile" name="mobile" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email <abbr class="text-danger" title="required">*</abbr></label>
                            <div class="col-sm-5">
                                <input type="text" value="{{old('email', isset($user->email)?$user->email:null)}}" class="form-control" placeholder="Email" name="email" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-5">
                                <input type="password" value="{{old('password')}}" class="form-control" placeholder="Password" name="password" />
                                <span class="help-block text-muted">Optional</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="confirm_password" class="col-sm-3 control-label">Confirm Password</label>
                            <div class="col-sm-5">
                                <input type="password" value="{{old('confirm_password')}}" class="form-control" placeholder="Confirm Password" name="confirm_password" />
                                <span class="help-block text-muted">Required if password is set.</span>
                            </div>
                        </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Roles</label>
                        <div class="col-sm-5">
                            <?php $i = 0; ?>
                            @foreach(\App\Role::all() as $role)
                                <div class="checkbox checkbox-primary">
                                    <label>
                                        <input type="checkbox" name="roles[{{$role->id}}]" {{ (old("roles[{++$i}]", isset($user_roles[$role->id])?true:false) == $role->id) ? 'checked="checked"':null }}  value="{{$role->id}}" class="custom-checkbox">
                                        {{strtoupper($role->name)}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>


            <div class="panel-footer">
                <div class="text-center pad20A mrg25T">
                    <button type="submit" class="btn btn-lg btn-primary">{{!empty($user->id)?'Update':'Create'}}</button>
                </div>
            </div>
        </form>
    </div>


@endsection