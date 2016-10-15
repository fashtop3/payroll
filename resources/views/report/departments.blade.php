
@extends('app')

@section('content')
<!-- Bootstrap Modal -->

<!--<link rel="stylesheet" type="text/css" href="../../assets/widgets/modal/modal.css">-->
<!--<script type="text/javascript" src="../../assets/widgets/modal/modal.js"></script>-->

<!-- JS Interactions -->

<script type="text/javascript" src="{{asset('assets/widgets/interactions-ui/resizable.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/widgets/interactions-ui/draggable.js')}}"></script>
{{--<script type="text/javascript" src="../../assets/widgets/interactions-ui/sortable.js"></script>--}}
{{--<script type="text/javascript" src="../../assets/widgets/interactions-ui/selectable.js"></script>--}}

<!-- jQueryUI Dialog -->

<!--<link rel="stylesheet" type="text/css" href="../../assets/widgets/dialog/dialog.css">-->
<script type="text/javascript" src="{{asset('assets/widgets/dialog/dialog.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/widgets/dialog/dialog-demo.js')}}"></script>

    <div id="page-title" ng-init="closedSidebar = true">
        <h2>Report | <small>Departments</small></h2>
        <p>Departmental reports.</p>
    </div>


    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Sort with date</h4>
                </div>
                <form class="form-horizontal" action="{{route('report.department')}}" method="POST">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-5">
                                <select name="year" id="" class="form-control">
                                    @for($i=2016; $i<=2030; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <select name="month" id=""  class="form-control">
                                    @for($i=1; $i<=12; $i++)
                                        <?php $m = str_pad($i, 2, 0, STR_PAD_LEFT); ?>
                                        <option {{ $sort_date->format('m') == $i ? 'selected="selected"' :''  }} value="{{$m}}">{{\Carbon\Carbon::createFromDate(2016, $m)->format('M')}}</option>
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
        <div class="panel-heading text-center info">PAYMENT AND DEDUCTION ANALYSIS FOR: <a href="#" data-toggle="modal" data-target=".bs-example-modal-sm"><strong>{{$sort_date->format('M, Y')}} <em class="glyph-icon  icon-edit"></em></strong></a></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr class="font-size-13">
                        <th class="info">S/N</th>
                        <th>DEPARTMENT</th>
                        @foreach($basics as $basic)
                            <th class="text-right">{{strtoupper($basic->name)}}</th>
                        @endforeach
                        <th class="text-right">OVERTIME</th>
                        <th class="text-right">SHIFT</th>
                        <th class="info text-right">NET PAY</th>
                    </tr>
                    <tbody class="font-size-12">
                        <?php
                            use Illuminate\Support\Facades\DB;
                            $i = 1;
                            $net_pay = 0;
                            $basic_grands = array_fill(1, count($basics), 0);
                            $shift_grands = 0;
                            $overtime_grands = 0;
                            $netpay_grands = 0;
                        ?>
                        @foreach($departments as $department)
                            <?php $net_pay = 0;?>
                            <tr>
                                <td class="info text-warning">{{$i++}}</td>
                                <td><a href="{{route('report.department.view', $department->id)}}?sort={{$sort_date->format('Y-m')}}">{{$department->name}}</a></td>
                                @foreach($basics as $basic)
                                    <?php
                                        $amount = 0;
                                        if($basic->id == 1)
                                        {
                                            $basis = DB::select("SELECT SUM(total) AS total FROM rateables WHERE profile_id IN(SELECT id FROM profiles WHERE department_id = {$department->id}) AND basic_id = {$basic->id} AND umonth = '{$sort_date->format('Y-m')}'");
                                            $amount = $basis[0]->total;
                                        }
                                        else
                                        {
                                            //sum amount of users by basic_id
                                            $basis = DB::select("SELECT SUM(amount) AS amount FROM basic_user_amts WHERE profile_id IN (SELECT id FROM profiles WHERE department_id = {$department->id}) AND basic_id = {$basic->id}");
                                            $amount = $basis[0]->amount;
                                        }

                                        $basic_grands[$basic->id] += (float) $amount; //sums for columns
                                        $net_pay += (float) $amount; //sums for rows
                                    ?>
                                    <td class="text-right">{{number_format($amount, 2)}}</td>
                                @endforeach
                                <?php
                                    $amount_overtime = DB::select("SELECT SUM(total) AS total FROM rateables WHERE profile_id IN(SELECT id FROM profiles WHERE department_id = {$department->id}) AND paytype_id IN(3,4,5) AND umonth = '{$sort_date->format('Y-m')}'");
                                    $amount_shift = DB::select("SELECT SUM(total) AS total FROM rateables WHERE profile_id IN(SELECT id FROM profiles WHERE department_id = {$department->id}) AND paytype_id IN(1,2) AND umonth = '{$sort_date->format('Y-m')}'");
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
                    <tr class="font-purple">
                        <td></td>
                        <td>GRAND TOTAL</td>
                        @foreach($basic_grands as $basic_grand)
                            <td class=" text-right">{{number_format($basic_grand, 2)}}</td>
                        @endforeach
                        <td class=" text-right">{{number_format($overtime_grands, 2)}}</td>
                        <td class=" text-right">{{number_format($shift_grands, 2)}}</td>
                        <td class="text-right">{{number_format($netpay_grands, 2)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection