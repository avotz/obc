
                <div class="block-content block-content-full text-center">
                    <div>
                       
                        <img src="{{ getLogo($partner) }}" alt="Logo" id="company-logo" class="img-company-logo  " />
                        
                    </div>
                    <div class="h5 push-15-t push-5" title="Solicitud de cotización #{{ $request->id }}">Quotation Request #{{ $request->id }} </div> <small class="label label-{{ trans('utils.public.colors.'.$request->public) }}">{{ trans('utils.public.'.$request->public) }}</small>
                    <div class="h5 push-15-t push-5"><b title="Producto">Product:</b> <span class="js-gallery"><a href="{{ getRequestProductPhoto($request) }}" class="img-link" title="Foto">Photo</a></span> </div>
                </div>
                <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                    <div class=" " ><b title="Nombre de asociado">Partner name:</b> {{ $partner->company_name }}</div>
                    <div class=" "><b title="País de asociado">Partner country:</b> {{ $partner->countries->first()->name }} <img src="{{ getFlag($partner->countries->first()->code) }}" alt="flag"></div>
                    <div class=""><b title="Sector suplidor">Supplier sector:</b>  
                      
                            {{ implode(",", $request->sectors->first()->ancestors->pluck('name')->toArray()) }} 
                           
                     </div>
                    <div class=" "><b title="Subsector suplidor">Supplier sub-sector:</b> 
                      
                        {{ implode(",", $request->sectors->pluck('name')->toArray()) }}
                       
                    </div>
                    <div class=" "><b title="Tiempo de entrega">Delivery time:</b> {{ $request->delivery_time }} {{ trans('utils.days') }}</div>
                    <div class=" "><b title="Manera de entrega">Way of delivery:</b> {{ trans('utils.way_of_delivery.'.$request->way_of_delivery) }}</div>
                    <div class=" "><b title="Manera de pagar">Way to pay:</b> @if( $request->way_to_pay ) {{ trans('utils.credit') }} {{ $request->way_to_pay }} {{ trans('utils.days') }} @else Cash @endif</div>
                    <div class=" "><b title="Solicitud válida hasta">Request valid until:</b> {{ $request->exp_date }} </div>
                    <div class=" "><b title="Comentarios adicionales">Additional comment:</b> {{ $request->comments }}</div>
                </div>
                <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                    <div class=" "><b title="Id de asociado">Partner ID:</b> {{ $partner->public_code }} </div>
                    <div class=" "><b title="Id de trasacción">Transaction ID:</b> {{ $request->transaction_id }}</div>
                    <div class=""><b title="Id de usuario">User ID:</b> {{ $user->public_code }} / {{ $user->profile->fullname }} / {{ $user->profile->position_held }} </div>
                    <div class=" "><b title="Fecha">Date:</b> {{ $request->created_at }} </div>
                     <div class=" "><b title="Teléfono y correo">Phone & Email:</b> {{ $partner->phones }} -  {{ $user->email }}</div>
                    
                </div>
               
          