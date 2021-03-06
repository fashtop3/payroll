@extends('app')

@section('content')

    <script type="text/javascript">
        $(document).ready(function() {
            $(".select-employee").select2({
                placeholder: "Select Employee",
                allowClear: true
            });
        });
    </script>


    <div id="page-title">
        <h2>Rateable Transactions</h2>
    </div>

    <div ng-controller="RateableController">
        <div class="panel">
            <form action="{{URL::route('rateable.store')}}" method="POST" novalidate class="form-horizontal bordered-row" name="rateableForm" id="demo-form" data-parsley-validate="">
                {{csrf_field()}}
                <div class="panel-body">
                    <h3 class="title-hero">
                        Transaction
                    </h3>
                    <div class="example-box-wrapper" ng-init="profiles = {{$profiles->toJson()}}">
                        @if(Session::has('flash_message'))
                            <div class="alert alert-success">
                                {{ Session::get('flash_message') }}
                            </div>
                        @elseif(Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="row" ng-init="isSelected({{old('profile_id')}})">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Employee</label>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="profile_id" value="{[{ profiles.selected.id }]}" required />
                                        <select required
                                                ng-change="profileChanged()"
                                                ng-model="profiles.selected"
                                                class="form-control js-states select-employee"
                                                ng-options="(profile.lastname + ' ' + profile.firstname) for profile in profiles">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">PayType</label>
                                    <div class="col-sm-6" ng-init="payTypes = {{$payTypes}}">
                                        {{--<select name="paytype_id" class="form-control" required>--}}
                                        {{--<option>--select--</option>--}}
                                        {{--@foreach($payTypes as $key => $values)--}}
                                        {{--<optgroup label="{{$key}}">--}}
                                        {{--@foreach($values as $k => $v)--}}
                                        {{--<option value="{{$v}}">{{$k}}</option>--}}
                                        {{--@endforeach--}}
                                        {{--</optgroup>--}}
                                        {{--@endforeach--}}
                                        {{--</select>--}}
                                        <input type="hidden" name="paytype_id" required value="{[{ payTypes.selected.id }]}" />
                                        <select class="form-control" required
                                                ng-disabled = "!profiles.selected.id || profiles.selected.id == ''"
                                                ng-change="getTax()"
                                                ng-model="payTypes.selected"
                                                ng-options="payType.name group by payType.label for payType in payTypes">
                                            <option value="">--Choose--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Basis</label>
                                    <div class="col-sm-6">
                                        {{--<select name="basic_id" class="form-control" required>--}}
                                        {{--<option ng-selected="true">--select--</option>--}}
                                        {{--@foreach($basics as $k => $v)--}}
                                        {{--<option value="{{$v}}">{{$k}}</option>--}}
                                        {{--@endforeach--}}
                                        {{--</select>--}}
                                        <input type="hidden" name="basic_id" value="{[{ basics.selected }]}" required>
                                        <select class="form-control" required
                                                ng-change="getTax()"
                                            ng-model="basics.selected">
                                            <option value="">--Choose--</option>
                                            <option ng-if="basics.id" value="{[{ basics.id }]}">{[{ basics.name }]}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" ng-show="payTypes.selected">
                                    <label ng-show="payTypes.selected.label == 'OVERTIME'" class="col-sm-4 control-label">Hours</label>
                                    <label ng-show="payTypes.selected.label == 'SHIFT'" class="col-sm-4 control-label">Days</label>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="durations" value="{[{ hours }]}" required>
                                        <select class="form-control" required
                                                ng-change="getTax()"
                                                ng-model="hours">
                                            <option value="">--Choose--</option>
                                            <option ng-repeat="hour in hoursRange() track by $index" value="{[{$index+1}]}">{[{$index+1}]}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Taxable</label>
                                    <div class="col-sm-6">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="taxable" checked name="taxable">
                                                Taxable?
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Total</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="total" readonly value="{[{ total | number:2 }]}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Approved By</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{Auth::user()->firstname.' '. Auth::user()->lastname}}" readonly class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="text-center">
                        <button ng-disabled="rateableForm.$invalid" type="submit" class="btn btn-lg btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>

        <!--Existing Transactions-->
        <div class="panel">
            <form class="form-horizontal bordered-row" id="demo-form" data-parsley-validate="">
                <div class="panel-body">
                    <h3 class="title-hero">
                        Existing Transactions for <strong>{{Carbon\Carbon::now()->format('m/Y')}}</strong>
                    </h3>

                    <div class="example-box-wrapper">

                        <table class="table table-striped">
                            <tr class="font-size-13">
                                {{--<th>Employee ID</th>--}}
                                {{--<th>Full Name</th>--}}
                                <th>PayType</th>
                                <th>Durations</th>
                                <th class="text-center">Taxable</th>
                                <th class="text-right">Total</th>
                                <th></th>
                            </tr>
                            <tbody>
                            <tr class="font-size-12" ng-repeat="recent in profiles.selected.recent_rateables">
                                {{--<td>@{{ profile.eid }}</td>--}}
                                {{--<td>@{{ profile.lastname +', '+ profile.firstname +' '+ profile.middlename }}</td>--}}
                                <td ng-init="p = getPayType(recent.paytype_id)">{[{ p.label+' -> '+p.name }]}</td>
                                <td ng-if="p.label == 'SHIFT'">{[{ recent.durations }]} Day(s)</td>
                                <td ng-if="p.label == 'OVERTIME'">{[{ recent.durations }]} Hours(s)</td>
                                <td class="text-center"><span class="label {[{ recent.taxable ? 'label-purple' : 'label-danger' }]}">{[{ recent.taxable ? 'Y' : 'N' }]}</span></td>
                                <td class="text-right"><strong>#{[{ recent.total }]}</strong></td>
                                <td class="text-right"><a href="/employee/rateable/{[{recent.id}]}/delete" class="btn btn-sm btn-danger"><i class="glyph-icon icon-close"></i></a></td>
                                {{--<td><a href="{{route('employee.rateable.delete', $rid)}}" class="btn btn-danger">Delete</a></td>--}}
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection