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
           
            <a class="UploadButton btn btn-xs btn-default btn-block" id="UploadPhoto" data-url="/profile/avatars" title="Cambiar">Change</a>
            <delete-avatar-profile :user-id="{{ $user->id }}" url="/profile/avatars"></delete-avatar-profile>
        </div>
        <h1 class="h2 text-white push-5-t animated zoomIn">{{ $user->profile->applicant_name}}</h1>
        <h2 class="h5 text-white-op animated zoomIn" title="ID Usuario: {{ $user->public_code }}">User ID: {{ $user->public_code }} <img src="{{ getFlag($company->countries->first()->code) }}" alt="flag"></h2>
        <h2 class="h5 text-white-op animated zoomIn" title="Código Privado">Private Code: </h2>
       
        <update-private-code :company-id="{{ $company->id }}" :private-code="'{{ $company->private_code }}'"></update-private-code>    
       
       
        
        
    </div>
</div>
<!-- END Page Header -->

<!-- Stats -->
<div class="content bg-white border-b">
    <div class="row items-push text-uppercase">
        <div class="col-xs-6 col-sm-2">
            <div class="font-w700 text-gray-darker animated fadeIn" title="Solicitudes de creditos">Credit Requests</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">0</a>
        </div>
       
        <div class="col-xs-6 col-sm-2">
            <div class="font-w700 text-gray-darker animated fadeIn" title="Creditos">Credits</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">0</a>
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
                <div class="col-xs-12 text-center" >
                            <img src="{{ getLogo($company) }}" alt="Logo" id="company-logo" class="img-company-logo" />
                            
                            
                        </div>
                        <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                                <a class="UploadButton UploadButtonLogo btn btn-xs btn-info btn-block" id="UploadLogo" data-url="/partner/company/logo" title="Cambiar logo">Change Logo</a>
                            </div>
                    <form class="js-validation-register form-horizontal push-50-t push-50" method="POST" action="/partner/companies/{{$company->id}}">
                         <input type="hidden" name="_method" value="PUT">
                                {{ csrf_field() }}
                                @include('partner/partials/form-company')
                   
                    </form>
                </div>
            </div>
            <!-- END Timeline -->
        </div>
        <div class="col-sm-5 col-lg-4">
            <!-- Products -->
             <div class="block">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        
                    </ul>
                    <h3 class="block-title" title="% interes para creditos"><i class="fa fa-fw fa-user"></i> % Interest for credits</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-register form-horizontal push-50" method="POST" action="/credit/companies/{{ $company->id }}/interest">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('interest_30') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="interest_30" name="interest_30" value="{{ $company->interest->interest_30 }}">
                                        <label for="interest_30" title="% Interes para 30 dias"> % Interest for 30 days </label>
                                        @if ($errors->has('interest_30'))
                                            <span class="help-block">
                                                <strong title="{{ validationRequiredES('% Interes para 30 dias') }}">{{ $errors->first('interest_30') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('interest_45') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="interest_45" name="interest_45" value="{{ $company->interest->interest_45 }}">
                                        <label for="interest_45" title="% Interes para 45 dias"> % Interest for 45 days </label>
                                        @if ($errors->has('interest_45'))
                                            <span class="help-block">
                                                <strong title="{{ validationRequiredES('% Interes para 45 dias') }}">{{ $errors->first('interest_45') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('interest_60') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="interest_60" name="interest_60" value="{{ $company->interest->interest_60 }}">
                                        <label for="interest_60" title="% Interes para 60 dias"> % Interest for 60 days </label>
                                        @if ($errors->has('interest_60'))
                                            <span class="help-block">
                                                <strong title="{{ validationRequiredES('% Interes para 60 dias') }}">{{ $errors->first('interest_60') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="col-xs-12 col-sm-6 col-md-5">
                               
                                    <button class="btn btn-success" type="submit" title="Guardar">Save</button>
                              
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            <div class="block">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        
                    </ul>
                    <h3 class="block-title" title="Cuenta de usuario"><i class="fa fa-fw fa-user"></i> User Account</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-register form-horizontal push-50" method="POST" action="/partner/{{ $user->id }}">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                         @include('partner/partials/form-profile')
                    </form>
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

