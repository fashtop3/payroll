<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Payslip | {{Carbon\Carbon::now()->format('M, Y')}} </title>
    <meta name="description" content="">


    <link rel="stylesheet" type="text/css" href="{{asset("assets/bootstrap/css/bootstrap.min.css")}}">

    <style type="text/css">
        .borderless td, .borderless th {
            border: none !important;
        }
    </style>
</head>
<body>

<div class="jumbotron">

    <div class="content">
        <div class="row">
            <div class="panel col-sm-10 col-sm-offset-1">
                <div class="panel-body">
                    <div class="row page-header">
                        <h4 class="text-center col-sm-12">GRAND CEREALS LIMITED</h4>
                        <h4 class="text-center col-sm-12">KM 17 ZAWAN ROUNDABOUT, JOS PLATEAU STATE </h4>
                    </div>
                    <br />
                    <br />
                    <div class="row col-sm-9 col-sm-offset-1 small">
                        <table width="100%" class="borderless" >
                            <tr>
                                <td class="col-sm-5" valign="top">
                                    <div>
                                        <table class="table borderless">
                                            <tr><td class="text-right">{{$profile->eid}}</td><td class="text-muted">{{$profile->lastname.' '.$profile->middlename.' '.$profile->firstname}}</td></tr>
                                            <tr><td class="text-right">Division</td><td class="text-muted">Contract</td></tr>
                                            <tr><td class="text-right">Department</td><td class="text-muted">{{$profile->department->name}}</td></tr>
                                        </table>
                                    </div>
                                </td>
                                <td class="col-sm-4" valign="top">
                                    <div>
                                        <table class="table borderless">
                                            <tr><td class="text-right">Bank</td><td class="text-muted">{{$profile->account->bank->name}} and this name</td></tr>
                                            <tr><td class="text-right">Address</td><td class="text-muted">{{$profile->account->bank_address}}</td></tr>
                                            <tr><td class="text-right">Branch</td><td class="text-muted">{{$profile->account->routine_number}}</td></tr>
                                            <tr><td class="text-right">Account No</td><td class="text-muted">{{$profile->account->account_number}}</td></tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="row ">
                        <h5 class="text-center col-sm-12">Payslip for the month of: <span class="text-muted">{{Carbon\Carbon::now()->format('M, Y')}}</span></h5>
                    </div>

                    <div class="row col-sm-8 col-sm-offset-2 small well well-sm">
                        <table align="center" class="table borderless" style="width: 70%">
                            <tr>
                                <th>Description</th>
                                <th class="text-right">Amount</th>
                            </tr>
                            <tbody>
                            <?php $total = 0; ?>
                            <?php $tax = (0.05)*$profile->userBasicId[0]->amount ?>
                            @foreach($profile->basisAmountsNotEmpty as $basicPay)
                                <?php

                                    if(preg_match('/(.*)Deduction(.*)/i', $basicPay->basic->name)) {
                                        $amt = -$basicPay->amount;
                                        $total += $amt;
                                    }
                                    else {
                                        $amt = $basicPay->amount;
                                        $total += $amt;
                                    }

                                ?>
                                <tr><td>{{$basicPay->basic->name}}</td><td class="text-right">{{number_format($amt, 2)}}</td></tr>
                            @endforeach
                            <tr><td>TAX(Basic)</td><td>-{{number_format($tax, 2)}}</td></tr>
                            <tr><td><strong>Total payment for the month:</strong></td> <td class="text-right"><strong>{{number_format($total-$tax, 2)}}</strong></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>