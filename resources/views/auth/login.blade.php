@extends('layouts.login')

@section('content')
<!-- Login Content -->
<div class="content overflow-hidden">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                    <!-- Login Block -->
                    <div class="block block-themed animated fadeIn">
                        <div class="block-header bg-primary">
                            <ul class="block-options">
                                <li>
                                    <a href="{{ route('password.request') }}" title="¿Cambiar la contraseña?">Change Password?</a>
                                </li>
                                <li>
                                    <a href="/register" data-toggle="tooltip" data-placement="left" title="New Account"><i class="si si-plus"></i></a>
                                </li>
                            </ul>
                            <h3 class="block-title" title="INICIAR SESIÓN">Login</h3>
                        </div>
                        <div class="block-content block-content-full block-content-narrow">
                            <!-- Login Title -->
                            <div class="logo">
                                <h1 class="h2 font-w600 push-5"><img src="/img/logo-obc.png" alt="OBC"></h1>
                            </div>
                            
                            <p title="Bienvenido, inicia sesión">Welcome, please login.</p>
                            <!-- END Login Title -->

                            <!-- Login Form -->
                            <!-- jQuery Validation (.js-validation-login class is initialized in js/pages/base_pages_login.js) -->
                            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <p title="Si aún no tiene una cuenta, presione la opción 'registrarse' y comience a usar la plataforma en línea 24/7">   If you do not already have an account, press the "register" option and start using the online platform 24/7.</p> 

                            <p title="Sus datos de acceso son información privada que no debe compartir con nadie más, OBC nunca le pedirá sus datos de acceso por teléfono o por correo electrónico.">Your access data is private information that you should not share with anyone else, OBC will never ask you for your access data by phone, or via email.</p> 

                            <p title="Si ha olvidado su contraseña, puede recuperarla ingresando su dirección de correo electrónico y pulsando la tecla de recuperación, se le enviará una nueva contraseña al correo electrónico registrado por usted, que debe cambiarse en un plazo no mayor a 24 horas.">If you have forgotten your password, you can retrieve it by entering your email address and pressing key recovery, a new password will be sent to the email registered by you, which must be changed within a period of no more than 24 hours.</p> 

                            <p title="Si desea reemplazar su código de acceso por uno nuevo, ingrese su correo electrónico y presione cambiar contraseña."> If you want to replace your access code with a new one, enter your email and press change password.</p> 

                          
                            <form class="js-validation-login form-horizontal push-30-t push-50" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary floating">
                                            <input class="form-control" type="email" id="email" name="email" {{ old('email') }}>
                                            <label for="email" title="Correo">Email</label>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong title="{{ validationRequiredES('Correo') }}">{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary floating">
                                            <input class="form-control" type="password" id="password" name="password">
                                            <label for="password" title="Contraseña">Password</label>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong title="{{ validationRequiredES('Contraseña') }}">{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label class="css-input switch switch-sm switch-primary">
                                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}><span></span> <b title="¿Recuerdame?">Remember Me?</b> 
                                            
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <button class="btn btn-primary" type="submit" title="Inicio de sesión"><i class="si si-login pull-right"></i> Login</button>
                                        <a href="{{ route('register') }}" class="btn btn-success" title="Registrarse"><i class="si si-user pull-right"></i> Register</a>
                                

                                        <a class="btn btn-link" href="{{ route('password.request') }}" title="¿Olvidaste tu contraseña?">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <!-- END Login Form -->
                        </div>
                    </div>
                    <!-- END Login Block -->
                </div>
            </div>
        </div>
        <!-- END Login Content -->

@endsection
