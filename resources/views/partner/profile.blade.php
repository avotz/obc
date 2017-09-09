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
        <h1 class="h2 text-white push-5-t animated zoomIn">{{ $user->profile->applicant_name}}</h1>
        <h2 class="h5 text-white-op animated zoomIn">Partner ID: {{ $user->public_code }}-{{ $user->company->countries->first()->code }} <img src="{{ getFlag($user->company->countries->first()->code) }}" alt="flag"></h2>
        <h2 class="h5 text-white-op animated zoomIn">Private Code: </h2>
       
        <update-private-code :partner-id="{{ $user->id }}" :private-code="'{{ $user->private_code }}'"></update-private-code>    
       
       
        
        
    </div>
</div>
<!-- END Page Header -->

<!-- Stats -->
<div class="content bg-white border-b">
    <div class="row items-push text-uppercase">
        <div class="col-xs-6 col-sm-2">
            <div class="font-w700 text-gray-darker animated fadeIn">Quotations</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">17980</a>
        </div>
        <div class="col-xs-6 col-sm-2">
            <div class="font-w700 text-gray-darker animated fadeIn">Credits</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">27</a>
        </div>
        <div class="col-xs-6 col-sm-2">
            <div class="font-w700 text-gray-darker animated fadeIn">Shippings</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">1360</a>
        </div>
        <div class="col-xs-6 col-sm-2">
            <div class="font-w700 text-gray-darker animated fadeIn">Orders</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">1360</a>
        </div>
        <div class="col-xs-6 col-sm-2">
            <div class="font-w700 text-gray-darker animated fadeIn">Partners</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="/partner/users">10</a>
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
                <div class="col-xs-12 text-center" >
                            <img src="{{ getLogo($user->company) }}" alt="Logo" id="company-logo" class="img-company-logo" />
                        
                            <a class="UploadButton UploadButtonLogo btn btn-xs btn-default btn-block" id="UploadLogo" data-url="/partner/company/logo">Change Logo</a>
                        </div>
                    <form class="js-validation-register form-horizontal push-50-t push-50" method="POST" action="/partner/companies/{{$user->company->id}}">
                         <input type="hidden" name="_method" value="PUT">
                                {{ csrf_field() }}
                       
                    <div class="form-group" >
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                {{ $user->company->company_name }}
                                <label for="company_name">Company Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                {{ $user->company->identification_number }}
                                <label for="identification_number">Company identification number</label>
                            </div>
                        </div>
                    </div>
                         
                    <div class="form-group{{ $errors->has('activity') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <select name="activity" id="activity"  class="form-control">
                                    <option value=""></option>
                                    <option value="1" @if($user->activity == 1) selected="selected" @endif>Consumer</option>
                                    <option value="2" @if($user->activity == 2) selected="selected" @endif>Supplier</option>
                                </select>
                                <label for="activity">  Activity on the OBC platform</label>
                                @if ($errors->has('activity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('activity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                               
                                    <select name="sectors[]" id="sectors"  class="js-select2 form-control" style="width:100%;" multiple data-placeholder="Type to search for a sector"> 
                                    @foreach ($sectors as $sector)
                                            @include('layouts.partials.sector-select', ['company' => $user->company])
                                        @endforeach
                                </select>
                                  
                                <label for="sectors">  Sectors and subsectors</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('phones') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="phones" name="phones" value="{{$user->company->phones }}">
                                <label for="phones"> Phones</label>
                                @if ($errors->has('phones'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phones') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('physical_address') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="physical_address" name="physical_address" value="{{ $user->company->physical_address }}">
                                <label for="physical_address"> Physical address</label>
                                @if ($errors->has('physical_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('physical_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <select class="form-control" name="country" id="country" >
                                    <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                    @foreach($countries as $country)    
                                        <option value="{{ $country->id }}" @if($user->company->countries->first()->id == $country->id) selected="selected" @endif>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <label for="country"> Country</label>
                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                
                    <div class="form-group{{ $errors->has('towns') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="towns" name="towns" value="{{ $user->company->towns }}">
                                <label for="towns"> Towns</label>
                                @if ($errors->has('towns'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('towns') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('web_address') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="web_address" name="web_address" value="{{ $user->company->web_address }}">
                                <label for="web_address"> Web address</label>
                                @if ($errors->has('web_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('web_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('legal_name') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="legal_name" name="legal_name" value="{{ $user->company->legal_name }}">
                                <label for="legal_name"> Name of the legal representative</label>
                                @if ($errors->has('legal_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('legal_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('legal_first_surname') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="legal_first_surname" name="legal_first_surname" value="{{ $user->company->legal_first_surname }}">
                                <label for="legal_first_surname"> First surname</label>
                                @if ($errors->has('legal_first_surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('legal_first_surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('legal_second_surname') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="legal_second_surname" name="legal_second_surname" value="{{ $user->company->legal_second_surname }}">
                                <label for="legal_second_surname"> Second surname</label>
                                @if ($errors->has('legal_second_surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('legal_second_surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('legal_email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="email" id="legal_email" name="legal_email" value="{{ $user->company->legal_email }}">
                                <label for="legal_email">Email</label>
                                @if ($errors->has('legal_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('legal_email') }}</strong>
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

