
@extends('app')

@section('content')

    <div id="page-title" ng-init="closedSidebar = true">
        <h2>Report | <small>Shift</small></h2>
        <p>Shift reports.</p>
    </div>

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Sort with date</h4>
                </div>
                <form class="form-horizontal" action="{{route('report.shift')}}" method="POST">
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
        <div class="panel-heading text-center info">SHIFT REPORT: <a href="#" data-toggle="modal" data-target=".bs-example-modal-sm"><strong>{{$sort_date->format('M, Y')}} <em class="glyph-icon text-primary icon-edit"></em></strong></a></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th colspan="3"></th>
                        <th colspan="3" class="text-center">DAY</th>
                        <th colspan="3" class="text-center">NIGHT</th>
                    </tr>
                    <tbody>
                    <?php
                            use Illuminate\Support\Facades\DB;
                                $i = 1;
                                $net_amount = 0;
                                $total_staff = 0;
                    ?>
                    <tr>
                        <th><small>S/No</small></th>
                        <th><small>ID</small></th>
                        <th><small>Employee Name</small></th>
                        <th><small>Hours</small></th>
                        <th><small>Rate</small></th>
                        <th class="text-right"><small>Amount</small></th>
                        <th><small>Hours</small></th>
                        <th><small>Rate</small></th>
                        <th class="text-right"><small>Amount</small></th>
                        <th class="text-right"><small>Total</small></th>
                    </tr>
                    <?php $sn = 1; ?>
                    @foreach($departments as $department)
                        <tr><th colspan="3"><small>{{strtoupper($department->name)}}</small></th></tr>
                        @foreach($department->profiles as $profile)
                            <tr><td>{{$sn++}}</td><td><small>{{strtoupper($profile->eid)}}</small></td><td><small>{{strtoupper($profile->lastname.' '.$profile->middlename.' '.$profile->firstname)}}</small></td></tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection