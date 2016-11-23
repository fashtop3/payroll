@extends('app')

@section('content')

    <div id="page-title" ng-init="closedSidebar = true">
        <h2>Tax Report</h2>
        <p>Departments.</p>
    </div>

    <div class="panel">
        <div class="panel-body">

            <div class="mar20B hide-print">
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
                            <select name="month" id=""  class="form-control">
                                <option value="-1">--Month--</option>
                                @for($i=1; $i<=12; $i++)
                                    <?php $m = str_pad($i, 2, 0, STR_PAD_LEFT); ?>
                                    <option {{ Request::get('month', -1)==$i ? 'selected':'' }} value="{{$m}}">{{\Carbon\Carbon::createFromDate(2016, $m)->format('M')}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit" name="action" value="query">Query</button>
                            <button target="_blank" class="btn btn-info" type="submit"  name="action" value="download">Download</button>
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
                    <th>REGISTERED</th>
                </tr>
                <tbody class="font-size-12">
                    @if(count($departments))
                        <?php $total_tax = 0; ?>
                        @foreach($departments as $department)
                            <?php $dept_tax = 0; ?>
                            @if($department->profiles->count())
                                @foreach($department->profiles as $profile)
                                    <?php
                                        if($profile->registeredDateHigher($year)) continue;
                                        if($profile->registeredDateHigher($year, $month)) continue;
                                        $dept_tax += $tax = $profile->tax($year, $month);
                                    ?>
                                    <tr>
                                        <td>{{$profile->eid}}</td>
                                        <td>5000</td>
                                        <td>Grand Cereals Ltd.</td>
                                        <td><strong>{{$department->name}}</strong></td>
                                        <td>{{$profile->firstname.' '. $profile->lastname.' '. $profile->middlename}}</td>
                                        <td>{{$profile->personal->payeStateName()}}</td>
                                        <td class="text-right">-{{number_format($tax, 2)}}</td>
                                        <td>{{$profile->created_at->format('D, M j, Y')}}</td>
                                    </tr>
                                @endforeach
                                <?php $total_tax += $dept_tax; ?>
                                @if($dept_tax>0)
                                    <tr class="text-primary info"><td>TOTAL</td><td colspan="5"></td><td class="text-right">-{{number_format($dept_tax, 2)}}</td><td></td></tr>
                                @endif
                            @endif
                        @endforeach

                        @if($total_tax>0)
                            <tr class="text-primary success"><td>GRAND TOTAL</td><td colspan="5"></td><td class="text-right">-{{number_format($total_tax, 2)}}</td><td></td></tr>
                        @endif
                    @else
                        <tr><td class="text-center info" colspan="7">No record found.</td></tr>
                    @endif
                </tbody>
            </table>

            <div class="mar20B row">
                <button id="print-button" onclick="window.print()" class="btn btn-primary col-sm-1 col-sm-offset-11">Print</button>
            </div><br />
        </div>
    </div>

@endsection