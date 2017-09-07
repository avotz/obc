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
            <img src="{{ getAvatar($user) }}" alt="Avatar" class="img-avatar img-avatar-thumb" />
           
            <a class="UploadButton btn btn-xs btn-default btn-block" id="UploadPhoto" data-url="/partner/profile/avatars">Change</a>
        </div>
        <h1 class="h2 text-white push-5-t animated zoomIn">{{ $user->profile->applicant_name}}</h1>
        <h2 class="h5 text-white-op animated zoomIn">Partner ID: {{ $user->public_code }}-@foreach($user->company->countries as $country){{ $country->code }} <img src="{{ getFlag($country->code) }}" alt="{{ $country->code }}">  @endforeach</h2>
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
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">10</a>
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
                        <li>
                            <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title"><i class="fa fa-newspaper-o"></i> Company</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                    <form class="js-validation-register form-horizontal push-50-t push-50" method="POST" action="/partner/companies/{{$user->company->id}}">
                         <input type="hidden" name="_method" value="PUT">
                                {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="company_name" name="company_name" value="{{ $user->company->company_name }}" disabled>
                                <label for="company_name">Company Name</label>
                                @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('identification_number') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="identification_number" name="identification_number" value="{{ $user->company->identification_number }}" disabled>
                                <label for="identification_number"> Company identification number</label>
                                @if ($errors->has('identification_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('identification_number') }}</strong>
                                    </span>
                                @endif
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
                                <select class="js-select2 form-control" name="country[]" id="country" style="width: 100%;" data-placeholder="Choose country.." multiple >
                                    <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                    @foreach($user->company->countries as $country)    
                                        <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
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
                        <li>
                            <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title"><i class="fa fa-fw fa-briefcase"></i> Products</h3>
                </div>
                <div class="block-content">
                    <ul class="list list-simple list-li-clearfix">
                        <li>
                            <a class="item item-rounded pull-left push-10-r bg-info" href="javascript:void(0)">
                                <i class="si si-rocket text-white-op"></i>
                            </a>
                            <h5 class="push-10-t">MyPanel</h5>
                            <div class="font-s13">Responsive App Template</div>
                        </li>
                        <li>
                            <a class="item item-rounded pull-left push-10-r bg-amethyst" href="javascript:void(0)">
                                <i class="si si-calendar text-white-op"></i>
                            </a>
                            <h5 class="push-10-t">Project Time</h5>
                            <div class="font-s13">Web application</div>
                        </li>
                        <li>
                            <a class="item item-rounded pull-left push-10-r bg-danger" href="javascript:void(0)">
                                <i class="si si-speedometer text-white-op"></i>
                            </a>
                            <h5 class="push-10-t">iDashboard</h5>
                            <div class="font-s13">Bootstrap Admin Template</div>
                        </li>
                    </ul>
                    <div class="text-center push">
                        <small><a href="javascript:void(0)">View More..</a></small>
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
        
            $('.img-avatar').attr('src','/storage/'+ result+'?'+d.getTime());
      
      }
  });
</script>
@endsection

