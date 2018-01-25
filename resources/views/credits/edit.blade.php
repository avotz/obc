@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="/js/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="/js/plugins/magnific-popup/magnific-popup.min.css">
@endsection
@section('content')
<div id="infoBox" class="alert alert-success" ></div>
 <!-- Page Header -->
 <div class="content bg-image" style="background-image: url('/img/photo-profile.jpg');">
    <div class="push-50-t push-15 clearfix">
        
        <h1 class="h2 text-white push-5-t animated zoomIn" title="Editar crédito">Edit Credit </h1><small class="label label-{{ trans('utils.purchase_status_color.'.$credit->status) }}">{{ trans('utils.credit_status.'.$credit->status) }}</small>
        
           
    
       
       
        
        
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <div class="col-sm-7 col-lg-8">

        <div class="block">
                
                <div class="block-content">
                    <form class="js-validation-register form-horizontal push-50" method="POST" action="/credits/{{ $credit->id }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">              
                        {{ csrf_field() }}
                        @include('credits/partials/show') 
                    
                    </form>
                       
                    
                    <form method="post" id="form-status-approved">
                     <input name="_method" type="hidden" value="PUT">{{ csrf_field() }}
                     <input type="hidden" value="1" name="status">
                    </form>
                     <form method="post" id="form-status-reject">
                        <input name="_method" type="hidden" value="PUT">{{ csrf_field() }}
                       <input type="hidden" value="2" name="status">
                    </form>
                     
                  
                
                   

                </div>
        </div>



               

        </div>
        <div class="col-sm-5 col-lg-4">
            
        <div class="col-sm-12">
                <div class="block block-link-hover3" href="javascript:void(0)">
                     @include('quotations/partials/item') 
                   
                </div>
            </div>
           
        </div>
    </div>
</div>
<!-- END Page Content -->


@endsection
@section('scripts')
<script src="/js/plugins/select2/select2.full.min.js"></script>
<script src="/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="/js/plugins/ajaxupload.js"></script>
<script src="/js/plugins/magnific-popup/magnific-popup.min.js"></script>
<script src="{{ mix('/js/shippings.js') }}"></script>

<script>
        // Init page helpers (Magnific Popup plugin)
        App.initHelpers('magnific-popup');

</script>
@endsection

