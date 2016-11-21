@extends('app')

@section('content')

    <div id="page-title">
        <h2>PaySlip/Paycarf</h2>
        <p>Departments.</p>
    </div>

    <div class="panel">
        <div class="panel-body">

            <div class="mar20B">
                <div class="text-center">
                    <form action="{{''}}" method="GET" class="form form-inline">
                        {{--<input type="hidden" name="action" value="query" />--}}
                        <div class="form-group">
                            <button target="_blank" class="btn btn-info" type="submit"  name="action" value="download">Download PayCarf</button>
                        </div>                       <div class="form-group">
                            <select class="form-control" name="dept_id" id="">
                                <option value="-1">--Department--</option>
                                @foreach(\App\Department::all() as $dept)
                                    <option {{ Request::get('dept_id', -1)==$dept->id ? 'selected':'' }} value="{{$dept->id}}">{{$dept->name}}</option>
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
                            <button target="_blank" class="btn btn-primary" type="submit"  name="action" value="download">Download PaySlip</button>
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

            @if($department)
            <table class="table table-striped">
                <tr class="font-size-13">
                    <th>FULL NAME</th>
                    <th>REGISTERED</th>
                    <th colspan="2"></th>
                </tr>
                <tbody class="font-size-12">

                        @if($profiles)
                            @forelse($profiles as $profile)
                                <tr>
                                    <td>{{$profile->firstname.' '. $profile->lastname.' '. $profile->middlename}}</td>
                                    <td>{{$profile->created_at->format('D, M j, Y')}}</td>
                                    <td><a href="{{route('report.payslip.upc', $profile->id)}}?action=print" class="btn btn-xs btn-info">Print PayCarf</a></td>
                                    <td><a href="{{route('report.payslip.ups', $profile->id)}}?action=print" class="btn btn-xs btn-primary">Print PaySlip</a></td>
                                </tr>
                            @endforeach
                        @endif

                </tbody>
            </table>

            <div class="pull-right">{{ $profiles->appends(Request::all())->links() }}</div>
            <div class="clearfix"></div>

            @endif
        </div>
    </div>

@endsection