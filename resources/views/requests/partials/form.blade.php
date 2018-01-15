<div class="form-group{{ $errors->has('sectors') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                    
                    <select name="sectors[]" id="sectors"  class="js-select2 form-control" style="width:100%;" multiple data-placeholder="Type to search for a sector" title="Escribe para buscar un sector"> 
                        @if(isset($quotationRequest))
                            @foreach ($sectors as $sector)
                                    @include('layouts.partials.sector-select', ['element' => $quotationRequest])
                                @endforeach
                        @else 
                            @foreach ($sectors as $sector)
                                    @include('layouts.partials.sector-select')
                                @endforeach
                        @endif
                    </select>
                
                    <!-- <sector-subsectors :sectors="{{ $sectors }}"></sector-subsectors> -->
                    <label for="sectors" title="Sectores y subsectores">  Sectors and subsectors</label>
                    @if ($errors->has('sectors'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sectors') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
        
    <div class="form-group{{ $errors->has('geo_type') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <select name="geo_type" id="geo_type"  class="form-control">
                    @if(auth()->user()->hasRole('user'))
                        @if(auth()->user()->hasPermission('do_trans_nac'))
                            <option value="1" @if(isset($quotationRequest) && $quotationRequest->geo_type == 1) selected="selected" @endif title="Nacional">National</option>
                        @endif
                        @if(auth()->user()->hasPermission('do_trans_reg'))
                            <option value="2" @if(isset($quotationRequest) && $quotationRequest->geo_type == 2) selected="selected" @endif title="Regional">Regional</option>
                        @endif
                        @if(auth()->user()->hasPermission('do_trans_int'))
                            <option value="3" @if(isset($quotationRequest) && $quotationRequest->geo_type == 3) selected="selected" @endif title="Internacional">International</option>
                        @endif
                        @if(auth()->user()->hasPermission('do_trans_glo'))
                            <option value="4" @if(isset($quotationRequest) && $quotationRequest->geo_type == 4) selected="selected" @endif title="Global">Global</option>
                        @endif
                    @else 
                        <option value="1" @if(isset($quotationRequest) && $quotationRequest->geo_type == 1) selected="selected" @endif title="Nacional">National</option>
                        <option value="2" @if(isset($quotationRequest) && $quotationRequest->geo_type == 2) selected="selected" @endif title="Regional">Regional</option>
                        <option value="3" @if(isset($quotationRequest) && $quotationRequest->geo_type == 3) selected="selected" @endif title="Internacional">International</option>
                        <option value="4" @if(isset($quotationRequest) && $quotationRequest->geo_type == 4) selected="selected" @endif title="Global">Global</option>
                    @endif
                </select>
                <label for="geo_type" title="Tipo de transacción">  Transaction Type</label>
                @if ($errors->has('geo_type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('geo_type') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('delivery_time') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
               
                <select name="delivery_time" id="delivery_time"  class="form-control">

                    <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                     <option value="0" @if(isset($quotationRequest) && $quotationRequest->delivery_time == 0) selected="selected" @endif title="Immediato" >{{ trans('utils.immediate') }}</option>
                         @foreach($deliveryDays as $day)    
                            <option value="{{ $day }}" @if(isset($quotationRequest) && $quotationRequest->delivery_time == $day) selected="selected" @endif title="{{ $day }} dias"> {{ $day }} {{ trans('utils.days') }}</option>
                        @endforeach
                       
                  
                   
                </select>
                <label for="delivery_time" title="Tiempo de entrega">Delivery time</label>
                @if ($errors->has('delivery_time'))
                    <span class="help-block">
                        <strong>{{ $errors->first('delivery_time') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('way_of_delivery') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                
                <select name="way_of_delivery" id="way_of_delivery"  class="form-control">

                        <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                    
                   
                        <option value="1" @if(isset($quotationRequest) && $quotationRequest->way_of_delivery == 1) selected="selected" @endif title="Recoger">{{ trans('utils.way_of_delivery.1') }}</option>
                        <option value="2" @if(isset($quotationRequest) && $quotationRequest->way_of_delivery == 2) selected="selected" @endif title="En la casa">{{ trans('utils.way_of_delivery.2') }}</option>
                        <option value="3" @if(isset($quotationRequest) && $quotationRequest->way_of_delivery == 3) selected="selected" @endif title="Cargar envio">{{ trans('utils.way_of_delivery.3') }}</option>
                        
                  
                   
                </select>
                <label for="way_of_delivery" title="Manera de entrega">Way of delivery</label>
                @if ($errors->has('way_of_delivery'))
                    <span class="help-block">
                        <strong>{{ $errors->first('way_of_delivery') }}</strong>
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
                    <option value="0" @if(isset($quotationRequest) && $quotationRequest->way_to_pay == 0) selected="selected" @endif title="Contado">{{ trans('utils.cash') }}</option>
                    @foreach($creditDays as $creditDay)    
                        <option value="{{ $creditDay->days }}" @if(isset($quotationRequest) && $quotationRequest->way_to_pay == $creditDay->days) selected="selected" @endif title="Credito {{ $creditDay->days }} dias">{{ trans('utils.credit') }} {{ $creditDay->days }} {{ trans('utils.days') }}</option>
                    @endforeach
                   
                </select>
                <label for="way_to_pay" title="Manera de pago">Way to pay</label>
                @if ($errors->has('way_to_pay'))
                    <span class="help-block">
                        <strong>{{ $errors->first('way_to_pay') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('exp_date') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="js-datepicker form-control" type="text" id="exp_date" name="exp_date" value="{{ isset($quotationRequest) ? $quotationRequest->exp_date : old('exp_date') }}" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                <label for="exp_date" title="Solicitud valida hasta">Request valid until</label>
                @if ($errors->has('exp_date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('exp_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">

                <textarea class="form-control" name="comments" id="comments" cols="30" rows="3">{{ isset($quotationRequest) ? $quotationRequest->comments : old('comments')  }}</textarea>
                <label for="comments" title="Comentarios adicionales">Additional comment</label>
                @if ($errors->has('comments'))
                    <span class="help-block">
                        <strong>{{ $errors->first('comments') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                @if(!isset($quotationRequest) || (isset($quotationRequest) && !$quotationRequest->quotations->count()))
                <div class="form-material form-material-success">
                    <input class="form-control" type="file" id="file" name="file">
                    <label for="file" title="Archivo">File</label>
                    @if ($errors->has('file'))
                        <span class="help-block">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                    @endif
                </div>
                @endif
                @if(isset($quotationRequest) && $quotationRequest->file)
                
                    <delete-file :transaction-id="{{ $quotationRequest->id }}" url-file="{{ getRequestFile($quotationRequest) }}" filename="{{ $quotationRequest->file }}" :read="{{ $quotationRequest->quotations->count() ? 'true': 'false' }}" url="/requests/file">Delete Current file</delete-file>
                @endif
            </div>
        </div>
    <div class="form-group{{ $errors->has('product_photo') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            @if(!isset($quotationRequest) || (isset($quotationRequest) && !$quotationRequest->quotations->count()))
            <div class="form-material form-material-success">
                <input class="form-control" type="file" id="product_photo" name="product_photo">
                <label for="product_photo" title="Foto del producto">Product Photo</label>
                @if ($errors->has('product_photo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('product_photo') }}</strong>
                    </span>
                @endif
            </div>
            @endif
            @if(isset($quotationRequest) && $quotationRequest->product_photo)
               
                <delete-photo-product :transaction-id="{{ $quotationRequest->id }}" url-img="{{ getRequestProductPhoto($quotationRequest) }}" :read="{{ $quotationRequest->quotations->count() ? 'true': 'false' }}">Delete Current Photo</delete-photo-product>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('public') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <select name="public" id="public"  class="form-control">
                
                    <option value="1" @if(isset($quotationRequest) && $quotationRequest->public == 1) selected="selected" @endif title="Público">Public</option>
                    @if(auth()->user()->hasRole('user'))
                        @if(auth()->user()->hasPermission('do_trans_priv'))
                            <option value="0" @if(isset($quotationRequest) && $quotationRequest->public == 0) selected="selected" @endif title="Privado">Private</option>
                        @endif
                    @else 
                        <option value="0" @if(isset($quotationRequest) && $quotationRequest->public == 0) selected="selected" @endif title="Privado">Private</option>
                    @endif
                </select>
                <label for="public" title="Visibilidad">  Visibility</label>
                @if ($errors->has('public'))
                    <span class="help-block">
                        <strong>{{ $errors->first('public') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group suppliersSelectContainer">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                
                    <select name="suppliers[]" id="suppliers"  class="js-select2 form-control" style="width:100%;" multiple data-placeholder="Type to search for a supplier" title="Escriba para buscar un suplidor"> 
                    
                </select>
                    
                <label for="suppliers">  Suppliers</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
            @if(!isset($quotationRequest) || (isset($quotationRequest) && !$quotationRequest->quotations->count())) 
                <button class="btn btn-success" type="submit" title="Guardar">Save</button>
          @endif
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
                <a class="btn btn-default" href="{{ url()->previous() }}" title="Atras">Back</a>
            @else 
                <a class="btn btn-default" href="/public/requests" title="Atras">Back</a>
            @endif  
           
        </div>
    </div>
