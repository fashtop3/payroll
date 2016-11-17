@extends('app')

@section('content')

    <div id="page-title">
        <h2>Employee Profiles</h2>
        <p>List of employee profiles.</p>
    </div>

    <div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">
                Profiles
                @if(Request::get('dept_id', -1) != -1)
                    <strong>({{ \App\Department::find(Request::get('dept_id'))->name  }})</strong>
                @endif
            </h3>

            <div class="mrg20B">
                <div class="pull-right">
                    <form class="form form-inline" action="{{route('employee.profiles')}}" method="GET">
                        <div class="form-group">
                            <select class="form-control" name="dept_id">
                                <option value="-1">--Department--</option>
                                <option value="-1">--All--</option>
                                @foreach(\App\Department::all() as $department)
                                    <option {{ Request::get('dept_id', -1) == $department->id ? 'selected':'' }} value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="status">
                                <option value="-1">--Status--</option>
                                <option value="-1">All</option>
                                <option {{ Request::get('status', -1) == 1 ? 'selected':'' }} value="1">Active</option>
                                <option {{ Request::get('status', -1) == 0 ? 'selected':'' }} value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="example-box-wrapper">

                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr class="font-size-13">
                            <th>Employee ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Active</th>
                            <th>Approved</th>
                            <th colspan="3"></th>
                        </tr>
                        <tbody class="font-size-12">
                        @if(count($profiles))
                            @foreach($profiles as $profile)
                                <tr class="gradeX">
                                    <td><a href="{{route('employee.view', ['id'=>$profile->id])}}">{{$profile->eid}}</a></td>
                                    <td>{{$profile->lastname.', '.$profile->firstname.' '.$profile->middlename}}</td>
                                    <td>{{$profile->email}}</td>
                                    <td class="text-center">{{$profile->mobile_phone}}</td>
                                    <td class="text-center"><span class="label {{$profile->active ? 'label-purple' : 'label-danger'}} ">{{$profile->active ? 'Y' : 'N'}}</span></td>
                                    <td class="text-center"><span class="label {{$profile->approved ? 'label-purple' : 'label-danger'}} ">{{$profile->approved ? 'Y' : 'N'}}</span></td>
                                    <td><a href="" class="btn btn-primary btn-xs">View</a></td>
                                    <td><a href="{{route('employee.edit', ['id'=>$profile->id])}}" class="btn btn-warning btn-xs">Edit</a></td>
                                    <td><a href="" class="btn btn-danger btn-xs">Delete</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center warning">No result found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="pull-right">{{ $profiles->appends(Request::all())->links() }}</div>
            </div>
        </div>
    </div>


@endsection