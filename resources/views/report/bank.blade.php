
@extends('app')

@section('content')

    <div id="page-title">
        <h2>Report | <small>Departments</small></h2>
        <p>Departmental reports.</p>
    </div>

    <div class="hide-print mrg20B">
        <div class="pull-right">
            <form class="form form-inline" action="{{route('report.bank')}}" method="GET">
                <div class="form-group">
                    <select name="year" id="" class="form-control">
                        @for($i=2010; $i<=2030; $i++)
                            <option {{ $sort_date->format('Y') == $i?'selected':'' }} value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <select name="month" id=""  class="form-control">
                        @for($i=1; $i<=12; $i++)
                            <?php $m = str_pad($i, 2, 0, STR_PAD_LEFT); ?>
                            <option {{ $sort_date->format('m') == $i ? 'selected="selected"' :''  }} value="{{$m}}">{{\Carbon\Carbon::createFromDate(2016, $m)->format('M')}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Query</button>
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="panel">
        <div class="panel-heading text-center info">BANK SCHEDULE FOR:<strong>{{$sort_date->format('M, Y')}}</strong></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr class="font-size-13">
                        <th class="info">#</th>
                        <th class="text-center">BANK CODE</th>
                        <th>BANK NAME</th>
                        <th class="text-center">NO. OF STAFF</th>
                        <th class="text-right">AMOUNT</th>
                    </tr>
                    <tbody class="font-size-12">
                    <?php
                            use Illuminate\Support\Facades\DB;
                                $i = 1;
                                $net_amount = 0;
                                $total_staff = 0;
                    ?>
                    @foreach($banks as $bank)
                        <?php
                                $amount = 0;
                                $amount_basis = 0;
                                $total_staff += count($bank->accounts);
                                $amount_bank = DB::select("SELECT SUM(total) AS total FROM rateables WHERE profile_id IN(SELECT profile_id FROM accounts WHERE bank_id = {$bank->id}) AND umonth = '{$sort_date->format('Y-m')}'");
                                $amount_basis = DB::select("SELECT SUM(amount) AS total FROM basic_user_amts WHERE profile_id IN(SELECT profile_id FROM accounts WHERE bank_id = {$bank->id}) AND basic_id NOT IN (1)");
//                                dump($amount_bank[0]->total, $amount_basis[0]->total);
                                $amount = (float) $amount_bank[0]->total + $amount_bank[0]->total?$amount_basis[0]->total:0;
                                $net_amount += $amount;
                        ?>
                        <tr>
                            <td class="info text-warning">{{$i++}}</td>
                            <td class="text-center">{{$bank->code}}</td>
                            <td><a target="_blank" href="{{route('report.bank.order', $bank->id)}}?sort={{$sort_date->format('Y-m')}}">{{strtoupper($bank->name)}}</a></td>
                            <td class="text-center">{{count($bank->accounts)}}</td>
                            <td class="text-right">{{number_format($amount-((5/100)*$amount), 2)}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="info"></td>
                        <td colspan="2" class="text-primary text-right">GRAND TOTAL</td>
                        <td class="text-primary text-center">{{$total_staff}}</td>
                        <td class="text-right">{{number_format($net_amount, 2)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="mar20B row">
                <button id="print-button" onclick="window.print()" class="btn btn-primary col-sm-1 col-sm-offset-11">Print</button>
            </div><br />
        </div>
    </div>

@endsection