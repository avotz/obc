    
    <div class="form-group{{ $errors->has('delivery_time') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <!-- <input class="form-control" type="text" id="delivery_time" name="delivery_time" value="{{ isset($quotation) ? $quotation->delivery_time : $quotationRequest->delivery_time }}" placeholder="Immediate... 3 Days..."> -->
                <select name="delivery_time" id="delivery_time"  class="form-control">

                    <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                    
                   
                        <option value="0" @if(isset($quotation) && $quotation->delivery_time == 0) selected="selected" @else @if(isset($quotationRequest) && $quotationRequest->delivery_time == 0) selected="selected" @endif @endif title="Inmediato">{{ trans('utils.immediate') }}</option>
                        @foreach($deliveryDays as $day)    
                            <option value="{{ $day }}" @if(isset($quotation) && $quotation->delivery_time == $day) selected="selected" @else @if(isset($quotationRequest) && $quotationRequest->delivery_time == $day) selected="selected" @endif @endif title="{{ $day }} dias"> {{ $day }} {{ trans('utils.days') }}</option>
                        @endforeach
                       
                   
                </select>
                <label for="delivery_time" title="Tiempo de entrega">Delivery time <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->delivery_time : '' }})</span> </label>
                @if ($errors->has('delivery_time'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Tiempo de entrega') }}">{{ $errors->first('delivery_time') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('way_of_delivery') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <!-- <input class="form-control" type="text" id="way_of_delivery" name="way_of_delivery" value="{{ isset($quotation) ? $quotation->way_of_delivery : $quotationRequest->way_of_delivery  }}"> -->
                <select name="way_of_delivery" id="way_of_delivery"  class="form-control">

                        <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                    
                   
                        <option value="1" @if(isset($quotation) && $quotation->way_of_delivery == 1) selected="selected" @else @if(isset($quotationRequest) && $quotationRequest->way_of_delivery == 1) selected="selected" @endif  @endif title="Recoger">{{ trans('utils.way_of_delivery.1') }}</option>
                        <option value="2" @if(isset($quotation) && $quotation->way_of_delivery == 2) selected="selected" @else @if(isset($quotationRequest) && $quotationRequest->way_of_delivery == 2) selected="selected" @endif @endif title="En la casa">{{ trans('utils.way_of_delivery.2') }}</option>
                        <option value="3" @if(isset($quotation) && $quotation->way_of_delivery == 3) selected="selected"  @else @if(isset($quotationRequest) && $quotationRequest->way_of_delivery == 3) selected="selected" @endif @endif title="Cargar envio">{{ trans('utils.way_of_delivery.3') }}</option>

                     
                        
                  
                   
                </select>
                <label for="way_of_delivery" title="Manera de entrega">Way of delivery <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->way_of_delivery : '' }})</span></label>
                @if ($errors->has('way_of_delivery'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Manera de entrega') }}">{{ $errors->first('way_of_delivery') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('way_to_pay') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <select name="way_to_pay" id="way_to_pay"  class="form-control">

                    <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                   
                    <option value="0" @if(isset($quotation) && $quotation->way_to_pay == 0) selected="selected" @else @if(isset($quotationRequest) && $quotationRequest->way_to_pay == 0) selected="selected" @endif @endif title="Contacto">{{ trans('utils.cash') }}</option>
                    @foreach($creditDays as $creditDay)    
                        <option value="{{ $creditDay->days }}" @if(isset($quotation) && $quotation->way_to_pay == $creditDay->days) selected="selected" @else @if(isset($quotationRequest) && $quotationRequest->way_to_pay == $creditDay->days) selected="selected" @endif @endif title="Crédito {{ $creditDay->days }} dias">{{ trans('utils.credit') }} {{ $creditDay->days }} {{ trans('utils.days') }}</option>
                    @endforeach
                   
                </select>
                <label for="way_to_pay" title="Manera de pago">Way to pay <span class="label label-danger">(Credit {{ isset($quotationRequest) ? $quotationRequest->way_to_pay : '' }} days)</span></label>
                @if ($errors->has('way_to_pay'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Manera de pago') }}">{{ $errors->first('way_to_pay') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>


    <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
               
                <textarea class="form-control" name="comments" id="comments" cols="30" rows="3">{{ isset($quotation) ? $quotation->comments : $quotationRequest->comments  }}</textarea>
                <label for="comments" title="Comentarios adicionales">Additional comment <span class="label label-danger">({{ str_limit(isset($quotationRequest) ? $quotationRequest->comments : '' , 20) }})</span></label>
                @if ($errors->has('comments'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Comentarios adicionales') }}">{{ $errors->first('comments') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
     <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
        <div class="col-xs-6">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="amount" name="amount" value="{{ isset($quotation) ? $quotation->amount : old('amount') }}">
                <label for="amount" title="Monto original de la oferta">Original amount of the offer </label>
                @if ($errors->has('amount'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Monto original de la oferta') }}">{{ $errors->first('amount') }}</strong>
                    </span>
                @endif
            </div>
        </div>
         <div class="col-xs-6">
          <div class="form-material form-material-success">
            <select name="currency" id="currency"  class="form-control">

                    
                         
    
                        @foreach($currencies as $currency)    
                            <option value="{{ $currency['currency'] }}" @if(isset($quotation) && $quotation->currency == $currency['currency']) selected="selected" @endif title="{{ $currency['currency'] }}"> {{ $currency['symbol'] }} ({{ $currency['currency'] }})</option>
                        @endforeach
                   
                       
                  
                   
                </select>
                <label for="currency" title="Moneda">Currency</label>
             </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-6">
            <div class="form-material form-material-success">
                <span id="discount">{{ isset($quotation) ? calculatePercentAmount($quotation->discount, $quotation->amount) : '0' }}</span>
                <label for="discount" title="Descuento OBC( {{ isset($quotation) ? $quotation->discount : $discount }}% )">Discount OBC( {{ isset($quotation) ? $quotation->discount : $discount }}% ) </label>
                
            </div>
        </div>
         <div class="col-xs-6">
          <div class="form-material form-material-success">
               <input class="form-control" type="text" id="total" name="total" value="{{ isset($quotation) ? $quotation->total : old('total') }}" readonly>
                <label for="total" title="Total">Total </label>
                @if ($errors->has('total'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Total') }}">{{ $errors->first('total') }}</strong>
                    </span>
                @endif
          </div>
        </div>
    </div>
   
    <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                @if(!isset($quotation) || (isset($quotation) && !$quotation->purchase)) 
                    <input class="form-control" type="file" id="file" name="file">
                    <label for="file" title="Archivo">File</label>
                    @if ($errors->has('file'))
                        <span class="help-block">
                            <strong title="{{ validationRequiredES('Archivo') }}">{{ $errors->first('file') }}</strong>
                        </span>
                    @endif
                @endif 
            </div>
                @if(isset($quotation) && $quotation->product_photo)
               
                <delete-file :transaction-id="{{ $quotation->id }}" url-file="{{ getQuotationFile($quotation) }}" url="/quotations/file" filename="{{ $quotation->file }}" :read="{{ $quotation->purchase ? 'true': 'false' }}">Delete Current File</delete-file>
                 @endif
            
        </div>
    </div>
    <div class="form-group{{ $errors->has('product_photo') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                @if(!isset($quotation) || (isset($quotation) && !$quotation->purchase)) 
                    <input class="form-control" type="file" id="product_photo" name="product_photo">
                    <label for="product_photo" title="Foto del producto">Product Photo</label>
                    @if ($errors->has('product_photo'))
                        <span class="help-block">
                            <strong title="{{ validationRequiredES('Foto del producto') }}">{{ $errors->first('product_photo') }}</strong>
                        </span>
                    @endif
                @endif 
            </div>
                @if(isset($quotation) && $quotation->product_photo)
               
                <delete-photo-product :transaction-id="{{ $quotation->id }}" url-img="{{ getQuotationProductPhoto($quotation) }}" url="/quotations/photo" :read="{{ $quotation->purchase ? 'true': 'false' }}">Delete Current Photo</delete-photo-product>
                 @endif
            
        </div>
    </div>
    
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
        @if(!isset($quotation) || (isset($quotation) && !$quotation->purchase))
                <button class="btn btn-success" type="submit" title="Guardar">Save</button>
          @endif
           @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
                <a class="btn btn-default" href="{{ url()->previous() }}" title="Atras">Back</a>
            @else 
                <a class="btn btn-default" href="/public/requests" title="Atras">Back</a>
            @endif  
            
        </div>
    </div>
