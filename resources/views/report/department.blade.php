
@extends('app')

@section('content')

    <div id="page-title">
        <h2>Report | <small>Departments</small></h2>
        <p>Departmental reports.</p>
    </div>

    <div class="panel">
        <div class="panel-heading text-center info">PAYMENT AND DEDUCTION ANALYSIS FOR (<strong class="text-inverse">{{strtoupper($department->name)}} DEPARTMENT</strong>): <strong>{{$sort_date->format('M, Y')}}</strong></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th class="info">STAFF ID</th>
                        <th>STAFF NAME</th>
                        @foreach($basics as $basic)
                            <th class="text-right">{{strtoupper($basic->name)}}</th>
                        @endforeach
                        <th class="text-right">OVERTIME</th>
                        <th class="text-right">SHIFT</th>
                        <th class="info text-right">NET PAY</th>
                    </tr>
                    <tbody>
                        <?php
                            use Illuminate\Support\Facades\DB;
                            $i = 1;
                            $net_pay = 0;
                            $basic_grands = [];
                            $shift_grands = 0;
                            $overtime_grands = 0;
                            $netpay_grands = 0;
                        ?>

                        <?php $net_pay = 0;?>
                        @foreach($department->profiles as $profile)
                        <tr>
                            <td class="info text-warning"><a href="">{{$profile->eid}}</a></td>
                            <td><a href="{{route('report.department.view', $department->id)}}?sort={{$sort_date->format('Y-m')}}">{{strtoupper($profile->firstname.' '.$profile->lastname)}}</a></td>
                            @foreach($basics as $basic)
                                <?php
                                    $amount_basic = DB::select("SELECT SUM(total) AS total FROM rateables WHERE profile_id IN($profile->id) AND basic_id = {$basic->id} AND umonth = '{$sort_date->format('Y-m')}'");
                                    $net_pay += (float) $amount_basic[0]->total;
                                    if(isset($basic_grands[$basic->id])) {
                                        $basic_grands[$basic->id] += (float) $amount_basic[0]->total;
                                    }
                                    else {
                                        $basic_grands[$basic->id] = 0;
                                        $basic_grands[$basic->id] += (float) $amount_basic[0]->total;
                                    }
                                ?>
                                <td class="text-right">{{number_format($amount_basic[0]->total, 2)}}</td>
                            @endforeach
                            <?php
                                $amount_overtime = DB::select("SELECT SUM(total) AS total FROM rateables WHERE profile_id IN($profile->id) AND paytype_id IN(3,4,5) AND umonth = '{$sort_date->format('Y-m')}'");
                                $amount_shift = DB::select("SELECT SUM(total) AS total FROM rateables WHERE profile_id IN($profile->id) AND paytype_id IN(1,2) AND umonth = '{$sort_date->format('Y-m')}'");
                                $net_pay += (float) $amount_overtime[0]->total;
                                $net_pay += (float) $amount_shift[0]->total;
                                $shift_grands +=  (float) $amount_shift[0]->total;
                                $overtime_grands +=  (float) $amount_overtime[0]->total;

                                $net_pay -= (5/100)*$net_pay;
                                $netpay_grands += $net_pay;
                            ?>
                            <td class="text-right">{{number_format($amount_overtime[0]->total, 2)}}</td>
                            <td class="text-right">{{number_format($amount_shift[0]->total, 2)}}</td>
                            <td class="info text-warning text-right">{{number_format($net_pay, 2)}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="info"></td>
                            <td class="text-primary">GRAND TOTAL</td>
                            @foreach($basic_grands as $basic_grand)
                                <td class="text-primary text-right">{{number_format($basic_grand, 2)}}</td>
                            @endforeach
                            <td class="text-primary text-right">{{number_format($overtime_grands, 2)}}</td>
                            <td class="text-primary text-right">{{number_format($shift_grands, 2)}}</td>
                            <td class="text-primary text-right">{{number_format($netpay_grands, 2)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection