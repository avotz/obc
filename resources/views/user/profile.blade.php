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
           
            <a class="UploadButton btn btn-xs btn-default btn-block" id="UploadPhoto" data-url="/partner/profile/avatars">Change</a>
        </div>
        <h1 class="h2 text-white push-5-t animated zoomIn">{{ $user->profile->applicant_name}} {{ $user->profile->first_surname}}</h1>
        <h2 class="h5 text-white-op animated zoomIn">{{ $user->profile->position_held }}</h2>
        <h2 class="h5 text-white-op animated zoomIn">User ID: {{ $user->usr_public_code }}</h2>
        
    
       
       
        
        
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
                    <h3 class="block-title"><i class="fa fa-home"></i> Company</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                <div class="form-horizontal push-50">
                        <div class="col-xs-12 text-center push-30" >
                            <img src="{{ getLogo($user->partners->first()->company) }}" alt="Logo" id="company-logo" class="img-company-logo" />
                        
                           
                        </div>
                  
                       
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    {{ $user->partners->first()->company->company_name }}
                                    <label for="company_name">Company Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    {{ $user->partners->first()->company->identification_number }}
                                    <label for="identification_number">Company identification number</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    {{ $user->partners->first()->company->activity }}
                                    <label for="activity">Activity on the OBC platform</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    {{ $user->partners->first()->company->phones }}
                                    <label for="phones">Phones</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    {{ $user->partners->first()->company->physical_address }}
                                    <label for="physical_address">Physical address</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    
                                        @foreach($user->partners->first()->company->countries as $item)
                                        <div>
                                            {{ $item->name }}
                                        </div>
                                        @endforeach
                                    
                                    <label for="country">Country</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    {{ $user->partners->first()->company->towns }}
                                    <label for="towns">Towns</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    {{ $user->partners->first()->company->web_address }}
                                    <label for="web_address">Web address</label>
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
                    <h3 class="block-title"><i class="fa fa-fw fa-user"></i> Partner Account</h3>
                </div>
                <div class="block-content">
                <form class="js-validation-register form-horizontal push-50" method="POST" action="/partner/{{ $user->id }}">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                <div class="form-group{{ $errors->has('applicant_name') ? ' has-error' : '' }}">
                   <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="applicant_name" name="applicant_name" value="{{ $user->profile->applicant_name }}">
                                <label for="applicant_name"> Applicant name</label>
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
                                <input class="form-control" type="text" id="first_surname" name="first_surname" value="{{ $user->profile->first_surname }}">
                                <label for="first_surname"> First surname</label>
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
                                <input class="form-control" type="text" id="second_surname" name="second_surname" value="{{ $user->profile->second_surname  }}">
                                <label for="second_surname"> Second surname</label>
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
                                <input class="form-control" type="text" id="position_held" name="position_held" value="{{ $user->profile->position_held }}">
                                <label for="position_held"> Position held</label>
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
                                <input class="form-control" type="text" id="phone" name="phone" value="{{ $user->profile->phone }}">
                                <label for="position_held"> Phone</label>
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
                                <input class="form-control" type="email" id="email" name="email" value="{{ $user->email }}">
                                <label for="email">Email</label>
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
                                <input class="form-control" type="password" id="password" name="password">
                                <label for="password">Change Password</label>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-6 col-md-5">
                            <button class="btn btn-block btn-success" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Products -->

            <!-- Ratings -->
            <div class="block">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        <li>
                            <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title"><i class="fa fa-fw fa-pencil"></i> Ratings</h3>
                </div>
                <div class="block-content">
                    <ul class="list list-simple">
                        <li>
                            <div class="push-5 clearfix">
                                <div class="text-warning pull-right">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <a class="font-w600" href="base_pages_profile.html">Tiffany Kim</a>
                                <span class="text-muted">(5/5)</span>
                            </div>
                            <div class="font-s13">Flawless design execution! I'm really impressed with the product, it really helped me build my app so fast! Thank you!</div>
                        </li>
                        <li>
                            <div class="push-5 clearfix">
                                <div class="text-warning pull-right">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <a class="font-w600" href="base_pages_profile.html">Lisa Gordon</a>
                                <span class="text-muted">(5/5)</span>
                            </div>
                            <div class="font-s13">Great value for money and awesome support! Would buy again and again! Thanks!</div>
                        </li>
                        <li>
                            <div class="push-5 clearfix">
                                <div class="text-warning pull-right">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <a class="font-w600" href="base_pages_profile.html">Craig Stone</a>
                                <span class="text-muted">(5/5)</span>
                            </div>
                            <div class="font-s13">Working great in all my devices, quality and quantity in a great package! Thank you!</div>
                        </li>
                    </ul>
                    <div class="text-center push">
                        <small><a href="javascript:void(0)">Read More..</a></small>
                    </div>
                </div>
            </div>
            <!-- END Ratings -->

            <!-- Followers -->
            <div class="block">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        <li>
                            <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title"><i class="fa fa-fw fa-share-alt"></i> Followers</h3>
                </div>
                <div class="block-content">
                    <ul class="nav-users push">
                        <li>
                            <a href="base_pages_profile.html">
                                <img class="img-avatar" src="assets/img/avatars/avatar14.jpg" alt="">
                                <i class="fa fa-circle text-success"></i> Joshua Munoz
                                <div class="font-w400 text-muted"><small>Web Developer</small></div>
                            </a>
                        </li>
                        <li>
                            <a href="base_pages_profile.html">
                                <img class="img-avatar" src="assets/img/avatars/avatar4.jpg" alt="">
                                <i class="fa fa-circle text-success"></i> Tiffany Kim
                                <div class="font-w400 text-muted"><small>Web Designer</small></div>
                            </a>
                        </li>
                        <li>
                            <a href="base_pages_profile.html">
                                <img class="img-avatar" src="assets/img/avatars/avatar2.jpg" alt="">
                                <i class="fa fa-circle text-warning"></i> Julia Cole
                                <div class="font-w400 text-muted"><small>Photographer</small></div>
                            </a>
                        </li>
                    </ul>
                    <div class="text-center push">
                        <small><a href="javascript:void(0)">Load More..</a></small>
                    </div>
                </div>
            </div>
            <!-- END Followers -->
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

