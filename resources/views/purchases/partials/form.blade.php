    
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
               
                 @if($quotation->delivery_time == 0)
                   {{ trans('utils.immediate') }}
                @else
                   {{ $quotation->delivery_time }} {{ trans('utils.days') }}
                @endif
                <label for="delivery_time" title="Tiempo de entrega">Delivery time </label>
            </div>
        </div>
    </div>    
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ trans('utils.way_of_delivery.'.$quotation->way_of_delivery) }}
                <label for="way_of_delivery" title="Manera de entrega">Way of delivery</label>
            </div>
        </div>
    </div> 
    
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                @if( $quotation->way_to_pay ) Credit {{ $quotation->way_to_pay }} Days @else Cash @endif
                <label for="way_to_pay" title="Forma de pago">Way to pay</label>
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('shipping_company') ? ' has-error' : '' }}">
         <div class="col-xs-6">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="shipping_company" name="shipping_company" value="{{ isset($purchase) ? $purchase->shipping_company :  $shipping_company  }}" {{ (isset($purchase) && !$purchase->isPending()) ? 'readonly' : '' }} placeholder="N/A" readonly>
                <label for="shipping_company" title="Compañia de envio">Shipping Company </label>
                @if ($errors->has('shipping_company'))
                    <span class="help-block">
                        <strong>{{ $errors->first('shipping_company') }}</strong>
                    </span>
                @endif
            </div>
        </div> 
    </div>
     <div class="form-group{{ $errors->has('credit_company') ? ' has-error' : '' }}">
         <div class="col-xs-6">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="credit_company" name="credit_company" value="{{ isset($purchase) ? $purchase->credit_company : $credit_company }}" {{ (isset($purchase) && !$purchase->isPending()) ? 'readonly' : '' }} placeholder="N/A" readonly>
                <label for="credit_company" title="Entidad de crédito">Credit Company </label>
                @if ($errors->has('credit_company'))
                    <span class="help-block">
                        <strong>{{ $errors->first('credit_company') }}</strong>
                    </span>
                @endif
            </div>
        </div> 
    </div>
    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
        <div class="col-xs-6">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="amount" name="amount" value="{{ isset($purchase) ? $purchase->amount : isset($quotation) ? $quotation->amount : old('amount') }}" {{ (isset($purchase) && !$purchase->isPending() || isset($purchase) && !$purchase->createdBy(auth()->user())) ? 'readonly' : '' }}>
                <label for="amount" title="Monto">Amount </label>
                @if ($errors->has('amount'))
                    <span class="help-block">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span>
                @endif
            </div>
        </div>
         <div class="col-xs-6">
          <div class="form-material form-material-success">
            <select name="currency" id="currency"  class="form-control" {{ ( isset($purchase) && !$purchase->createdBy(auth()->user())) ? 'readonly': '' }}>

                    
                         
    
                        @foreach($currencies as $currency)    
                            <option value="{{ $currency['currency'] }}" @if(isset($purchase) && $purchase->currency == $currency['currency']) selected="selected" @elseif(isset($quotation) && $quotation->currency == $currency['currency']) selected="selected"  @endif title="{{ $currency['currency'] }}"> {{ $currency['symbol'] }} ({{ $currency['currency'] }})</option>
                        @endforeach
                   
                       
                  
                   
                </select>
                <label for="currency" title="Moneda">Currency</label>
             </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-6">
            <div class="form-material form-material-success">
                <span id="discount">{{ isset($purchase) ? calculatePercentAmount($purchase->discount, $purchase->amount) : isset($quotation) ? calculatePercentAmount($quotation->discount, $quotation->amount) : '0' }}</span>
                <label for="discount" title="Descuento OBC( {{ isset($purchase) ? $purchase->discount : $discount }}% )">Discount OBC( {{ isset($purchase) ? $purchase->discount : $discount }}% ) </label>
                
            </div>
        </div>
         <div class="col-xs-6">
          <div class="form-material form-material-success">
               <input class="form-control" type="text" id="total" name="total" value="{{ isset($purchase) ? $purchase->total : isset($quotation) ? $quotation->total : old('total') }}" readonly>
                <label for="total" title="Total">Total </label>
                @if ($errors->has('total'))
                    <span class="help-block">
                        <strong>{{ $errors->first('total') }}</strong>
                    </span>
                @endif
          </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('purchase_file') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            @if(!isset($purchase) || (isset($purchase) && $purchase->isPending()))
            <div class="form-material form-material-success">
                <input class="form-control" type="file" id="purchase_file" name="purchase_file">
                <label for="purchase_file" title="Archivo de orden de compra">Purchase Order file</label>
                @if ($errors->has('purchase_file'))
                    <span class="help-block">
                        <strong>{{ $errors->first('purchase_file') }}</strong>
                    </span>
                @endif
            </div>
            @endif
            @if(isset($purchase) && $purchase->file)
              
                <delete-file :transaction-id="{{ $purchase->id }}" url-file="{{ getFilePurchase($purchase) }}" filename="{{ $purchase->file }}" :read="{{ $purchase->isPending() ? 'false' : 'true' }}">Delete Current File</delete-file>
              
            @endif
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="comments" name="comments" value="{{ isset($purchase) ? $purchase->comments : ''  }}" {{ (isset($purchase) && !$purchase->isPending()) ? 'readonly' : '' }}>
                 <textarea class="form-control" name="comments" id="comments" cols="30" rows="3" {{ (isset($purchase) && !$purchase->isPending()) ? 'readonly' : '' }}>{{ isset($purchase) ? $purchase->comments : ''  }}</textarea>
                <label for="comments" title="Comentario adicional">Additional comment</label>
                @if ($errors->has('comments'))
                    <span class="help-block">
                        <strong>{{ $errors->first('comments') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    
    
    
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
        @if(isset($purchase) && $purchase->isPending() && $purchase->createdBy(auth()->user()) || !isset($purchase))
            <button class="btn btn-success" type="submit" title="Guardar">Save</button>
        @endif
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
                <a class="btn btn-default" href="{{ url()->previous() }}" title="Atras">Back</a>
            @else 
                <a class="btn btn-default" href="/requests/{{ $quotation->request->id }}/quotations" title="Atras">Back</a>
            @endif  
           
        </div>
    </div>

    
    
