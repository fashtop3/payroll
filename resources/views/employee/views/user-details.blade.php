
    <div class="example-box-wrapper">
            <div class="row">
                <div class="col-md-6">
                    @if(Auth::user()->isRole('hr.manager|developer'))
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Approve</label>
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" ng-checked="profile.approved" value="1" {{  old('approved') == 1 ? "checked='checked'" : '' }} required name="approved">
                                    Approve user account?
                                </label>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Title<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <select name="title" ng-model="profile.title" class="form-control" required>
                                @if(old('title'))
                                    <option value="{{old('title')}}">{{ucfirst(old('title'))}}</option>
                                @endif
                                <option value="">--select--</option>
                                <option value="miss">Miss.</option>
                                <option value="mr">Mr.</option>
                                <option value="mrs">Mrs.</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Last Name<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <input id="lastname" type="text" value="{{ old('lastname') }}" name="lastname" ng-model="profile.lastname" placeholder="Last Name" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">First Name<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <input type="text" value="{{ old('firstname') }}" name="firstname" ng-model="profile.firstname" placeholder="First Name" required class="form-control">
                        </div>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-3 control-label">Other Name<abbr class="text-danger">*</abbr></label>--}}
                        {{--<div class="col-sm-6">--}}
                            {{--<input type="text" name="middlename" data-parsley-range="[5,10]" placeholder="Other Name" required class="form-control">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Middle Name<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <input type="text" value="{{ old('middlename') }}" name="middlename" ng-model="profile.middlename" placeholder="Middle Name" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Email Address</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{ old('email') }}" name="email" ng-model="profile.email" placeholder="Email Address" class="form-control">
                        </div>
                    </div>
                    @if(Auth::user()->isRole('hr.manager|developer'))
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Active</label>
                                <div class="col-sm-6">
                                    <div class="checkbox">
                                        <label>
                                            <input {{ old('active') == 1 ? "checked='checked'":'' }} ng-checked="profile.active" value="1" type="checkbox" name="active">
                                            Activate user account?
                                        </label>
                                    </div>
                                </div>
                            </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Mobile Phone<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <input type="text" value="{{ old('mobile_phone') }}" name="mobile_phone" ng-model="profile.mobile_phone" placeholder="Mobile Phone" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Home Phone</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{ old('home_phone') }}" name="home_phone" ng-model="profile.home_phone" placeholder="Home Phone" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Office Phone</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{ old('office_phone') }}" name="office_phone" ng-model="profile.office_phone" placeholder="Office Phone" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Address 1<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <input type="text" value="{{ old('address1') }}" name="address1" ng-model="profile.address1" placeholder="address 1" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Address 2</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{ old('address2') }}" ng-model="profile.address2" name="address2" placeholder="address 2" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">City<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <input type="text" value="{{ old('city') }}" name="city" ng-model="profile.city" data-parsley-type="alphanum" placeholder="city" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">State<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <select name="state_id" class="form-control" ng-model="profile.state_id" required>
                                <option value="">--select--</option>
                                @foreach($states as $state)
                                    <option {{old('state_id') == $state->id ? 'selected="selected"':''}} value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Postal Address</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{ old('postal') }}" ng-model="profile.postal" name="postal" placeholder="Postal address" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Country<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <input type="text" value="{{ old('country') }}" name="country" placeholder="Country" ng-model="profile.country" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Employee Category<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <select name="category_id" class="form-control" ng-model="profile.category_id" required>
                                <option value="">--select--</option>
                                @foreach($categories as $category)
                                    <option {{old('category_id') == $category->id ? 'selected="selected"':''}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Department<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <select name="department_id" class="form-control"  ng-model="profile.department_id" required>
                                <option value="">--select--</option>
                                @foreach($departments as $department)
                                    <option {{old('department_id') == $department->id ? 'selected="selected"':''}} value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Designation</label>
                        <div class="col-sm-6">
                            <input name="designation" value="{{ old('designation') }}" ng-model="profile.designation" type="text" placeholder="Designation" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
    </div>