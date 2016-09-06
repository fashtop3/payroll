
@extends('app')

@section('content')

    <div id="page-title">
        <h2>Dashboard</h2>
        <p>Update profile information.</p>
    </div>

    <div class="panel">
            <div class="panel-body">
                <h3 class="title-hero">
                    Personal Information
                </h3>

                <form action="{{URL::route('profile.update')}}" method="POST" class="form-horizontal pad15L pad15R bordered-row">
                    @if(Session::has('update_message'))
                        <div class="alert alert-success">
                            {{ Session::get('update_message') }}
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    {{csrf_field()}}
                    <div class="form-group remove-border">
                        <label class="col-sm-3 control-label">First Name:</label>
                        <div class="col-sm-6">
                            <input name="firstname" type="text" class="form-control" id="" value="{{Auth::user()->firstname}}" placeholder="First name...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Last Name:</label>
                        <div class="col-sm-6">
                            <input type="text" name="lastname" class="form-control" id="" value="{{Auth::user()->lastname}}" placeholder="Last name...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Email:</label>
                        <div class="col-sm-6">
                            <input type="text" disabled class="form-control" id="" value="{{Auth::user()->email}}" placeholder="Email address...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Mobile:</label>
                        <div class="col-sm-6">
                            <input type="text" name="mobile" class="form-control" id="" value="{{Auth::user()->mobile}}" placeholder="Mobile phone...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Address:</label>
                        <div class="col-sm-6">
                            <input type="text" name="address" class="form-control" id="" value="{{Auth::user()->address}}" placeholder="Address...">
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label class="col-sm-3 control-label">Profile Picture:</label>
                        <div class="col-sm-6">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="...">
                                    </span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="button-pane mrg20T">
                        <button type="submit" class="btn btn-info">Save</button>
                        <button class="btn btn-link font-gray-dark">Cancel</button>
                    </div>
                </form>

            </div>
    </div>

@endsection