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
                                    <a href="{{ route('password.request') }}">Change Password?</a>
                                </li>
                                <li>
                                    <a href="/register" data-toggle="tooltip" data-placement="left" title="New Account"><i class="si si-plus"></i></a>
                                </li>
                            </ul>
                            <h3 class="block-title">Login</h3>
                        </div>
                        <div class="block-content block-content-full block-content-narrow">
                            <!-- Login Title -->
                            <div class="logo">
                                <h1 class="h2 font-w600 push-5"><img src="/img/logo-obc.png" alt="OBC"></h1>
                            </div>
                            
                            <p>Welcome, please login.</p>
                            <!-- END Login Title -->

                            <!-- Login Form -->
                            <!-- jQuery Validation (.js-validation-login class is initialized in js/pages/base_pages_login.js) -->
                            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <p>   If you do not already have an account, press the "register" option and start using the online platform 24/7.</p> 

                            <p>Your access data is private information that you should not share with anyone else, OBC will never ask you for your access data by phone, or via email.</p> 

                            <p>If you have forgotten your password, you can retrieve it by entering your email address and pressing key recovery, a new password will be sent to the email registered by you, which must be changed within a period of no more than 24 hours.</p> 

                            <p> If you want to replace your access code with a new one, enter your email and press change password.</p> 

                          
                            <form class="js-validation-login form-horizontal push-30-t push-50" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary floating">
                                            <input class="form-control" type="text" id="email" name="email" {{ old('email') }}>
                                            <label for="email">Email</label>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary floating">
                                            <input class="form-control" type="password" id="password" name="password">
                                            <label for="password">Password</label>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label class="css-input switch switch-sm switch-primary">
                                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}><span></span> Remember Me?
                                            
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <button class="btn btn-primary" type="submit"><i class="si si-login pull-right"></i> Login</button>
                                        <a href="{{ route('register') }}" class="btn btn-success"><i class="si si-user pull-right"></i> Register</a>
                                

                                        <a class="btn btn-link" href="{{ route('password.request') }}">
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
