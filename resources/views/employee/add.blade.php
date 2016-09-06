
@extends('app')

@section('content')

    <div id="page-title">
        <h2>New Employee Profile</h2>
        <p>create new staff profile.</p>
    </div>

    <div class="panel">
        <form action="{{ !empty($profile->id) ? route('employee.update', ['id'=>$profile->id]) : route('employee.store')}}" method="POST" class="form-horizontal bordered-row" name="employeeForm" id="demo-form" novalidate>
            @if(!empty($profile->id))
                <input type="hidden" name="_method" value="PUT" />
            @endif
            {{ csrf_field() }}
            <div class="panel-body">
                <h3 class="title-hero">
                    Profile
                </h3>
                <div class="example-box-wrapper">
                    <div id="form-wizard-3" class="form-wizard">
                        <ul>
                            <li>
                                <a href="#step-1" data-toggle="tab">
                                    <label class="wizard-step">1</label>
                          <span class="wizard-description">
                             User details
                             <small>Gather the user details</small>
                          </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-2" data-toggle="tab">
                                    <label class="wizard-step">2</label>
                          <span class="wizard-description">
                             Dates
                             <small>Confirm Dates details</small>
                          </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-3" data-toggle="tab">
                                    <label class="wizard-step">3</label>
                          <span class="wizard-description">
                             Personal
                             <small>Gather the user details</small>
                          </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-4" data-toggle="tab">
                                    <label class="wizard-step">4</label>
                          <span class="wizard-description">
                             Account
                             <small>Account Details</small>
                          </span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" ng-controller="EmployeeProfileController" ng-init="initProfile({{ $profile ?: $profile->toJson()}})">
                            @if(Session::has('flash_message'))
                                <div class="alert alert-success">
                                    {{ Session::get('flash_message') }}
                                </div>
                            @elseif(Session::has('update_message'))
                                <div class="alert alert-success">
                                    {{ Session::get('update_message') }}
                                </div>
                            @elseif(Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            <div class="tab-pane active" id="step-1">
                                <div class="content-box">
                                    <h3 class="content-box-header bg-default">
                                        User details
                                    </h3>
                                    <div class="content-box-wrapper">
                                        @include('employee.views.user-details')
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="step-2">
                                <div class="content-box">
                                    <h3 class="content-box-header bg-black">
                                        Dates
                                    </h3>
                                    <div class="content-box-wrapper">
                                        @include('employee.views.dates')
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="step-3">
                                <div class="content-box">
                                    <h3 class="content-box-header bg-green">
                                        Personal
                                    </h3>
                                    <div class="content-box-wrapper">
                                        @include('employee.views.personal')
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="step-4">
                                <div class="content-box">
                                    <h3 class="content-box-header bg-blue">
                                        Account
                                    </h3>
                                    <div class="content-box-wrapper">
                                        @include('employee.views.account')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="text-center pad20A mrg25T">
                    <button ng-disabled="employeeForm.$invalid" type="submit" class="btn btn-lg btn-primary">{{!empty($profile->id)?'Update':'Create'}}</button>
                    {{--<button type="submit" class="btn btn-lg btn-primary">Create</button>--}}
                </div>
            </div>
        </form>
    </div>
@endsection