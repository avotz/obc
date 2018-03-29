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
                    @if (session('status'))
                        <div class="alert alert-success">
                            <span title="¡Le hemos enviado por correo electrónico el enlace de restablecimiento de contraseña!">{{ session('status') }}</span>
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label" title="Correo electrónico">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong title="No podemos encontrar un usuario con esa dirección de correo electrónico.">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success" title="Enviar enlace de restablecer contraseña">
                                    Send Password Reset Link
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
