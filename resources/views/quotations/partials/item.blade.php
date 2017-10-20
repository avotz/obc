<div class="block-content block-content-full text-center">
        <div>
            
            <img src="{{ getLogo($partner->company) }}" alt="Logo" id="company-logo" class="img-company-logo  " />
            
        </div>
        <div class="h5 push-15-t push-5">Quotation #{{ $quotation->id }} Request #{{ $quotation->request->id }} </div> <small class="label label-{{ trans('utils.public.colors.'.$quotation->request->public) }}">{{ trans('utils.public.'.$quotation->request->public) }}</small>
        @if($quotation->product_photo)
            <div class="h5 push-15-t push-5"><b>Product:</b> <span class="js-gallery label label-danger"><a href="{{ getQuotationProductPhoto($quotation) }}" class="img-link" > {{ $quotation->product_name }}</a></span> </div>
        @else 
            <div class="h5 push-15-t push-5"><b>Product:</b> <span class="js-gallery"><a href="{{ getRequestProductPhoto($quotation->request) }}" class="img-link" >{{ $quotation->request->product_name }}</a></span> </div>
        @endif
    </div>
    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
        <div class=" "><b>Partner name:</b> {{ $partner->company->company_name }}</div>
        <div class=" "><b>Partner country:</b> {{ $partner->company->countries->first()->name }} <img src="{{ getFlag($partner->company->countries->first()->code) }}" alt="flag"></div>
        <div class=""><b>Supplier sector:</b>  
        
              {{ implode(",", $quotation->request->sectors->first()->ancestors->pluck('name')->toArray()) }} 
             
       </div>
      <div class=" "><b>Supplier sub-sector:</b> 
        
          {{ implode(",", $quotation->request->sectors->pluck('name')->toArray()) }}
         
      </div>
        <div class=" "><b>Delivery time:</b> <span class="{{ ($quotation->request->delivery_time != $quotation->delivery_time) ? 'label label-danger' : '' }}">{{ $quotation->delivery_time }}</span></div>
        <div class=" "><b>Way of delivery:</b> <span class="{{ ($quotation->request->way_of_delivery != $quotation->way_of_delivery) ? 'label label-danger' : '' }}">{{ $quotation->way_of_delivery }}</span></div>
        <div class=" "><b>Way to pay:</b> <span class="{{ ($quotation->request->way_to_pay != $quotation->way_to_pay) ? 'label label-danger' : '' }}">@if( $quotation->way_to_pay ) Credit {{ $quotation->way_to_pay }} Days @else Cash @endif</span></div>
        <div class=" "><b>Request valid until:</b> {{ $quotation->request->exp_date }} </div>
        <div class=" "><b>Additional comment:</b> <span class="{{ ($quotation->request->comments != $quotation->comments) ? 'label label-danger' : '' }}">{{ $quotation->comments }}</span></div>
    </div>
    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
    <div class=" "><b>Partner ID:</b> {{ $partner->public_code }} </div>
    <div class=" "><b>Transaction ID:</b> {{ $quotation->transaction_id }}</div>
    <div class=""><b>User ID:</b> {{ Optional($user)->public_code }}  @if($user) / {{ $user->profile->fullname }} / {{ $user->profile->position_held }}  @endif   </div>
    <div class=" "><b>Date:</b> {{ $quotation->created_at }} </div>
        
    </div>
                