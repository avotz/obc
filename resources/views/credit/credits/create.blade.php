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
        
        <h1 class="h2 text-white push-5-t animated zoomIn">Credit for Quotation -{{ $quotation->id }} </h1>
        
           
    
       
       
        
        
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
                    <!-- <div class="block-content block-content-full text-center">
                        <div>
                        
                            <img src="{{ getLogo($partner) }}" alt="Logo" id="company-logo" class="img-company-logo  " />
                            
                        </div>
                        <div class="h5 push-15-t push-5">Quotation #{{ $quotation->id }} </div> <small class="label label-{{ trans('utils.public.colors.'.$quotation->request->public) }}">{{ trans('utils.public.'.$quotation->request->public) }}</small>
                       
                        @if($quotation->product_photo)
                            <div class="h5 push-15-t push-5"><b>Product:</b> <span class="js-gallery label label-danger"><a href="{{ getQuotationProductPhoto($quotation) }}" class="img-link" > Photo</a></span> </div>
                        @else 
                            <div class="h5 push-15-t push-5"><b>Product:</b> <span class="js-gallery"><a href="{{ getRequestProductPhoto($quotation->request) }}" class="img-link" >Photo</a></span> </div>
                        @endif
                    </div>
                    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                        <div class=" "><b>Partner name:</b> {{ $partner->company_name }}</div>
                        <div class=" "><b>Partner country:</b> {{ $partner->countries->first()->name }} <img src="{{ getFlag($partner->countries->first()->code) }}" alt="flag"></div>
                        <div class=""><b>Supplier sector:</b>  
                        
                              {{ implode(",", $quotation->request->sectors->first()->ancestors->pluck('name')->toArray()) }} 
                             
                       </div>
                      <div class=" "><b>Supplier sub-sector:</b> 
                        
                          {{ implode(",", $quotation->request->sectors->pluck('name')->toArray()) }}
                         
                      </div>
                        <div class=" "><b>Delivery time:</b> {{ $quotation->delivery_time }}</div>
                        <div class=" "><b>Way of delivery:</b> {{ $quotation->way_of_delivery }}</div>
                        <div class=" "><b>Way to pay:</b>  @if( $quotation->way_to_pay ) Credit {{ $quotation->way_to_pay }} Days @else Cash @endif</div>
                        <div class=" "><b>Request valid until:</b> {{ $quotation->request->exp_date }} </div>
                        <div class=" "><b>Additional comment:</b> {{ $quotation->comments }}</div>
                    </div>
                    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                        <div class=" "><b>Partner ID:</b> {{ $partner->public_code }} </div>
                        <div class=" "><b>Transaction ID:</b> {{ $quotation->transaction_id }}</div>
                        <div class=""><b>User ID:</b> {{ $user->public_code }} / {{ $user->profile->fullname }} / {{ $user->profile->position_held }}</div>
                        <div class=" "><b>Date:</b> {{ $quotation->created_at }} </div>
                    
                        
                    </div>
                    <div class="block-content">
                        <div class="row items-push text-center">
                            
                            
                        </div>
                    </div> -->
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

