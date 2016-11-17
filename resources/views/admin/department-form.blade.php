
@extends('app')

@section('content')

    <div id="page-title">
        <h2>User Support</h2>
        <p>Add/Update Department.</p>
    </div>

    <div class="panel">
        <form action="{{isset($department->id)?route('department.edit', ['id'=>$department->id]):route('department.create')}}" class="form-horizontal" method="post">
            {{csrf_field()}}
            <div class="panel-body">
                <h3 class="title-hero">
                    Add/Update Department.
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


                <div class="bordered-row mrg20B">

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Department Name <abbr class="text-danger" title="required">*</abbr></label>
                            <div class="col-sm-5">
                                <input type="text" value="{{old('name', isset($department->name)?$department->name:null) }}" class="form-control" placeholder="Department Name" name="name" />
                            </div>
                        </div>

                </div>


            <div class="panel-footer">
                <div class="text-center pad20A mrg25T">
                    <button type="submit" class="btn btn-lg btn-primary">{{!empty($department->id)?'Update':'Create'}}</button>
                </div>
            </div>
        </form>
    </div>


@endsection