@extends('layouts.login')

@section('content')
<div class="content overflow-hidden">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="block block-themed animated fadeIn">
                <div class="block-header bg-primary">
                     <ul class="block-options">
                        <li>
                            <a href="{{ route('login') }}" data-toggle="tooltip" data-placement="left" title="Log In"><i class="si si-login"></i></a>
                        </li>
                    </ul>
                    <h3 class="block-title" title="Restablecer la contraseña">Reset Password</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label" title="Correo electrónico">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong title="{{ validationRequiredES('Correo') }} y/o válido">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label" title="Contraseña">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong title="{{ validationRequiredES('Contraseña') }} y/o no coinciden">{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label" title="Confirmación de contraseña">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success" title="Restablecer la contraseña">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
           
            
            </div>
        </div>
    </div>
</div>
@endsection
