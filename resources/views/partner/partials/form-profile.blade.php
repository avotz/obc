    <div class="form-group{{ $errors->has('applicant_name') ? ' has-error' : '' }}">
    <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="applicant_name" name="applicant_name" value="{{ $user->profile->applicant_name }}">
                <label for="applicant_name" title="Nombre del solicitante"> Applicant name</label>
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
                <input class="form-control" type="text" id="first_surname" name="first_surname" value="{{ $user->profile->first_surname }}">
                <label for="first_surname" title="Primer apellido"> First surname</label>
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
                <input class="form-control" type="text" id="second_surname" name="second_surname" value="{{ $user->profile->second_surname  }}">
                <label for="second_surname" title="Segundo apellido"> Second surname</label>
                @if ($errors->has('second_surname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('second_surname') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('position_held') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="position_held" name="position_held" value="{{ $user->profile->position_held }}">
                <label for="position_held" title="Cargo que ocupa"> Position held</label>
                @if ($errors->has('position_held'))
                    <span class="help-block">
                        <strong>{{ $errors->first('position_held') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="email" id="email" name="email" value="{{ $user->email }}">
                <label for="email" title="Correo">Email</label>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="password" id="password" name="password">
                <label for="password" title="Cambiar contraseña">Change Password</label>
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
            <button class="btn btn-block btn-success" type="submit" title="Actualizar">Update</button>
        </div>
    </div>