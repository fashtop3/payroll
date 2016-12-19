
@extends('app')

@section('content')

    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

//            document.body.innerHTML = printContents;
            window.print();

//            document.body.innerHTML = originalContents;
        }
    </script>

    <div id="page-title" ng-init="closedSidebar = true">
        <h2>Report | <small>Department</small></h2>
        <p>{{strtoupper($department->name)}} reports.</p>
    </div>

    <div class="panel">
        <div class="panel-heading text-center info">PAYMENT AND DEDUCTION ANALYSIS FOR (<strong class="text-inverse">{{strtoupper($department->name)}} DEPARTMENT</strong>): <strong>{{$sort_date->format('M, Y')}}</strong></div>
        <div id="printableArea" class="panel-body">

            <div class="table-responsive">
                <table class="table table-striped">
                    <tr class="font-size-13">
                        <th class="info">STAFF ID</th>
                        <th>STAFF NAME</th>
                        @foreach($basics as $basic)
                            <th class="text-right">{{strtoupper($basic->name)}}</th>
                        @endforeach
                        <th class="text-right">OVERTIME</th>
                        <th class="text-right">SHIFT</th>
                        <th class="info text-right">NET PAY</th>
                    </tr>
                    <tbody class="font-size-12">
                        <?php
                            use App\Employee\PayType;
                            use Illuminate\Support\Facades\DB;
                            use App\Http\Controllers;
                            $i = 1;
                            $net_pay = 0;
                            $basic_grands = array_fill(1,(count($basics)), 0); // fill arrays with zeros
                            $shift_grands = 0;
                            $overtime_grands = 0;
                            $netpay_grands = 0;
                        ?>

                        <?php $net_pay = 0;?>
                        @foreach($department->profiles as $profile)
                        <tr>
                            <td class="info text-warning">{{$profile->eid}}</td>
                            <td>{{strtoupper($profile->firstname.' '.$profile->lastname)}}</td>
                            @foreach($basics as $basic)
                                <?php
                                    $amount = 0;
//                                    if($basic->id == 1)
//                                    {
////                                        DB::connection()->enableQueryLog();
//                                        //get all the transactioms user has for the month
//                                        $amount_basic = DB::select("SELECT SUM(total) AS total FROM rateables WHERE profile_id IN($profile->id) AND basic_id = {$basic->id} AND umonth = '{$sort_date->format('Y-m')}'");
////                                        Log::debug(DB::getQueryLog());
//                                        $amount = $amount_basic[0]->total;
//                                    }
//                                    else
//                                    {
                                        //get the basis where id is not 1
                                        $basis_amount = \App\Employee\BasicUserAmt::whereProfileId($profile->id)->whereBasicId($basic->id)->first();
                                        if($basis_amount)
                                        {
                                            if(preg_match('/(.*)Deduction(.*)/i', $basic->name))
                                                $amount = 0 - $basis_amount->amount;
                                            else
                                                $amount = $basis_amount->amount;
                                        }
//                                    }

                                    $basic_grands[$basic->id] += (float) $amount; //sums for column
                                    $net_pay += (float) $amount; //sum amount for every row
                                ?>
                                <td class="text-right">{{number_format($amount, 2)}}</td>
                            @endforeach
                            <?php
                                $amount_overtime = DB::select("SELECT SUM(total) AS total FROM rateables WHERE profile_id IN($profile->id) AND paytype_id IN(3,4,5) AND umonth = '{$sort_date->format('Y-m')}'");
                                $amount_shift = DB::select("SELECT SUM(total) AS total FROM rateables WHERE profile_id IN($profile->id) AND paytype_id IN(1,2) AND umonth = '{$sort_date->format('Y-m')}'");
                                $net_pay += (float) $amount_overtime[0]->total;
                                $net_pay += (float) $amount_shift[0]->total;
                                $shift_grands +=  (float) $amount_shift[0]->total;
                                $overtime_grands +=  (float) $amount_overtime[0]->total;

                                $net_pay += (5/100)*$net_pay; // add %5 of total
                                $netpay_grands += $net_pay; //sum net pay
                            ?>
                            <td class="text-right">{{number_format($amount_overtime[0]->total, 2)}}</td>
                            <td class="text-right">{{number_format($amount_shift[0]->total, 2)}}</td>
                            <td class="info text-warning text-right">{{number_format($net_pay, 2)}}</td>
                        </tr>
                        @endforeach
                        <tr class="font-purple">
                            <td class="info"></td>
                            <td class="">GRAND TOTAL</td>
                            @foreach($basic_grands as $basic_grand)
                                <td class=" text-right">{{number_format($basic_grand, 2)}}</td>
                            @endforeach
                            <td class=" text-right">{{number_format($overtime_grands, 2)}}</td>
                            <td class=" text-right">{{number_format($shift_grands, 2)}}</td>
                            <td class=" text-right">{{number_format($netpay_grands, 2)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mar20B row">
                <button id="print-button" onclick="printDiv('printableArea')" class="btn btn-primary col-sm-1 col-sm-offset-11">Print</button>
            </div><br />
        </div><!--end: panelbody-->
    </div>

@endsection