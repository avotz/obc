@extends('layouts.app')
@section('css')

@endsection

@section('content')
 
   <!-- Page Header -->
   <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading" title="Soporte. Tienes una consulta">
                IT Support <small>Do you have a questions.</small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li>Home</li>
                    <li><a class="link-effect" href="/support">IT Support</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->
    <div class="content content-boxed">
                   
    <div class="block">
        <div class="block-content block-content-full block-content-narrow">
          
            <!-- Contact Form -->
            <h2 class="h3 font-w600 push-50-t push" title="¿Tienes alguna pregunta?">Do you have any further questions?</h2>
            <div id="faq4" class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#faq4" href="#faq4_q1"><i class="fa fa-envelope-o"></i> Contact Us</a>
                        </h3>
                    </div>
                    <div id="faq4_q1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <form class="form-horizontal push-10-t" action="/support" method="post">
                                {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-material form-material-primary">
                                            <input class="form-control" type="text" id="faq-contact-firstname" name="firstname" placeholder="Enter your firstname.." value="{{ old('firstname') }}">
                                            <label for="firstname" title="Nombre">Firstname</label>
                                            @if ($errors->has('firstname'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('firstname') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-material form-material-primary">
                                            <input class="form-control" type="text" id="faq-contact-lastname" name="lastname" placeholder="Enter your lastname.." value="{{ old('lastname') }}">
                                            <label for="lastname" title="Apellidos">Lastname</label>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-sm-8">
                                        <div class="form-material form-material-primary input-group">
                                            <input class="form-control" type="email" id="faq-contact-email" name="email" placeholder="Enter your email.." value="{{ old('email') }}">
                                            <label for="email" title="Correo">Email</label>
                                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                          
                                        </div>
                                        @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('subject') ? ' has-error' : '' }}">
                                    <div class="col-sm-4">
                                        <div class="form-material form-material-primary">
                                            <select class="form-control" id="faq-contact-subject" name="subject" size="1">
                                                <option value="Support" title="Soporte">Support</option>
                                                <option value="Management" title="Administracion">Management</option>
                                                <option value="Feature Request" title="Solicitud de función">Feature Request</option>
                                            </select>
                                            <label for="subject" title="¿Donde?">Where?</label>
                                            @if ($errors->has('subject'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('subject') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('msg') ? ' has-error' : '' }}">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            <textarea class="form-control" id="faq-contact-msg" name="msg" rows="7" placeholder="Enter your message..">{{ old('msg') }}</textarea>
                                            <label for="msg" title="Mensaje">Message</label>
                                            @if ($errors->has('msg'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('msg') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                      
                                    </div>
                                </div>
                                <div class="form-group remove-margin-b">
                                    <div class="col-xs-12">
                                        <button class="btn btn-sm btn-primary" type="submit" title="Enviar mensaje"><i class="fa fa-send push-5-r"></i> Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Contact Form -->

        </div>
    </div>
   
    </div>

@endsection
@section('scripts')


@endsection
