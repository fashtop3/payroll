
@extends('app')

@section('content')

    <div ng-controller="OrderController">
        <div class="panel">
            <div class="panel-body">

                <div>
                    <p>{{$sort_date->format('M, Y')}}</p>
                    <p class="pad5T">The Bank Manager</p>
                    <p class="pad5T">{{strtoupper($bank->name)}}</p>

                    <br />

                    <div><p class="mrg5A">JOS</p><p class="mrg5A">Dear Sir,</p></div>
                    <p class="h4 mrg20T mrg20B font-black"><strong>GRAND CEREALS LIMITED STAFF SALARY</strong></p>
                    <div>
                        <p class="mrg5A">Please Find enclosed here with our cheque No. dated: {date} for the sum of {sum} in respect of our {{$sort_date->format('M, Y')}} Staff salary.</p>
                        <p class="mrg5A">Please credit the accounts of the under-listed staff with appropriate amount</p>
                    </div>
                    <div class="mrg20A">
                        <table class="table">
                            <tr class="font-size-13"><th class="text-sm-left">Employee ID</th><th>Employee Name</th> <th>Account No.</th> <th class="text-right">Net Pay</th></tr>
                            <tbody class="font-size-12">
                            @foreach($bank->accounts as $account)
                                <tr>
                                    <td>{{$account->profile->eid}}</td>
                                    <td>{{strtoupper($account->profile->lastname.' '. $account->profile->middlename.' '. $account->profile->firstname)}}</td>
                                    <td>{{$account->account_number}}</td>
                                    <?php
                                        $rateable = DB::select("SELECT SUM(total) AS total FROM rateables WHERE profile_id IN(SELECT profile_id FROM accounts WHERE bank_id = {$bank->id}) AND umonth = '{$sort_date->format('Y-m')}'");
                                        $basis = DB::select("SELECT SUM(amount) AS total FROM basic_user_amts WHERE profile_id IN(SELECT profile_id FROM accounts WHERE bank_id = {$bank->id}) AND basic_id NOT IN (1)");
                                        $amount = $rateable[0]->total + $basis[0]->total;
                                        $amount -= (5/100)*$amount;
                                    ?>
                                    <td class="text-right">{{number_format($amount, 2)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mrg20T">
                        <p>Thanks for your usual Co-operation.<br />Yours Faithfully. <strong>For: GRAND CEREALS LIMITED</strong></p>
                    </div>
                </div>
                <div class="row mrg20A">
                    <div class="col-sm-6 text-center">AUTHORIZED SIGNATORY 1</div>
                    <div class="col-sm-6 text-center">AUTHORIZED SIGNATORY 2</div>
                </div>
                <div class="mrg20A pad20A"></div>

            </div>
        </div>
    </div>
@endsection