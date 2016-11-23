
@extends('app')

@section('content')

    <script type="text/javascript">
        function xor(a, b) {
            return ( a || b ) && !( a && b );
        }
    </script>

    <div id="page-title" ng-init="closedSidebar = true">
        <h2>Report | <small>Paycards</small></h2>
        <p>Paycard reports.</p>
    </div>

    {{--<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">--}}
        {{--<div class="modal-dialog modal-sm">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
                    {{--<h4 class="modal-title">Sort with date</h4>--}}
                {{--</div>--}}
                {{--<form class="form-horizontal" action="{{route('report.paycard')}}" method="GET">--}}
                    {{--<div class="modal-body">--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="col-sm-10 col-sm-offset-1">--}}
                                {{--<select name="year" id="" class="form-control">--}}
                                    {{--@for($i=2016; $i<=2030; $i++)--}}
                                        {{--<option {{Request::get('year') == $i ? 'selected':''}} value="{{$i}}">{{$i}}</option>--}}
                                    {{--@endfor--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                        {{--<button type="submit" class="btn btn-primary">Query</button>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


    <div class="mrg20B hide-print">
        <div class="pull-right">
            <form class="form form-inline" action="{{route('report.paycard')}}" method="GET">
                <div class="form-group">
                    <select class="form-control" name="dept_id">
                        <option value="-1">--Department--</option>
                        <option value="-1">--All--</option>
                        @foreach(\App\Department::all() as $department)
                            <option {{ Request::get('dept_id', -1) == $department->id ? 'selected':'' }} value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select name="year" id="" class="form-control">
                        <option value="">--Year--</option>
                        @for($i=2010; $i<=2030; $i++)
                            <option {{ $sort_date->format('Y') == $i ? 'selected':''}} value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel">
        {{--<em class="glyph-icon text-primary icon-edit"></em>--}}
        <div class="panel-heading text-center info"> <strong>{{strtoupper($department_name)}}</strong>-PAYCARD AS AT: <strong>{{$sort_date->format('Y')}}</strong></div>
        <div class="panel-body">

            <div class="">
                <table class="table table-striped">
                    <tr>
                        <th ng-init="details = false" colspan="2" style="cursor: pointer; cursor: hand;"><a ng-click="details = !details" href="#">{[{ details?'[-]Hide':'[+]Show' }]} all</a> </th>
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
                    @if(count($profiles))
                        @foreach($profiles as $profile)
                            <tr class="info" style="cursor: pointer; cursor: hand;" ng-init="p_{{$profile->eid}} = false" ng-click="p_{{$profile->eid}} = !p_{{$profile->eid}}" >
                                <th><small>{{strtoupper($profile->eid)}}</small></th>
                                <th><small>{{strtoupper($profile->lastname).' '.$profile->middlename.' '.$profile->firstname.' '. strtoupper($profile->title).'.'}}</small></th>
                                <th colspan="13"></th>
                            </tr>
                            <?php $sum_month[12] = 0; ?>
                            @foreach($basics as $basic)
                                <?php $row_total = 0; ?>
                                <tr ng-show="p_{{$profile->eid}} || details">
                                    <td colspan="2"><small>{{strtoupper($basic->name)}}</small></td>
                                    @for($i=1; $i<=12; $i++)
                                        <?php
                                        $pad = (string) str_pad($i, 2, '0', STR_PAD_LEFT);
                                        $umonth = $sort_date->format('Y').'-'.$pad;
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
                    @else
                        <tr><td colspan="20" class="text-center warning"> No result found. </td></tr>
                    @endif
                    </tbody>
                </table>
            </div>

            <div class="pull-right">{{ $profiles->appends(Request::all())->links() }}</div>
            <div class="mar20B">
                <button id="print-button" onclick="window.print()" class="btn btn-primary col-sm-1">Print</button>
            </div><br />
            <div class="clearix"></div>
        </div>
    </div>

@endsection