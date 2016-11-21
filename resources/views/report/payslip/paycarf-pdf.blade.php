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
                        <h5 class="text-center col-sm-8 col-sm-offset-2">PAYSLIP</h5>
                        <span class="pull-right">Date <small class="small text-muted">{{\Carbon\Carbon::now()->toDateString()}}</small></span>
                    </div>
                    <br />
                    <br />
                    <div class="row col-sm-10 col-sm-offset-1 small">
                        <table width="100%" class="table borderless" >
                            <tr>
                                <td class="col-sm-4" valign="top">
                                    <div>
                                        <table class="table borderless">
                                            <tr><td class="text-right">Name</td><td class="text-muted">{{$profile->lastname.' '.$profile->middlename.' '.$profile->firstname}}</td></tr>
                                            <tr><td class="text-right">Address</td><td class="text-muted">{{$profile->address1}}</td></tr>
                                            <tr><td class="text-right">Employee No.</td><td class="text-muted">{{$profile->eid}}</td></tr>
                                            <tr><td class="text-right">Entry Date</td><td class="text-muted">{{$profile->created_at->format('M j, Y')}}</td></tr>
                                        </table>
                                    </div>
                                </td>
                                <td class="col-sm-4" valign="top">
                                    <div>
                                        <table class="table borderless">
                                            <tr><td class="text-right">Company Code</td><td class="text-muted">Grand Cereals Ltd.</td></tr>
                                            <tr><td class="text-right">Department</td><td class="text-muted">{{$profile->department->name}}</td></tr>
                                            {{--<tr><th>Personnel Area</th><td class="text-muted">{{$profile->account->routine_number}}</td></tr>--}}
                                            {{--<tr><th>Personnel Subarea</th><td class="text-muted">{{$profile->account->account_number}}</td></tr>--}}
                                            <tr><td class="text-right">Payroll Period</td><td class="text-muted">{{Carbon\Carbon::now()->format('M, Y')}}</td></tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="row col-sm-8 col-sm-offset-2 small well well-sm">
                        <table align="center" class="table borderless" style="width: 70%">
                            <tr>
                                <th>Payment/Deduct</th>
                                <th>DM</th>
                                <th class="text-right">Amount</th>
                                <th class="text-right">Amount</th>
                            </tr>
                            <tr><th colspan="4">PAYMENTS</th></tr>
                            <tbody>
                            <?php $total = 0; ?>
                            <?php $tax = (0.05)*$profile->userBasicId[0]->amount ?>
                            @foreach($profile->basisAmountsNotEmpty as $basicPay)
                                <?php $total += $basicPay->amount; ?>
                                <tr><td>{{$basicPay->basic->name}}</td><td></td><td class="text-right">{{number_format($basicPay->amount, 2)}}</td></tr>
                            @endforeach
                            <tr><td><strong>Total gross amount:</strong><td></td></td><td></td><td class="text-right"><strong>{{number_format($total-$tax, 2)}}</strong></td></tr>
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