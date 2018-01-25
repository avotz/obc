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
         
       
       
       
        
        
    </div>
</div>
<!-- END Page Header -->


<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        
        <div class="col-sm-7 col-lg-8">
            <!-- Products -->
            <div class="block">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        
                    </ul>
                    <h3 class="block-title" title="Cuenta de usuario"><i class="fa fa-fw fa-user"></i> User Account</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-register form-horizontal push-50" method="POST" action="/admin/users/{{ $user->id }}">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                         @include('admin/users/partials/form')
                    </form>
                </div>
            </div>
            <!-- END Products -->

           
        </div>
        <div class="col-sm-5 col-lg-4">
            <!-- Company Data -->
            @if($user->hasRole('admin'))
            <div class="block">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        <li>
                            <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                        </li>
                        
                    </ul>
                    <h3 class="block-title" title="Permisos"><i class="fa fa-home"></i> Permissions</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                    <form class="js-validation-register form-horizontal push-50" method="POST" action="/admin/users/{{$user->id }}/permissions">
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
                                <button class="btn btn-block btn-success" type="submit" title="Actualizar" >Update</button>
                            </div>
                        </div>
                    
                    </form>
                </div>
            </div>
            @endif
            <!-- END Company Data -->

           
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

