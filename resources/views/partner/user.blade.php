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
           
            
        </div>
        <h1 class="h2 text-white push-5-t animated zoomIn">{{ $user->profile->applicant_name}} {{ $user->profile->first_surname}}</h1>
        <h2 class="h5 text-white-op animated zoomIn">{{ $user->profile->position_held }}</h2>
        <h2 class="h5 text-white-op animated zoomIn">User ID: {{ $user->public_code }}</h2>
        
    
       
       
        
        
    </div>
</div>
<!-- END Page Header -->

<!-- Stats -->
<div class="content bg-white border-b">
    <div class="row items-push text-uppercase">
        <div class="col-xs-6 col-sm-3">
            <div class="font-w700 text-gray-darker animated fadeIn">Quotations</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">17980</a>
        </div>
        <div class="col-xs-6 col-sm-3">
            <div class="font-w700 text-gray-darker animated fadeIn">Credits</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">27</a>
        </div>
        <div class="col-xs-6 col-sm-3">
            <div class="font-w700 text-gray-darker animated fadeIn">Shippings</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">1360</a>
        </div>
        <div class="col-xs-6 col-sm-3">
            <div class="font-w700 text-gray-darker animated fadeIn">Orders</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">1360</a>
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
                    <h3 class="block-title"><i class="fa fa-home"></i> Permissions</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                    <form class="js-validation-register form-horizontal push-50" method="POST" action="/partner/users/{{$user->id }}">
                         <input type="hidden" name="_method" value="PUT">
                                {{ csrf_field() }}
                        @foreach($permissions as $permission)
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="css-input switch switch-success">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"  @if ($user->can($permission->name) ) checked @endif><span></span> {{ $permission->label }}
                                </label>
                            </div>
                            
                        </div>
                        @endforeach
                       
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-6 col-md-5">
                                <button class="btn btn-block btn-success" type="submit">Update</button>
                            </div>
                        </div>
                    
                    </form>
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
                    <h3 class="block-title"><i class="fa fa-fw fa-user"></i> User Account</h3>
                </div>
                <div class="block-content">
                <form class="js-validation-register form-horizontal push-50" method="POST" action="#">
                    
                <div class="form-group{{ $errors->has('applicant_name') ? ' has-error' : '' }}">
                   <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                {{ $user->profile->applicant_name }}
                                <label for="applicant_name"> Applicant name</label>
                               
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('first_surname') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                {{ $user->profile->first_surname }}
                                <label for="first_surname"> First surname</label>
                               
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('second_surname') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                {{ $user->profile->second_surname  }}
                                <label for="second_surname"> Second surname</label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('position_held') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                {{ $user->profile->position_held }}
                                <label for="position_held"> Position held</label>
                               
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                {{ $user->profile->phone }}
                                <label for="position_held"> Phone</label>
                               
                            </div>
                        </div>
                    </div>
                
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                {{ $user->email }}
                                <label for="email">Email</label>
                                
                            </div>
                        </div>
                    </div>
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
      data: {},
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
      data: {},
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

