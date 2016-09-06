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
            </h3>
            <div class="example-box-wrapper">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="datatable-example">
                    <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Active</th>
                        <th>Approved</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($profiles as $profile)
                            <tr class="gradeX">
                                <td><a href="{{route('employee.view', ['id'=>$profile->id])}}">{{$profile->eid}}</a></td>
                                <td>{{$profile->lastname.'. '.$profile->firstname.' '.$profile->middlename}}</td>
                                <td>{{$profile->email}}</td>
                                <td class="text-center">{{$profile->mobile_phone}}</td>
                                <td class="text-center"><span class="label {{$profile->active ? 'label-purple' : 'label-danger'}} ">{{$profile->active ? 'Y' : 'N'}}</span></td>
                                <td class="text-center"><span class="label {{$profile->approved ? 'label-purple' : 'label-danger'}} ">{{$profile->approved ? 'Y' : 'N'}}</span></td>
                                <td><a href="{{route('employee.edit', ['id'=>$profile->id])}}" class="btn btn-warning">Edit</a></td>
                                <td><a href="" class="btn btn-danger">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">{{ $profiles->links() }}</div>
            </div>
        </div>
    </div>


@endsection