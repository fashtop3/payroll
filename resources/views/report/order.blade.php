
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
                            <tr><th class="text-sm-left">Employee ID</th><th>Employee Name</th> <th>Account No.</th> <th>Net Pay</th></tr>
                            <tbody>
                            @foreach($bank->accounts as $account)
                                <tr>
                                    <td>{{$account->profile->eid}}</td>
                                    <td>{{strtoupper($account->profile->lastname.' '. $account->profile->middlename.' '. $account->profile->firstname)}}</td>
                                    <td>{{$account->account_number}}</td>
                                    <td>{:request}</td>
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