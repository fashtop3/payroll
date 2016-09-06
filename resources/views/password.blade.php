
@extends('app')

@section('content')

    <div id="page-title">
        <h2>Dashboard</h2>
        <p>Update account password.</p>
    </div>

    <div class="panel">
            <div class="panel-body">
                <h3 class="title-hero">
                    Change account password
                </h3>

                <form action="{{URL::route('password.change')}}" method="POST" class="form-horizontal pad15L pad15R bordered-row">
                    @if(Session::has('update_message'))
                        <div class="alert alert-success">
                            {{ Session::get('update_message') }}
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @elseif (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{csrf_field()}}
                    <div class="form-group remove-border">
                        <label class="col-sm-3 control-label">Current Password:</label>
                        <div class="col-sm-6">
                            <input type="password" name="current_password" class="form-control" id="" placeholder="Current password...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">New Password:</label>
                        <div class="col-sm-6">
                            <input type="password" name="new_password" class="form-control" id="" placeholder="New Password...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Confirm Password:</label>
                        <div class="col-sm-6">
                            <input type="password" name="confirm_password" class="form-control" id="" placeholder="Confirm Password...">
                        </div>
                    </div>
                    <div class="button-pane mrg20T">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </form>

            </div>
    </div>

@endsection