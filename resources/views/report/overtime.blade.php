
@extends('app')

@section('content')

    <div id="page-title" ng-init="closedSidebar = true">
        <h2>Report | Overtime</h2>
        <p>Overtime reports.</p>
    </div>

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Sort with date</h4>
                </div>
                <form class="form-horizontal" action="{{route('report.overtime')}}" method="GET">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-5">
                                <select name="year" id="" class="form-control">
                                    @for($i=2010; $i<=2030; $i++)
                                        <option {{ Request::get('year', 2016) == $i ? 'selected':'' }} value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <select name="month" id=""  class="form-control">
                                    @for($i=1; $i<=12; $i++)
                                        <?php $m = str_pad($i, 2, 0, STR_PAD_LEFT); ?>
                                        <option {{ $sort_date->format('Y') == $i ? 'selected':''}} value="{{$m}}">{{\Carbon\Carbon::createFromDate(2016, $m)->format('M')}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Query</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading text-center info">OVERTIME REPORT: <a href="#" data-toggle="modal" data-target=".bs-example-modal-sm"><strong>{{$sort_date->format('M, Y')}} <em class="glyph-icon text-primary icon-edit"></em></strong></a></div>
        <div class="panel-body">
            <div>
                <table class="table">
                    <thead>
                        <th colspan="3"></th>
                        <th colspan="3" class="text-center">NORMAL DAY</th>
                        <th colspan="3" class="text-center">SATURDAY</th>
                        <th colspan="3" class="text-center">SUNDAY/PUBLIC HOLIDAY</th>
                        <th></th>
                    </thead>
                    <tbody>
                    <?php
                            use Illuminate\Support\Facades\DB;
                                $i = 1;
                                $net_amount = 0;
                                $total_staff = 0;
                    ?>
                    <tr class="font-size-13">
                        <th>S/No</th>
                        <th>ID</th>
                        <th>Employee Name</th>
                        <th class="text-center">Hours</th>
                        <th class="text-right">Rate</th>
                        <th class="warning text-right">Amount</th>
                        <th class="text-center">Hours</th>
                        <th class="text-right">Rate</th>
                        <th class="warning text-right">Amount</th>
                        <th class="text-center">Hours</th>
                        <th class="text-right">Rate</th>
                        <th class="warning text-right">Amount</th>
                        <th class="text-right">Total</th>
                    </tr>
                    <?php $sn = 1; ?>
                    @foreach($departments as $department)
                        <tr class="warning font-size-12"><th colspan="3">{{strtoupper($department->name)}}</th></tr>
                        @foreach($department->profiles as $profile)
                            <tr class="font-size-12"><td>{{$sn++}}</td><td>{{strtoupper($profile->eid)}}</td><td>{{strtoupper($profile->lastname.' '.$profile->middlename.' '.$profile->firstname)}}</td>
                                <!-- Normal Day -->
                                <?php
                                    $total_amount = 0;
                                    $normal_day_hours = 0;
                                    $basic_amount = 0;
                                    $shift_id = 3; //NORMAL DAY

                                    /* Get the users basic amount assigned when registering */
                                    if($basic = $profile->basicPay()->first())
                                    {
                                        $basic_amount = $basic->amount;
                                    }

                                    /* Get the number working days staff worked for */
                                    if($work = $profile->workShift($shift_id, $sort_date->format('Y-m'))->first())
                                    {
                                        $normal_day_hours = $work->durations; //
                                    }
                                    $rate = $profile->resolveShiftRate($shift_id, $basic_amount);
                                    $day_amount = $rate * $normal_day_hours;
                                    $total_amount += $day_amount;
                                ?>
                                <td class="text-center">{{$normal_day_hours}}</td>
                                <td class="text-right">{{number_format($rate, 2)}}</td>
                                <td class="warning text-right">{{number_format($day_amount, 2)}}</td>

                                <!-- Saturday -->
                                <?php
                                    $shift_id  = 4; //SATURDAY
                                    $saturday_hours = 0;
                                    if($work = $profile->workShift($shift_id, $sort_date->format('Y-m'))->first())
                                    {
                                        $saturday_hours = $work->durations;//->hours;
                                    }
                                    $rate = $profile->resolveShiftRate($shift_id, $basic_amount);
                                    $night_amount = $rate * $saturday_hours;
                                    $total_amount += $night_amount;
                                ?>
                                <td class="text-center">{{$saturday_hours}}</td>
                                <td class="text-right">{{number_format($rate, 2)}}</td>
                                <td class="warning text-right">{{number_format($night_amount, 2)}}</td>

                                <!-- SUNDAY/PUBLIC HOLIDAY -->
                                <?php
                                    $shift_id  = 5; //SUNDAY/PUBLIC HOLIDAY
                                    $special_day_hours = 0;
                                    if($work = $profile->workShift($shift_id, $sort_date->format('Y-m'))->first())
                                    {
                                        $special_day_hours = $work->durations;//->hours;
                                    }
                                    $rate = $profile->resolveShiftRate($shift_id, $basic_amount);
                                    $night_amount = $rate * $special_day_hours;
                                    $total_amount += $night_amount;
                                ?>
                                <td class="text-center">{{$special_day_hours}}</td>
                                <td class="text-right">{{number_format($rate, 2)}}</td>
                                <td class="warning text-right">{{number_format($night_amount, 2)}}</td>
                                <td class="text-right">{{number_format($total_amount, 2)}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection