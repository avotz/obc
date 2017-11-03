
                <div class="block-content block-content-full text-center">
                    <div>
                       
                        <img src="{{ getLogo($partner) }}" alt="Logo" id="company-logo" class="img-company-logo  " />
                        
                    </div>
                    <div class="h5 push-15-t push-5">Quotation Request #{{ $request->id }} </div> <small class="label label-{{ trans('utils.public.colors.'.$request->public) }}">{{ trans('utils.public.'.$request->public) }}</small>
                    <div class="h5 push-15-t push-5"><b>Product:</b> <span class="js-gallery"><a href="{{ getRequestProductPhoto($request) }}" class="img-link" >Photo</a></span> </div>
                </div>
                <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                    <div class=" "><b>Partner name:</b> {{ $partner->company_name }}</div>
                    <div class=" "><b>Partner country:</b> {{ $partner->countries->first()->name }} <img src="{{ getFlag($partner->countries->first()->code) }}" alt="flag"></div>
                    <div class=""><b>Supplier sector:</b>  
                      
                            {{ implode(",", $request->sectors->first()->ancestors->pluck('name')->toArray()) }} 
                           
                     </div>
                    <div class=" "><b>Supplier sub-sector:</b> 
                      
                        {{ implode(",", $request->sectors->pluck('name')->toArray()) }}
                       
                    </div>
                    <div class=" "><b>Delivery time:</b> {{ $request->delivery_time }}</div>
                    <div class=" "><b>Way of delivery:</b> {{ $request->way_of_delivery }}</div>
                    <div class=" "><b>Way to pay:</b> @if( $request->way_to_pay ) Credit {{ $request->way_to_pay }} Days @else Cash @endif</div>
                    <div class=" "><b>Request valid until:</b> {{ $request->exp_date }} </div>
                    <div class=" "><b>Additional comment:</b> {{ $request->comments }}</div>
                </div>
                <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                    <div class=" "><b>Partner ID:</b> {{ $partner->public_code }} </div>
                    <div class=" "><b>Transaction ID:</b> {{ $request->transaction_id }}</div>
                    <div class=""><b>User ID:</b> {{ $user->public_code }} / {{ $user->profile->fullname }} / {{ $user->profile->position_held }} </div>
                    <div class=" "><b>Date:</b> {{ $request->created_at }} </div>
                    
                    
                </div>
               
          