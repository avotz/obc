<div class="block-content block-content-full text-center">
        <div>
            
            <img src="{{ getLogo($partner) }}" alt="Logo" id="company-logo" class="img-company-logo  " />
            
        </div>
        <div class="h5 push-15-t push-5" title="Cotización #{{ $quotation->id }} Solicitud #{{ $quotation->request->id }}">Quotation #{{ $quotation->id }} Request #{{ $quotation->request->id }} </div> <small class="label label-{{ trans('utils.public.colors.'.$quotation->request->public) }}">{{ trans('utils.public.'.$quotation->request->public) }}</small>
        @if($quotation->product_photo)
            <div class="h5 push-15-t push-5"><b title="Producto">Product:</b> <span class="js-gallery label label-danger"><a href="{{ getQuotationProductPhoto($quotation) }}" class="img-link" title="Foto"> Photo</a></span> </div>
        @else 
            <div class="h5 push-15-t push-5"><b title="Producto">Product:</b> <span class="js-gallery"><a href="{{ getRequestProductPhoto($quotation->request) }}" class="img-link" title="Foto">Photo</a></span> </div>
        @endif
    </div>
    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
        <div class=" "><b title="Nombre de asociado">Partner name:</b> {{ $partner->company_name }}</div>
        <div class=" "><b title="País de asociado">Partner country:</b> {{ $partner->countries->first()->name }} <img src="{{ getFlag($partner->countries->first()->code) }}" alt="flag"></div>
        <div class=""><b title="Sector suplidor">Supplier sector:</b>  
        
              {{ implode(",", $quotation->request->sectors->first()->ancestors->pluck('name')->toArray()) }} 
             
       </div>
      <div class=" "><b title="Subsector suplidor">Supplier sub-sector:</b> 
        
          {{ implode(",", $quotation->request->sectors->pluck('name')->toArray()) }}
         
      </div>
        <div class=" "><b title="Tiempo de entrega">Delivery time:</b> <span class="{{ ($quotation->request->delivery_time != $quotation->delivery_time) ? 'label label-danger' : '' }}">{{ $quotation->delivery_time }} {{ trans('utils.days') }}</span></div>
        <div class=" "><b title="Manera de entrega">Way of delivery:</b> <span class="{{ ($quotation->request->way_of_delivery != $quotation->way_of_delivery) ? 'label label-danger' : '' }}">{{ trans('utils.way_of_delivery.'.$quotation->way_of_delivery) }}</span></div>
        <div class=" "><b title="Manera de pago">Way to pay:</b> <span class="{{ ($quotation->request->way_to_pay != $quotation->way_to_pay) ? 'label label-danger' : '' }}">@if( $quotation->way_to_pay ) {{ trans('utils.credit') }} {{ $quotation->way_to_pay }} {{ trans('utils.days') }} @else Cash @endif</span></div>
        <div class=" "><b title="Solicitud valida hasta">Request valid until:</b> {{ $quotation->request->exp_date }} </div>
        <div class=" "><b title="Comentarios adicionales">Additional comment:</b> <span class="{{ ($quotation->request->comments != $quotation->comments) ? 'label label-danger' : '' }}">{{ $quotation->comments }}</span></div>
    </div>
    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
    <div class=" "><b title="Id de asociado">Partner ID:</b> {{ $partner->public_code }} </div>
    <div class=" "><b title="Id de transacción">Transaction ID:</b> {{ $quotation->transaction_id }}</div>
    <div class=""><b title="Id de usuario">User ID:</b> {{ $user->public_code }} / {{ $user->profile->fullname }} / {{ $user->profile->position_held }} </div>
    <div class=" "><b title="Fecha">Date:</b> {{ $quotation->created_at }} </div>
    <div class=" "><b title="Teléfono y correo">Phone & Email:</b> {{ $partner->phones }} -  {{ $user->email }}</div>
        
        
    </div>
                