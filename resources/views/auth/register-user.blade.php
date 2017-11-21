@extends('layouts.login')

@section('content')
<!-- Register Content -->
<div class="content overflow-hidden">
            <div class="row">
            <h1 class="text-center" title="Cuenta de usuario">User account</h1>
            <form class="js-validation-register form-horizontal push-50-t push-50" method="POST" action="{{ route('registerUser') }}">
                                {{ csrf_field() }}
            <div class="col-md-6">
                <!-- <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4"> -->
                    <!-- Register Block -->
                    <div class="block block-themed animated fadeIn">
                        <div class="block-header bg-success">
                            
                            <h3 class="block-title" title="DATOS DE LA COMPAÑIA">Company data</h3>
                        </div>
                        <div class="block-content block-content-full block-content-narrow">
                                    
                            <check-partner></check-partner>
                            <div class="err-lara {{ $errors->has('applicant_name') ? ' has-error' : '' }}">
                                @if ($errors->has('associate_private_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('associate_private_code') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('associate_private_code_not_found'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('associate_private_code_not_found') }} </strong>
                                    </span>
                                @endif	
                            </div>
                           
                            
                        

                        </div>
                    </div>
                    
                   
                    
                </div>
        
                <div class="col-md-6">
                        <div class="block block-themed animated fadeIn">
                            <div class="block-header bg-success">
                                <ul class="block-options">
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#modal-terms" title="Ver política de uso">View Usage Policy</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('login') }}" data-toggle="tooltip" data-placement="left" title="Log In"><i class="si si-login"></i></a>
                                    </li>
                                </ul>
                                <h3 class="block-title" title="Cuenta de usuario">User Account</h3>
                            </div>
                            <div class="block-content block-content-full block-content-narrow">
                            <div class="form-group{{ $errors->has('applicant_name') ? ' has-error' : '' }}">
                                            <div class="col-xs-12">
                                                <div class="form-material form-material-success">
                                                    <input class="form-control" type="text" id="applicant_name" name="applicant_name" value="{{ old('applicant_name') }}">
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
                                                    <input class="form-control" type="text" id="first_surname" name="first_surname" value="{{ old('first_surname') }}">
                                                    <label for="first_surname" title="Primer Apellido"> First surname</label>
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
                                                    <input class="form-control" type="text" id="second_surname" name="second_surname" value="{{ old('second_surname') }}">
                                                    <label for="second_surname" title="Segundo Apellido"> Second surname</label>
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
                                                    <input class="form-control" type="text" id="position_held" name="position_held" value="{{ old('position_held') }}">
                                                    <label for="position_held" title="Cargo que ocupa"> Position held</label>
                                                    @if ($errors->has('position_held'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('position_held') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <div class="col-xs-12">
                                                <div class="form-material form-material-success">
                                                    <input class="form-control" type="text" id="phone" name="phone" value="{{ old('phone') }}">
                                                    <label for="phone" title="Número de teléfono de la oficina donde trabaja">Phone number of the office where you work</label>
                                                    @if ($errors->has('phone'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <div class="col-xs-12">
                                                <div class="form-material form-material-success">
                                                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}">
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
                                                    <input class="form-control" type="password" id="password" name="password" >
                                                    <label for="password" title="Contraseña">Password</label>
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            <div class="col-xs-12">
                                                <div class="form-material form-material-success">
                                                    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" >
                                                    <label for="password_confirmation" title="Confirmación de contraseña">Confirm Password</label>
                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label class="css-input switch switch-sm switch-success">
                                                    <input type="checkbox" id="register-terms" name="register-terms" required><span></span> <b title="De acuerdo con las políticas de uso">I agree with usage Policy</b>   
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-6 col-md-5">
                                                <button class="btn btn-block btn-primary" type="submit" title="Regístrate"><i class="fa fa-plus pull-right"></i> Sign Up</button>
                                            </div>
                                        </div>
                            </div>
                        </div>
                </div>
                </form>
                 <!-- END Register Form -->
            </div>
        </div>
        <!-- END Register Content -->
        <!-- Terms Modal -->
        <div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-popout">
                <div class="modal-content">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <ul class="block-options">
                                <li>
                                    <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title">Usage Policy</h3>
                        </div>
                        <div class="block-content">
                        <p>
                        All fields with asterisks are mandatory, remember that the email will be your username, therefore, enter a valid email address in order to be able to retrieve your password by means of this email in case of lost or forgotten .</p>   
                        
                        <p> By registering your company, you authorize OBC to confirm all the data provided in the account creation form of associates, once confirmed that data, OBC will authorize the use of your account and you will be able to use the online platform 24/7.</p>   
                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-sm btn-primary" type="button" data-dismiss="modal"><i class="fa fa-check"></i> I agree</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Terms Modal -->
@endsection

