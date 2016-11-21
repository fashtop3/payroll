<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Payslip | {{$profile->lastname}} | {{$profile->firstname}} | {{$profile->eid}} </title>
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
                    <div class="row col-sm-8 col-sm-offset-2 small">
                        <table width="100%" class="borderless" >
                            <tr>
                                <td class="col-sm-7" valign="top">
                                    <div>
                                        <table class="table table-striped borderless">
                                            <tr><th>{{$profile->eid}}</th><td class="text-muted">{{$profile->lastname.' '.$profile->middlename.' '.$profile->firstname}}</td></tr>
                                            <tr><th>DIVISION</th><td class="text-muted">Contract</td></tr>
                                            <tr><th>DEPARTMENT</th><td class="text-muted">{{$profile->department->name}}</td></tr>
                                        </table>
                                    </div>
                                </td>
                                <td class="col-sm-3" valign="top">
                                    <div>
                                        <table class="table table-striped borderless">
                                            <tr><th>Bank</th><td class="text-muted">{{$profile->account->bank->name}}</td></tr>
                                            <tr><th>Address</th><td class="text-muted">{{$profile->account->bank_address}}</td></tr>
                                            <tr><th>Branch</th><td class="text-muted">{{$profile->account->routine_number}}</td></tr>
                                            <tr><th>Account No</th><td class="text-muted">{{$profile->account->account_number}}</td></tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="row ">
                        <h5 class="text-center col-sm-12">Payslip for the month of: <small class="small">April 2016</small></h5>
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
                                <?php $total += $basicPay->amount; ?>
                                <tr><td>{{$basicPay->basic->name}}</td><td class="text-right">{{number_format($basicPay->amount, 2)}}</td></tr>
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