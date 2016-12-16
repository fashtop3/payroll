
    <div class="example-box-wrapper">

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Group<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <select name="category_id" ng-model="profile.account.category_id" class="form-control" required>
                                <option value="">--select--</option>
                                @foreach($categories as $category)
                                    <option {{old('category_id') == $category->id ? 'selected="selected"':''}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Work Rotation</label>
                        <div class="col-sm-6">
                            <input value="{{ old('work_rotation') }}" name="work_rotation" type="text" placeholder="Work Rotation" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Bank<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <select name="bank_id" ng-model="profile.account.bank_id" class="form-control" required>
                                <option value="">--select--</option>
                                @foreach($banks as $bank)
                                    <option {{old('bank_id') == $bank->id ? 'selected="selected"':''}} value="{{$bank->id}}">{{$bank->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Bank Address<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <input value="{{ old('bank_address') }}" name="bank_address" ng-model="profile.account.bank_address" type="text" placeholder="Bank Address" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Bank Account Type<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <select ng-model="profile.account.account_type" name="account_type" class="form-control" required>
                                @if(old('account_type'))
                                    <option value="{{old('account_type')}}">{{ucfirst(old('account_type'))}}</option>
                                @endif
                                <option value="">--select--</option>
                                <option  value="Savings">Savings</option>
                                <option  value="current">Current</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Bank Beneficiary Name<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <input value="{{ old('account_name') }}" name="account_name" ng-model="profile.account.account_name" type="text" placeholder="Bank Beneficiary Name" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Account Number<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <input value="{{ old('account_number') }}" name="account_number" ng-model="profile.account.account_number" type="text" placeholder="Account Number" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Bank Reference Number</label>
                        <div class="col-sm-6">
                            <input value="{{ old('bank_reference') }}" name="bank_reference" type="text" placeholder="Bank Reference Number" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Routing Number</label>
                        <div class="col-sm-6">
                            <input value="{{ old('routine_number') }}" name="routine_number" ng-model="profile.account.routine_number" type="text" placeholder="Routing Number" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Hold Pay</label>
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label>
                                    <input {{ old('hold_pay') == 1 ? "checked='checked":'' }} type="checkbox" ng-model="profile.account.hold_pay" ng-checked="profile.account.hold_pay" value="1" name="hold_pay">
                                    Hold payment?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div ng-if="profile.account.hold_pay" class="form-group">
                        <label class="col-sm-4 control-label">Reason<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <input value="{{ old('hp_reason') }}" ng-model="profile.account.hp_reason" name="hp_reason" type="text" placeholder="State your reason" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Currency<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <select name="currency" ng-model="profile.account.currency" class="form-control" required>
                                <option value="">--select--</option>
                                <option  value="NGN">Naira</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Taxable</label>
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label>
                                    <input {{ old('taxable') == 1 ? "checked='checked":'' }} type="checkbox" ng-checked="profile.account.taxable" value="1" name="taxable">
                                    Account taxable?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">PFA</label>
                        <div class="col-sm-6">
                            <input value="{{ old('pfa') }}" name="pfa" type="text" placeholder="PFA" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">PFA Number</label>
                        <div class="col-sm-6">
                            <input value="{{ old('pfa_number') }}" name="pfa_number" type="text" placeholder="PFA Number" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="pull-right pad20A mrg25T">
                    <a href="#step-5" data-toggle="tab" type="button" class="btn btn-sm btn-success">Next</a>
                </div>

                <div class="pull-left pad20A mrg25T">
                    <a href="#step-3" data-toggle="tab" type="button" class="btn btn-sm btn-success">Prev</a>
                </div>

                <div class="clearfix"></div>
            </div>
    </div>
