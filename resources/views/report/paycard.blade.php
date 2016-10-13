
@extends('app')

@section('content')

    <div id="page-title" ng-init="closedSidebar = true">
        <h2>Report | <small>Paycards</small></h2>
        <p>Paycard reports.</p>
    </div>

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Sort with date</h4>
                </div>
                <form class="form-horizontal" action="{{route('report.paycard')}}" method="POST">
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
        <div class="panel-heading text-center info">PAYCARD AS AT: <a href="#" data-toggle="modal" data-target=".bs-example-modal-sm"><strong>{{$sort_date->format('M, Y')}} <em class="glyph-icon text-primary icon-edit"></em></strong></a></div>
        <div class="panel-body">
            <div class="">
                <table class="table table-striped">
                    <tr>
                        <th colspan="2"></th>
                        <th class="text-right"><small>January</small></th>
                        <th class="text-right"><small>February</small></th>
                        <th class="text-right"><small>March</small></th>
                        <th class="text-right"><small>April</small></th>
                        <th class="text-right"><small>May</small></th>
                        <th class="text-right"><small>June</small></th>
                        <th class="text-right"><small>July</small></th>
                        <th class="text-right"><small>August</small></th>
                        <th class="text-right"><small>September</small></th>
                        <th class="text-right"><small>October</small></th>
                        <th class="text-right"><small>November</small></th>
                        <th class="text-right"><small>December</small></th>
                        <th class="text-right"><small>AMOUNT</small></th>
                    </tr>
                    <?php
                    use Illuminate\Support\Facades\DB;
                    $i = 1;
                    $net_amount = 0;
                    $total_staff = 0;
                    $sum_month = array_fill(0, 13, 0);
                    ?>
                    <tbody>
                    @foreach($profiles as $profile)
                        <tr class="info">
                            <th><small>{{strtoupper($profile->eid)}}</small></th>
                            <th><small>{{strtoupper($profile->lastname).' '.$profile->middlename.' '.$profile->firstname.' '. strtoupper($profile->title).'.'}}</small></th>
                            <th colspan="13"></th>
                        </tr>
                        <?php $sum_month[12] = 0; ?>
                        @foreach($basics as $basic)
                            <?php $row_total = 0; ?>
                            <tr>
                                <td colspan="2"><small>{{strtoupper($basic->name)}}</small></td>
                                @for($i=1; $i<=12; $i++)
                                <?php
                                    $pad = (string) str_pad($i, 2, '0', STR_PAD_LEFT);
                                    $umonth = '2016-'.$pad;
                                    $amount = DB::select("SELECT SUM(total) AS total FROM rateables WHERE profile_id = {$profile->id} AND basic_id = {$basic->id} AND umonth = '{$umonth}' ");
                                    $row_total += $amount[0]->total;
                                    $sum_month[$i-1] += $amount[0]->total;
                                ?>

                                    <td class="text-right">{{number_format($amount[0]->total, 2)}}</td>

                                @endfor
                                <?php $sum_month[12] += $row_total; ?>
                                <td class="text-right">{{number_format($row_total, 2)}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"></td>
                            @for($i=0; $i<12; $i++)
                                <td class="text-right">{{number_format($sum_month[$i], 2)}}</td>
                            @endfor
                            <td class="text-right">{{number_format($sum_month[12], 2)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection