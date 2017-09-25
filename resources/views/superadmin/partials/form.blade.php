    <div class="form-group{{ $errors->has('applicant_name') ? ' has-error' : '' }}">
    <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="applicant_name" name="applicant_name" value="{{ isset($user) ? $user->profile->applicant_name : old('applicant_name') }}">
                <label for="applicant_name"> Name</label>
                @if ($errors->has('applicant_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('applicant_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('first_surname') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="first_surname" name="first_surname" value="{{ isset($user) ? $user->profile->applicant_name : old('first_surname') }}">
                <label for="first_surname"> First surname</label>
                @if ($errors->has('first_surname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('first_surname') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('second_surname') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="second_surname" name="second_surname" value="{{ isset($user) ? $user->profile->second_surname : old('second_surname') }}">
                <label for="second_surname"> Second surname</label>
                @if ($errors->has('second_surname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('second_surname') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="email" id="email" name="email" value="{{ isset($user) ? $user->email : old('email') }}">
                <label for="email">Email</label>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <select class="js-select2 form-control" name="country" id="country" >
                    <!-- <option></option>Required for data-placeholder attribute to work with Chosen plugin -->
                    @foreach($countries as $country)    
                        <option value="{{ $country->id }}" @if(isset($user) && $user->countries->first()->id == $country->id) selected="selected" @endif>{{ $country->name }}</option>
                    @endforeach
                </select>
                <label for="country"> Country</label>
                @if ($errors->has('country'))
                    <span class="help-block">
                        <strong>{{ $errors->first('country') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <select class="form-control" name="role" id="role" >
                    
                    @foreach($roles as $role)    
                        <option value="{{ $role->id }}" @if(isset($user) && $user->hasRole($role->name)) selected="selected" @endif>{{ $role->name }}</option>
                    @endforeach
                </select>
                <label for="role"> Role</label>
                @if ($errors->has('role'))
                    <span class="help-block">
                        <strong>{{ $errors->first('role') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="password" id="password" name="password">
                <label for="password">Change Password</label>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
            <button class="btn btn-block btn-success" type="submit">Save</button>
        </div>
    </div>
