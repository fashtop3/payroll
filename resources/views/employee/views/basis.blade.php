
    <div class="example-box-wrapper">

            <div class="row">
                <div class="col-md-10">
                    @foreach($basics as $basic)
                        <div class="form-group" ng-init="profile.account.basis_amount_{{$basic->id}} = '{{str_replace(',','', number_format($profile->getAmountBasisById($basic->id), 2))}}';">
                            <label class="col-sm-4 control-label">{{$basic->name}} <abbr class="text-danger">*</abbr></label> <!-- [{{$basic->id}}] -->
                            <div class="col-sm-6" ng-class="{'has-error':(!employeeForm.basis_amount_{{$basic->id}}.$pristine && (employeeForm.basis_amount_{{$basic->id}}.$error.required || employeeForm.basis_amount_{{$basic->id}}.$error.pattern))}">
                                <input type="hidden" name="basis_amount[{{$basic->id}}]" ng-value="profile.account.basis_amount_{{$basic->id}}" />
                                <input value="{{ old('basis_amount['.$basic->id.']', number_format($profile->getAmountBasisById($basic->id), 2)) }}" ng-pattern="/^([0-9]{1,18}\.[0-9]{2})$/" name="basis_amount_{{$basic->id}}" ng-model="profile.account.basis_amount_{{$basic->id}}" type="text" placeholder="0.00" required class="form-control">
                                <span ng-show="employeeForm.basis_amount_{{$basic->id}}.$error.pattern" class="help-block">Invalid amount (e.g 4000.67)</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </div>
