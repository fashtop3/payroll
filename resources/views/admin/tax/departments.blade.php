@extends('app')

@section('content')

    <div id="page-title">
        <h2>Tax Report</h2>
        <p>Departments.</p>
    </div>

    <div class="panel">
        <div class="panel-body">

            <div class="mar20B">
                <div class="pull-right">
                    <form action="{{''}}" method="GET" class="form form-inline">
                        {{--<input type="hidden" name="action" value="query" />--}}
                        <div class="form-group">
                            <select class="form-control" name="dept_id" id="">
                                <option value="-1">--Department--</option>
                                @foreach(\App\Department::all() as $department)
                                    <option {{ Request::get('dept_id', -1)==$department->id ? 'selected':'' }} value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="year" id="" required>
                                <option value="-1">--Year--</option>
                                @for($i = 2010; $i < 2030; $i++)
                                    <option {{ Request::get('year', -1)==$i ? 'selected':'' }} value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="month" id="">
                                <option value="-1">--month--</option>
                                @for($i = 1; $i < 13; $i++)
                                    <option {{ Request::get('month', -1)==$i ? 'selected':'' }} value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit" name="action" value="query">Query</button>
                            <button class="btn btn-info" type="submit"  name="action" value="download">Download</button>
                        </div>
                    </form>
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

            <table class="table table-striped">
                <tr class="font-size-13">
                    <th>PERSONNEL NUMBER</th>
                    <th>COMPANY CODE ID</th>
                    <th>COMPANY CODE DESCRIPTION</th>
                    <th>DEPARTMENT</th>
                    <th>EMPLOYEE NAME</th>
                    <th>REGION</th>
                    <th>TAX PAYMENT</th>
                </tr>
                <tbody class="font-size-12">
                    @if(count($departments))
                        <?php $total_tax = 0; ?>
                        @foreach($departments as $department)
                            <?php $dept_tax = 0; ?>
                            @if($department->profiles->count())
                                @foreach($department->profiles as $profile)
                                    <?php
                                    $dept_tax += $tax = $profile->tax();
                                    ?>
                                    <tr>
                                        <td>{{$profile->eid}}</td>
                                        <td>5000</td>
                                        <td>Grand Cereals Ltd.</td>
                                        <td><strong>{{$department->name}}</strong></td>
                                        <td>{{$profile->firstname.' '. $profile->lastname.' '. $profile->middlename}}</td>
                                        <td>{{$profile->personal->payeStateName()}}</td>
                                        <td class="text-right">-{{number_format($tax, 2)}}</td>
                                    </tr>
                                @endforeach
                                <?php $total_tax += $dept_tax; ?>
                                <tr class="text-primary info"><td colspan="6"></td><td class="text-right">-{{number_format($dept_tax, 2)}}</td></tr>
                            @endif
                        @endforeach

                        @if($total_tax>0)
                            <tr class="text-primary success"><td colspan="6"></td><td class="text-right">-{{number_format($total_tax, 2)}}</td></tr>
                        @endif
                    @else
                        <tr><td class="text-center info" colspan="7">No record found.</td></tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>

@endsection