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
           @if($user->countries->first())
            <div class="col-xs-12 col-md-4">
                <update-country :user-id="{{ $user->id }}" :current-country="{{ $user->countries->first() }}" :countries="{{ $countries }}" color-label="text-white-op"></update-country> 
            </div>
            @endif
        
       
           
    
       
       
        
        
    </div>
</div>
<!-- END Page Header -->

<!-- Stats -->
<!-- <div class="content bg-white border-b">
    <div class="row items-push text-uppercase">
        <div class="col-xs-6 col-sm-3">
            <div class="font-w700 text-gray-darker animated fadeIn">Partners</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)"></a>
        </div>
        
       
    </div>
</div> -->
<!-- END Stats -->

<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <div class="col-sm-7 col-lg-8">
            <!-- Products -->
            @if($user->hasRole('partner') || $user->hasRole('user'))
            <div class="block">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        
                    </ul>
                    <h3 class="block-title" title="Compañia"><i class="fa fa-fw fa-user"></i> Company</h3>
                </div>
                <div class="block-content">
               
                 <form class="js-validation-register form-horizontal push-50" method="POST" action="/superadmin/users/{{ $user->id }}/companies/{{$user->companies->first()->id}}">
                     <input type="hidden" name="_method" value="PUT">
                                {{ csrf_field() }}
                           @include('partner/partials/form-company',['company' => $user->companies->first(), 'sectors'=> $sectors ])
                    </form>
                    
             
                    
                    
                </div>
            </div>
            @else
                <div class="block">
                    <div class="block-header bg-gray-lighter">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                            </li>
                            
                        </ul>
                        <h3 class="block-title" title="Cuenta de usuario"><i class="fa fa-home"></i> User Account</h3>
                    </div>
                    <div class="block-content block-content-full block-content-narrow">
                        <form class="js-validation-register form-horizontal push-50" method="POST" action="/superadmin/users/{{ $user->id }}">
                        <input type="hidden" name="_method" value="PUT">  
                        {{ csrf_field() }}
                        
                        @include('superadmin/users/partials/form')

                    
                        
                        </form>
                    </div>
                </div>

            @endif
            <!-- END Products -->
        </div>
        <div class="col-sm-5 col-lg-4">
            <!-- permission Data -->
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
                    <form class="js-validation-register form-horizontal push-50" method="POST" action="/superadmin/users/{{$user->id }}/permissions">
                         <input type="hidden" name="_method" value="PUT">
                                {{ csrf_field() }}
                        @foreach($permissions as $permission)
                            @include('layouts.partials.permissionsChecks')
                        @endforeach
                       
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-6 col-md-5">
                                <button class="btn btn-block btn-success" type="submit" title="Actualizar">Update</button>
                            </div>
                        </div>
                    
                    </form>
                </div>
            </div>
            <!-- END permission Data -->
            @if($user->hasRole('partner') || $user->hasRole('user'))
            <div class="block">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        <li>
                            <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                        </li>
                        
                    </ul>
                    <h3 class="block-title" title="Cuenta de usuario"><i class="fa fa-home"></i> User Account</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                    <form class="js-validation-register form-horizontal push-50" method="POST" action="/superadmin/users/{{ $user->id }}">
                    <input type="hidden" name="_method" value="PUT">  
                    {{ csrf_field() }}
                    
                    @include('superadmin/users/partials/form')

                  
                    
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
   

    jQuery('.select-country').select2({
         language: {
            noResults: function (params) {
                return '<span title="País no encontrado">Country not found.</span>';
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        }
    });

    function matchEsLabel(params, data) {
       
       // If there are no search terms, return all of the data
        if ($.trim(params.term) === '') {
            return data;
        }

        // Skip if there is no 'children' property
        if (typeof data.children === 'undefined') {
            return null;
        }

        // `data.children` contains the actual options that we are matching against
        var filteredChildren = [];
        $.each(data.children, function (idx, child) {
            if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0 || child.title.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
            filteredChildren.push(child);
            }
        });

        // If we matched any of the timezone group's children, then set the matched children on the group
        // and return the group object
        if (filteredChildren.length) {
            var modifiedData = $.extend({}, data, true);
            modifiedData.children = filteredChildren;

            // You can return modified objects from here
            // This includes matching the `children` how you want in nested data sets
            return modifiedData;
        }

        // Return `null` if the term should not be displayed
        return null;
    }

    jQuery('.select-sectors').select2({
        matcher: matchEsLabel
    });

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

  @if(isset($user) && $user->hasRole('superadmin'))
    jQuery('.global-settings').show();
  @else 
    jQuery('.global-settings').hide();
  @endif

  jQuery('select[name=role]').change(function(e){
        if(jQuery(this).val() != '1'){ //admin
            jQuery('.global-settings').hide();
        }else{
             jQuery('.global-settings').show();
        }
    });
</script>
@endsection

