    
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                 @if(isset($shippingRequest) && $shippingRequest->type == 0) {{ trans('utils.national') }} @endif
                  @if(isset($shippingRequest) && $shippingRequest->type == 1) {{ trans('utils.international') }} @endif
                <label for="type" title="Tipo">Type</label>
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('delivery_time') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
               
                <select name="delivery_time" id="delivery_time"  class="form-control">

                    <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                    
                         
                    <option value="1" @if(isset($shipping) && $shipping->delivery_time == 1) selected="selected" @else @if(isset($shippingRequest) && $shippingRequest->delivery_time == 1) selected="selected" @endif @endif title="Normal"> {{ trans('utils.normal') }}</option>
                    <option value="2" @if(isset($shipping) && $shipping->delivery_time == 2) selected="selected" @else @if(isset($shippingRequest) && $shippingRequest->delivery_time == 2) selected="selected" @endif @endif title="Express"> {{ trans('utils.express') }}</option>
                   
                       
                  
                   
                </select>
                <label for="delivery_time" title="Tiempo de entrega">Delivery time <span class="label label-danger">({{ isset($shippingRequest) ? ($shippingRequest->delivery_time == 1) ? trans('utils.normal')  :  trans('utils.express')  : '' }})</span></label>
                @if ($errors->has('delivery_time'))
                    <span class="help-block">
                        <strong>{{ $errors->first('delivery_time') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
        <div class="col-xs-6">
            <div class="form-material">
                 <input class="form-control" type="text" id="cost" name="cost" value="{{ isset($shipping) ? $shipping->cost : ''  }}" {{ (isset($shipping) && !$shipping->isPending()) ? 'readonly' : '' }}>
                <label for="cost" title="Costo">Cost</label>
                @if ($errors->has('cost'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cost') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-material">
                <select name="currency" id="currency"  class="form-control">

                    
                         
    
                        @foreach($currencies as $currency)    
                            <option value="{{ $currency['currency'] }}" @if(isset($shipping) && $shipping->currency == $currency['currency']) selected="selected" @endif title="{{ $currency['currency'] }}"> {{ $currency['symbol'] }} ({{ $currency['currency'] }})</option>
                        @endforeach
                   
                       
                  
                   
                </select>
                <label for="delivery_time" title="Moneda">Currency</label>
            </div>
        </div>
    </div>
    
    
    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="js-datepicker form-control" type="text" id="date" name="date" value="{{ isset($shipping) ? $shipping->date : (isset($shippingRequest) ? $shippingRequest->date : old('date')) }}" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                <label for="date" title="Fecha de solicitud">Request Date <span class="label label-danger">({{ isset($shippingRequest) ? $shippingRequest->date : '' }})</span></label>
                @if ($errors->has('date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            @if(!isset($shipping) || (isset($shipping) && $shipping->isPending()))
            <div class="form-material form-material-success">
                <input class="form-control" type="file" id="file" name="file">
                <label for="file" title="Archivo">file</label>
                @if ($errors->has('file'))
                    <span class="help-block">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                @endif
            </div>
            @endif
            @if(isset($shipping) && $shipping->file)
              
                <delete-file :transaction-id="{{ $shipping->id }}" url-file="{{ getShippingFile($shipping) }}" filename="{{ $shipping->file }}" :read="{{ $shipping->isPending() ? 'false' : 'true' }}">Delete Current File</delete-file>
              
            @endif
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
               
                <textarea class="form-control" name="comments" id="comments" cols="30" rows="3" {{ (isset($shipping) && !$shipping->isPending()) ? 'readonly' : '' }}>{{ isset($shipping) ? $shipping->comments : (isset($shippingRequest) ? $shippingRequest->comments :  old('comments'))  }}</textarea>
                <label for="comments" title="Comentarios adicionales">Additional comment <span class="label label-danger">( {{ str_limit(isset($shippingRequest) ? $shippingRequest->comments : '' , 20) }} )</span></label>
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
        @if(isset($shipping) && $shipping->isPending() || !isset($shipping))
            <button class="btn btn-success" type="submit" title="Guardar">Save</button>
        @endif
       @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
            <a class="btn btn-default" href="{{ url()->previous() }}" title="Atras">Back</a>
        @else 
              <a class="btn btn-default" href="/shipping/shipping-requests" title="Atras">Back</a>
        @endif
           
        </div>
    </div>

    
    
