<div class="form-group{{ $errors->has('sectors') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                    
                    <select name="sectors[]" id="sectors"  class="js-select2 form-control" style="width:100%;" multiple data-placeholder="Type to search for a sector"> 
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
                    <label for="sectors">  Sectors and subsectors</label>
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
                            <option value="1" @if(isset($quotationRequest) && $quotationRequest->geo_type == 1) selected="selected" @endif>National</option>
                        @endif
                        @if(auth()->user()->hasPermission('do_trans_reg'))
                            <option value="2" @if(isset($quotationRequest) && $quotationRequest->geo_type == 2) selected="selected" @endif>Regional</option>
                        @endif
                        @if(auth()->user()->hasPermission('do_trans_int'))
                            <option value="3" @if(isset($quotationRequest) && $quotationRequest->geo_type == 3) selected="selected" @endif>International</option>
                        @endif
                        @if(auth()->user()->hasPermission('do_trans_glo'))
                            <option value="4" @if(isset($quotationRequest) && $quotationRequest->geo_type == 4) selected="selected" @endif>Global</option>
                        @endif
                    @else 
                        <option value="1" @if(isset($quotationRequest) && $quotationRequest->geo_type == 1) selected="selected" @endif>National</option>
                        <option value="2" @if(isset($quotationRequest) && $quotationRequest->geo_type == 2) selected="selected" @endif>Regional</option>
                        <option value="3" @if(isset($quotationRequest) && $quotationRequest->geo_type == 3) selected="selected" @endif>International</option>
                        <option value="4" @if(isset($quotationRequest) && $quotationRequest->geo_type == 4) selected="selected" @endif>Global</option>
                    @endif
                </select>
                <label for="geo_type">  Transaction Type</label>
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
                <!-- <input class="form-control" type="text" id="delivery_time" name="delivery_time" value="{{ isset($quotationRequest) ? $quotationRequest->delivery_time : old('delivery_time') }}" placeholder="Immediate... 3 Days..."> -->
                <select name="delivery_time" id="delivery_time"  class="form-control">

                    <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                     <option value="0" @if(isset($quotationRequest) && $quotationRequest->delivery_time == 0) selected="selected" @endif >{{ trans('utils.immediate') }}</option>
                         @foreach($deliveryDays as $day)    
                            <option value="{{ $day }}" @if(isset($quotationRequest) && $quotationRequest->delivery_time == $day) selected="selected" @endif> {{ $day }} {{ trans('utils.days') }}</option>
                        @endforeach
                        <!-- <option value="Immediate" @if(isset($quotationRequest) && $quotationRequest->delivery_time == "Immediate") selected="selected" @endif>Immediate</option>
                        <option value="1 day" @if(isset($quotationRequest) && $quotationRequest->delivery_time == "1 day") selected="selected" @endif>1 day</option>
                        <option value="2 days" @if(isset($quotationRequest) && $quotationRequest->delivery_time == "2 days") selected="selected" @endif>2 days</option>
                        <option value="3 days" @if(isset($quotationRequest) && $quotationRequest->delivery_time == "3 days") selected="selected" @endif>3 days</option> -->
                  
                   
                </select>
                <label for="delivery_time">Delivery time</label>
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
                <!-- <input class="form-control" type="text" id="way_of_delivery" name="way_of_delivery" value="{{ isset($quotationRequest) ? $quotationRequest->way_of_delivery : old('way_of_delivery') }}"> -->
                <select name="way_of_delivery" id="way_of_delivery"  class="form-control">

                        <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                    
                   
                        <option value="1" @if(isset($quotationRequest) && $quotationRequest->way_of_delivery == 1) selected="selected" @endif>{{ trans('utils.way_of_delivery.1') }}</option>
                        <option value="2" @if(isset($quotationRequest) && $quotationRequest->way_of_delivery == 2) selected="selected" @endif>{{ trans('utils.way_of_delivery.2') }}</option>
                        <option value="3" @if(isset($quotationRequest) && $quotationRequest->way_of_delivery == 3) selected="selected" @endif>{{ trans('utils.way_of_delivery.3') }}</option>
                        
                  
                   
                </select>
                <label for="way_of_delivery">Way of delivery</label>
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
                    <option value="0" @if(isset($quotationRequest) && $quotationRequest->way_to_pay == 0) selected="selected" @endif >{{ trans('utils.cash') }}</option>
                    @foreach($creditDays as $creditDay)    
                        <option value="{{ $creditDay->days }}" @if(isset($quotationRequest) && $quotationRequest->way_to_pay == $creditDay->days) selected="selected" @endif>{{ trans('utils.credit') }} {{ $creditDay->days }} {{ trans('utils.days') }}</option>
                    @endforeach
                   
                </select>
                <label for="way_to_pay">Way to pay</label>
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
                <label for="exp_date">Request valid until</label>
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
                <input class="form-control" type="text" id="comments" name="comments" value="{{ isset($quotationRequest) ? $quotationRequest->comments : old('comments') }}">
                <label for="comments">Additional comment</label>
                @if ($errors->has('comments'))
                    <span class="help-block">
                        <strong>{{ $errors->first('comments') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('product_photo') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            @if(!isset($quotationRequest) || (isset($quotationRequest) && !$quotationRequest->quotations->count()))
            <div class="form-material form-material-success">
                <input class="form-control" type="file" id="product_photo" name="product_photo">
                <label for="product_photo">Product Photo</label>
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
                
                    <option value="1" @if(isset($quotationRequest) && $quotationRequest->public == 1) selected="selected" @endif>Public</option>
                    @if(auth()->user()->hasRole('user'))
                        @if(auth()->user()->hasPermission('do_trans_priv'))
                            <option value="0" @if(isset($quotationRequest) && $quotationRequest->public == 0) selected="selected" @endif>Private</option>
                        @endif
                    @else 
                        <option value="0" @if(isset($quotationRequest) && $quotationRequest->public == 0) selected="selected" @endif>Private</option>
                    @endif
                </select>
                <label for="public">  Visibility</label>
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
                
                    <select name="suppliers[]" id="suppliers"  class="js-select2 form-control" style="width:100%;" multiple data-placeholder="Type to search for a supplier"> 
                    
                </select>
                    
                <label for="suppliers">  Suppliers</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
            @if(!isset($quotationRequest) || (isset($quotationRequest) && !$quotationRequest->quotations->count())) 
                <button class="btn btn-success" type="submit">Save</button>
          @endif
           
            <a class="btn btn-default" href="/public/requests">Back</a>
        </div>
    </div>
