
    <div class="example-box-wrapper">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Date of Birth<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar"></i>
                                    </span>
                                <input value="{{ old('dob') }}" ng-model="profile.emp_date.dob" name="dob" type="text"  class="bootstrap-datepicker form-control" placeholder="Date of birth" data-date-format="mm/dd/yy" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Date of Employment<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar" ng-click="profile.emp_date.doe = ''"></i>
                                    </span>
                                <input value="{{ old('doe') }}" ng-model="profile.emp_date.doe" name="doe" type="text"  class="bootstrap-datepicker form-control" placeholder="Date of employment" data-date-format="mm/dd/yy" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Date of Confirmation<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar" ng-click="profile.emp_date.doc = ''"></i>
                                    </span>
                                <input value="{{ old('doc') }}" ng-model="profile.emp_date.doc" name="doc" type="text"  class="bootstrap-datepicker form-control" placeholder="Date of confirmation" data-date-format="mm/dd/yy" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Last Promotion Date<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar" ng-click="profile.emp_date.last_promotion = ''"></i>
                                    </span>
                                <input value="{{ old('last_promotion') }}" ng-model="profile.emp_date.last_promotion" name="last_promotion"  type="text" class="bootstrap-datepicker form-control" placeholder="Last Promotion Date" data-date-format="mm/dd/yy" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Pension Scheme Registration Date<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar" ng-click="profile.emp_date.pension_scheme = ''"></i>
                                    </span>
                                <input value="{{ old('pension_scheme') }}" ng-model="profile.emp_date.pension_scheme" name="pension_scheme"  type="text" class="bootstrap-datepicker form-control" placeholder="pension scheme registration date" data-date-format="mm/dd/yy" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Last Salary Date<abbr class="text-danger">*</abbr></label>
                        <div class="col-sm-6">
                            <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon">
                                        <i class="glyph-icon icon-calendar" ng-click="profile.emp_date.last_salary = ''"></i>
                                    </span>
                                <input value="{{ old('last_salary') }}" ng-model="profile.emp_date.last_salary" name="last_salary" type="text"  class="bootstrap-datepicker form-control" placeholder="last salary date" date-format="yyyy/dd/mm" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
