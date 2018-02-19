@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="/js/plugins/select2/select2.min.css">
@endsection
@section('content')
<div id="infoBox" class="alert alert-success" ></div>
 <!-- Page Header -->
 <div class="content bg-image" style="background-image: url('/img/photo-profile.jpg');">
    <div class="push-50-t push-15 clearfix">
        <div class="push-15-r pull-left animated fadeIn">
            <img src="{{ getAvatar($user) }}" alt="Avatar" id="user-avatar" class="img-avatar img-avatar-thumb" />
           
            <a class="UploadButton btn btn-xs btn-default btn-block" id="UploadPhoto" data-url="/user/profile/avatars" title="Cambiar">Change</a>
            <delete-avatar-profile :user-id="{{ $user->id }}" url="/user/profile/avatars"></delete-avatar-profile>
        </div>
        <h1 class="h2 text-white push-5-t animated zoomIn">{{ $user->profile->applicant_name}} {{ $user->profile->first_surname}}</h1>
        <h2 class="h5 text-white-op animated zoomIn">{{ $user->profile->position_held }}</h2>
        <h2 class="h5 text-white-op animated zoomIn" title="Id de usuario">User ID: {{ $user->public_code }}</h2>
        
    
       
       
        
        
    </div>
</div>
<!-- END Page Header -->

<!-- Stats -->
<div class="content bg-white border-b">
    <div class="row items-push text-uppercase">
    <div class="col-xs-6 col-sm-2">
        <div class="font-w700 text-gray-darker animated fadeIn" title="Solicitudes de cotización">Quotation Requests</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="/user/requests">{{ auth()->user()->requests->count() }}</a>
        </div>
        <div class="col-xs-6 col-sm-2">
            <div class="font-w700 text-gray-darker animated fadeIn" title="Cotizaciones">Quotations</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="/user/quotations">{{ auth()->user()->quotations->count() }}</a>
        </div>
        <div class="col-xs-6 col-sm-2">
            <div class="font-w700 text-gray-darker animated fadeIn" title="Creditos">Credits</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">{{ auth()->user()->creditRequests->count() }}</a>
        </div>
        <div class="col-xs-6 col-sm-2">
            <div class="font-w700 text-gray-darker animated fadeIn" title="Envios">Shippings</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">{{ auth()->user()->shippingRequests->count() }}</a>
        </div>
        <div class="col-xs-6 col-sm-2">
            <div class="font-w700 text-gray-darker animated fadeIn" title="Ordenes">Orders</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">{{ auth()->user()->purchaseOrders->count() }}</a>
        </div>
       
    </div>
</div>
<!-- END Stats -->

<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <div class="col-sm-7 col-lg-8">
            <!-- Company Data -->
            <div class="block">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        <li>
                            <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                        </li>
                        
                    </ul>
                    <h3 class="block-title" title="Compañia"><i class="fa fa-home"></i> Company</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                <div class="form-horizontal push-50">
                        <div class="col-xs-12 text-center push-30" >
                            <img src="{{ getLogo($company) }}" alt="Logo" id="company-logo" class="img-company-logo" />
                        
                           
                        </div>
                  
                       
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    {{ $company->company_name }}
                                    <label for="company_name" title="Nombre de compañia">Company Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    {{ $company->identification_number }}
                                    <label for="identification_number" title="Numero de identificación de la compañia">Company identification number</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    {{ $company->activity }}
                                    <label for="activity" title="Actividad en la plataforma OBC">Activity on the OBC platform</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    {{ $company->phones }}
                                    <label for="phones" title="Teléfonos">Phones</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    {{ $company->physical_address }}
                                    <label for="physical_address" title="Dirección física">Physical address</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    
                                        @foreach($company->countries as $item)
                                        <div>
                                            {{ $item->name }}
                                        </div>
                                        @endforeach
                                    
                                    <label for="country" title="País">Country</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    {{ $company->towns }}
                                    <label for="towns" title="Ciudad">Towns</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    {{ $company->web_address }}
                                    <label for="web_address" title="Dirección Web">Web address</label>
                                </div>
                            </div>
                        </div>
                    
                </div>
                </div>
            </div>
            <!-- END Company Data -->
        </div>
        <div class="col-sm-5 col-lg-4">
            <!-- Products -->
            <div class="block">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        
                    </ul>
                    <h3 class="block-title" title="Cuenta de usuario"><i class="fa fa-fw fa-user"></i> User Account</h3>
                </div>
                <div class="block-content">
                <form class="js-validation-register form-horizontal push-50" method="POST" action="/user/{{ $user->id }}">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                <div class="form-group{{ $errors->has('applicant_name') ? ' has-error' : '' }}">
                   <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="applicant_name" name="applicant_name" value="{{ $user->profile->applicant_name }}">
                                <label for="applicant_name" title="Nombre del solicitante"> Applicant name</label>
                                @if ($errors->has('applicant_name'))
                                    <span class="help-block">
                                        <strong title="{{ validationRequiredES('Nombre del solicitante') }}">{{ $errors->first('applicant_name') }}</strong>
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
                                        <strong title="{{ validationRequiredES('Primer apellido') }}">{{ $errors->first('first_surname') }}</strong>
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
                                        <strong title="{{ validationRequiredES('Segundo apellido') }}">{{ $errors->first('second_surname') }}</strong>
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
                                        <strong title="{{ validationRequiredES('Cargo que ocupa') }}">{{ $errors->first('position_held') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="phone" name="phone" value="{{ $user->profile->phone }}">
                                <label for="position_held" title="Teléfono"> Phone</label>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong title="{{ validationRequiredES('Teléfono') }}">{{ $errors->first('phone') }}</strong>
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
                                        <strong title="{{ validationRequiredES('Correo') }} y/o válido">{{ $errors->first('email') }}</strong>
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
                                        <strong title="{{ validationRequiredES('Contraseña') }}">{{ $errors->first('password') }}</strong>
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
                </div>
            </div>
            <!-- END Products -->

           
        </div>
    </div>
</div>
<!-- END Page Content -->


@endsection
@section('scripts')
<script src="/js/plugins/select2/select2.full.min.js"></script>
<script src="/js/plugins/ajaxupload.js"></script>
<script>
    jQuery('.js-select2').select2();
    $("#UploadPhoto").ajaxUpload({
      url : $("#UploadPhoto").data('url'),
      name: "photo",
      data: {_token: $('meta[name="csrf-token"]').attr('content')},
      onSubmit: function() {
          $('#infoBox').html('Uploading ... ');

      },
      onComplete: function(result) {

          if(result ==='error'){

            $('#infoBox').addClass('alert-danger').html('Error al subir archivo. Tipo no permitido!!').show();
              setTimeout(function()
              { 
                $('#infoBox').removeClass('alert-danger').hide();
              },3000);

         return

          }

          $('#infoBox').addClass('alert-success').html('La foto se ha guardado con exito!!').show();
            setTimeout(function()
            { 
              $('#infoBox').removeClass('alert-success').hide();
            },3000);
        d = new Date();
        
            $('#user-avatar').attr('src','/storage/'+ result+'?'+d.getTime());
      
      }
  });
  $("#UploadLogo").ajaxUpload({
      url : $("#UploadLogo").data('url'),
      name: "photo",
      data: {_token: $('meta[name="csrf-token"]').attr('content')},
      onSubmit: function() {
          $('#infoBox').html('Uploading ... ');

      },
      onComplete: function(result) {

          if(result ==='error'){

            $('#infoBox').addClass('alert-danger').html('Error al subir archivo. Tipo no permitido!!').show();
              setTimeout(function()
              { 
                $('#infoBox').removeClass('alert-danger').hide();
              },3000);

         return

          }

          $('#infoBox').addClass('alert-success').html('El logo se ha guardado con exito!!').show();
            setTimeout(function()
            { 
              $('#infoBox').removeClass('alert-success').hide();
            },3000);
        d = new Date();
        
            $('#company-logo').attr('src','/storage/'+ result+'?'+d.getTime());
      
      }
  });
</script>
@endsection

