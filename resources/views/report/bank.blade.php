
@extends('app')

@section('content')

    <div id="page-title">
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
                <form class="form-horizontal" action="{{route('report.bank')}}" method="POST">
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
                                        <option value="{{$m}}">{{$m}}</option>
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
        <div class="panel-heading text-center info">BANK SCHEDULE FOR: <a href="#" data-toggle="modal" data-target=".bs-example-modal-sm"><strong>{{$sort_date->format('M, Y')}} <em class="fa fa-edit"></em></strong></a></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th class="info">#</th>
                        <th class="text-center">BANK CODE</th>
                        <th>BANK NAME</th>
                        <th class="text-center">NO. OF STAFF</th>
                        <th class="text-right">AMOUNT</th>
                    </tr>
                    <tbody>
                    <?php
                            use Illuminate\Support\Facades\DB;
                                $i = 1;
                                $net_amount = 0;
                                $total_staff = 0;
                    ?>
                    @foreach($banks as $bank)
                        <?php
                                $total_staff += count($bank->accounts);
                                $amount_bank = DB::select("SELECT SUM(total) AS total FROM rateables WHERE profile_id IN(SELECT profile_id FROM accounts WHERE bank_id = {$bank->id}) AND umonth = '{$sort_date->format('Y-m')}'");
                                $net_amount += (float) $amount_bank[0]->total;
                        ?>
                        <tr>
                            <td class="info text-warning">{{$i++}}</td>
                            <td class="text-center">{{$bank->code}}</td>
                            <td><a href="{{route('report.bank.order', $bank->id)}}?sort={{$sort_date->format('Y-m')}}">{{strtoupper($bank->name)}}</a></td>
                            <td class="text-center">{{count($bank->accounts)}}</td>
                            <td class="text-right">{{number_format($amount_bank[0]->total, 2)}}</td>
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
        </div>
    </div>

@endsection