@extends('app')

@section('content')

    <div id="page-title">
        <h2>User Support</h2>
        <p>Departments.</p>
    </div>

    <div class="panel">
        <div class="panel-body">

            <div class="mar20B">
                <div class="pull-right">
                    <a class="btn btn-success" href="{{route('department.create')}}"><em class="glyph-icon icon-plus-square"></em> Add new department</a>
                </div>
                <div class="clearfix"></div>
            </div>

            <h3 class="title-hero"></h3>

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {!! Session::get('success') !!}
                </div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">
                    <strong>Error!</strong> {!! Session::get('error') !!}
                </div>
            @endif

            <table class="table">
                <tr class="font-size-13">
                    <th>S/N</th>
                    <th>DEPARTMENT</th>
                    <th>STAFF(s)</th>
                    <th>CREATED AT</th>
                    <th colspan="2"></th>
                </tr>
                <tbody class="font-size-12">
                    <?php $i = 1; ?>
                    @foreach($departments as $department)
                        <tr>
                            <td>{{$i++}}</td>
                            <td><a href="{{route('employee.profiles')}}?dept_id={{$department->id}}&status=-1">{{ucfirst($department->name)}}</a> @if($department->deleted_at) <a class="btn btn-primary btn-xs" href="{{route('department.restore',$department->id)}}">restore</a> @endif </td>
                            <td><a href="{{route('employee.profiles')}}?dept_id={{$department->id}}&status=-1">{{ $department->profiles->count() }}</a></td>
                            <td>{{$department->created_at->diffForHumans()}}</td>
                            <td><a href="{{route('department.edit', ['id'=>$department->id])}}" class="btn btn-xs btn-primary">Edit</a></td>

                            <td>@if(!$department->deleted_at)
                                <a href="{{route('department.delete', ['id'=>$department->id])}}" class="btn btn-xs btn-danger">Delete</a>
                            @endif</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection