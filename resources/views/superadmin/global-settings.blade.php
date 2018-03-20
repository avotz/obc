@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="/js/plugins/select2/select2.min.css">
@endsection
@section('content')
<div id="infoBox" class="alert alert-success" ></div>
 <!-- Page Header -->
 <div class="content bg-image" style="background-image: url('/img/photo-profile.jpg');">
    <div class="push-50-t push-15 clearfix">
    
        
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
                    <h3 class="block-title" title="Opciones globales"><i class="fa fa-fw fa-user"></i> Global Settings</h3>
                </div>
                <div class="block-content">
                     <form class="js-validation-register form-horizontal push-50" method="POST" action="/superadmin/settings">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="discount" name="discount" value="{{ $global->discount }}">
                                        <label for="interest_30" title="% descuento de OBC">% Discount OBC </label>
                                        @if ($errors->has('discount'))
                                            <span class="help-block">
                                                <strong title="{{ validationRequiredES('% descuento') }}">{{ $errors->first('discount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('gross_commission') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="gross_commission" name="gross_commission" value="{{ $global->gross_commission }}">
                                        <label for="interest_30" title="% comisión de OBC">% Commission OBC </label>
                                        @if ($errors->has('gross_commission'))
                                            <span class="help-block">
                                                <strong title="{{ validationRequiredES('% comisión') }}">{{ $errors->first('gross_commission') }}</strong>
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
            <!-- END Products -->
           
        </div>
       
    </div>
</div>
<!-- END Page Content -->