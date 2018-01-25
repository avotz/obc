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
        
        <h1 class="h2 text-white push-5-t animated zoomIn" title="Credito para la cotización -{{ $quotation->id }}">Credit for Quotation -{{ $quotation->id }} </h1>
        
           
    
       
       
        
        
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <div class="col-sm-7 col-lg-8">

        <div class="block">
                
                <div class="block-content">
                    <form class="js-validation-register form-horizontal push-50" method="POST" action="/credit/credit-requests/{{ $creditRequest->id }}/credits" enctype="multipart/form-data">
                                        
                        {{ csrf_field() }}
                        @include('credit/credits/partials/form') 
                    
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
<script src="{{ mix('/js/credits.js') }}"></script>
<script>
        // Init page helpers (Magnific Popup plugin)
        App.initHelpers('magnific-popup');
        
        jQuery('select[name=credit_time]').change(function (e) {
            if (jQuery(this).val() == '30') {
                jQuery('#interest').val({{ $interests->interest_30 }});
            } 
            if (jQuery(this).val() == '45') {
                jQuery('#interest').val({{ $interests->interest_45 }});
            } 
            if (jQuery(this).val() == '60') {
                jQuery('#interest').val({{ $interests->interest_60 }});
            } 
          
            var amount = parseFloat(jQuery('#amount').val());
            var interest = parseFloat(jQuery('#interest').val() / 100);

            var subtotal = interest * amount;

            var total = amount + subtotal;

            jQuery('#total').val(total);

        });

</script>
@endsection

