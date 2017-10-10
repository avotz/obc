<div class="block-content block-content-full text-center">
        <div>
            
            <img src="{{ getLogo($partner->company) }}" alt="Logo" id="company-logo" class="img-company-logo  " />
            
        </div>
        <div class="h5 push-15-t push-5">Quotation #{{ $quotation->id }} Request #{{ $quotation->request->id }} </div> <small class="label label-{{ trans('utils.public.colors.'.$quotation->public) }}">{{ trans('utils.public.'.$quotation->public) }}</small>
    </div>
    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
        <div class=" "><b>Partner name:</b> {{ $partner->company->company_name }}</div>
        <div class=" "><b>Partner country:</b> {{ $partner->company->countries->first()->name }} <img src="{{ getFlag($partner->company->countries->first()->code) }}" alt="flag"></div>
        <div class=""><b>Supplier sector:</b>  @foreach($partner->company->sectors as $item)
                               
                                    {{ implode(",", $item->ancestors->pluck('name')->toArray()) }}
                                
                            @endforeach</div>
        <div class=" "><b>Supplier sub-sector:</b> 
            {{ implode(",", $partner->company->sectors->pluck('name')->toArray()) }}
        </div>
        <div class=" "><b>Delivery time:</b> {{ $quotation->delivery_time }}</div>
        <div class=" "><b>Way of delivery:</b> {{ $quotation->way_of_delivery }}</div>
        <div class=" "><b>Way to pay:</b> {{ $quotation->way_to_pay }}</div>
        <div class=" "><b>Additional comment:</b> {{ $quotation->comments }}</div>
    </div>
    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
    <div class=" "><b>Partner ID:</b> {{ $partner->public_code }} </div>
    <div class=" "><b>Transaction ID:</b> {{ $quotation->transaction_id }}</div>
    <div class=""><b>User ID:</b> {{ Optional($user)->public_code }}  @if($user) / {{ $user->profile->fullname }} / {{ $user->profile->position_held }}  @endif   </div>
    <div class=" "><b>Date:</b> {{ $quotation->created_at }} </div>
        
    </div>
                