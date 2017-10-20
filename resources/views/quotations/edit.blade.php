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
        
        <h1 class="h2 text-white push-5-t animated zoomIn">Edit Quotation</h1>
        
           
    
       
       
        
        
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <div class="col-sm-7 col-lg-8">

        <div class="block">
                
                <div class="block-content">
                    <form class="js-validation-register form-horizontal push-50" method="POST" action="/quotations/{{ $quotation->id }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">              
                        {{ csrf_field() }}
                       
                        @if(!$quotation->purchase) 
                            @include('quotations/partials/form')
                        @else
                            @include('quotations/partials/show') 
                        @endif 
                    
                    </form>

                </div>
        </div>



               

        </div>
        <div class="col-sm-5 col-lg-4">
            
        <div class="col-sm-12">
                <div class="block block-link-hover3" href="javascript:void(0)">
                    <div class="block-content block-content-full text-center">
                        <div>
                        
                            <img src="{{ getLogo($partner->company) }}" alt="Logo" id="company-logo" class="img-company-logo  " />
                            
                        </div>
                        <div class="h5 push-15-t push-5">Quotation Request #{{ $quotationRequest->id }} </div> <small class="label label-{{ trans('utils.public.colors.'.$quotationRequest->public) }}">{{ trans('utils.public.'.$quotationRequest->public) }}</small>
                        <div class="h5 push-15-t push-5"><b>Product:</b> <span class="js-gallery"><a href="{{ getRequestProductPhoto($quotationRequest) }}" class="img-link" >{{ $quotationRequest->product_name }}</a></span> </div>
                    </div>
                    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                        <div class=" "><b>Partner name:</b> {{ $partner->company->company_name }}</div>
                        <div class=" "><b>Partner country:</b> {{ $partner->company->countries->first()->name }} <img src="{{ getFlag($partner->company->countries->first()->code) }}" alt="flag"></div>
                        <div class=""><b>Supplier sector:</b>  
                        
                              {{ implode(",", $quotationRequest->sectors->first()->ancestors->pluck('name')->toArray()) }} 
                             
                       </div>
                      <div class=" "><b>Supplier sub-sector:</b> 
                        
                          {{ implode(",", $quotationRequest->sectors->pluck('name')->toArray()) }}
                         
                      </div>
                        <div class=" "><b>Delivery time:</b> {{ $quotationRequest->delivery_time }}</div>
                        <div class=" "><b>Way of delivery:</b> {{ $quotationRequest->way_of_delivery }}</div>
                        <div class=" "><b>Way to pay:</b>  @if( $quotationRequest->way_to_pay ) Credit {{ $quotationRequest->way_to_pay }} Days @else Cash @endif</div>
                        <div class=" "><b>Request valid until:</b> {{ $quotationRequest->exp_date }} </div>
                        <div class=" "><b>Additional comment:</b> {{ $quotationRequest->comments }}</div>
                    </div>
                    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                        <div class=" "><b>Partner ID:</b> {{ $partner->public_code }} </div>
                        <div class=" "><b>Transaction ID:</b> {{ $quotationRequest->transaction_id }}</div>
                        <div class=""><b>User ID:</b> {{ Optional($user)->public_code }}  @if($user) / {{ $user->profile->fullname }} / {{ $user->profile->position_held }}  @endif   </div>
                        <div class=" "><b>Date:</b> {{ $quotationRequest->created_at }} </div>
                    
                        
                    </div>
                    <div class="block-content">
                        <div class="row items-push text-center">
                            
                            
                        </div>
                    </div>
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
<script src="{{ mix('/js/quotations.js') }}"></script>

@endsection

