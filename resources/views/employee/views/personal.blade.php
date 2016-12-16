
    <div class="example-box-wrapper">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Gender<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <select name="gender" ng-model="profile.personal.gender" class="form-control" required>
                                <option value="">--select--</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Marital Status<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <select name="status" ng-model="profile.personal.status" class="form-control" required>
                                <option value="">--select--</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nationality<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <input value="{{ old('nationality') }}" name="nationality" ng-model="profile.personal.nationality" type="text" required placeholder="Nationality" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">State of Origin<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <select name="state_of_origin" ng-model="profile.personal.state_of_origin" class="form-control" required>
                                <option value="">--select--</option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">PAYE State<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <select name="paye_state" ng-model="profile.personal.paye_state" class="form-control" required>
                                <option value="">--select--</option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Language</label>
                        <div class="col-sm-6">
                            <input value="{{ old('language') }}" name="language" ng-model="profile.personal.language" type="text" placeholder="Language"  class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Location</label>
                        <div class="col-sm-6">
                            <input value="{{ old('location') }}" name="location" ng-model="profile.personal.location" type="text" placeholder="Location" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Cost Center</label>
                        <div class="col-sm-6">
                            <input value="{{ old('cost_center') }}" name="cost_center" ng-model="profile.personal.cost_center" type="text" placeholder="Cost Center"  class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Notes</label>
                        <div class="col-sm-6">
                            <input value="{{ old('notes') }}" ng-model="profile.personal.notes" name="notes" type="text" placeholder="Notes" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="pull-right pad20A mrg25T">
                    <a href="#step-4" data-toggle="tab" type="button" class="btn btn-sm btn-success">Next</a>
                </div>

                <div class="pull-left pad20A mrg25T">
                    <a href="#step-2" data-toggle="tab" type="button" class="btn btn-sm btn-success">Prev</a>
                </div>

                <div class="clearfix"></div>
            </div>
    </div>
