    
    <div class="form-group{{ $errors->has('delivery_time') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="delivery_time" name="delivery_time" value="{{ isset($quotation) ? $quotation->delivery_time : $quotationRequest->delivery_time }}" placeholder="Immediate... 3 Days...">
                <label for="delivery_time">Delivery time <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->delivery_time : '' }})</span> </label>
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
                <input class="form-control" type="text" id="way_of_delivery" name="way_of_delivery" value="{{ isset($quotation) ? $quotation->way_of_delivery : $quotationRequest->way_of_delivery  }}">
                <label for="way_of_delivery">Way of delivery <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->way_of_delivery : '' }})</span></label>
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
                    @foreach($creditDays as $creditDay)    
                        <option value="{{ $creditDay->days }}" @if(isset($quotation) && $quotation->way_to_pay == $creditDay->days) selected="selected" @else @if(isset($quotationRequest) && $quotationRequest->way_to_pay == $creditDay->days) selected="selected" @endif @endif>Credit {{ $creditDay->days }} days</option>
                    @endforeach
                   
                </select>
                <label for="way_to_pay">Way to pay <span class="label label-danger">(Credit {{ isset($quotationRequest) ? $quotationRequest->way_to_pay : '' }} days)</span></label>
                @if ($errors->has('way_to_pay'))
                    <span class="help-block">
                        <strong>{{ $errors->first('way_to_pay') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>


    <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="comments" name="comments" value="{{ isset($quotation) ? $quotation->comments : $quotationRequest->comments  }}">
                <label for="comments">Additional comment <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->comments : '' }})</span></label>
                @if ($errors->has('comments'))
                    <span class="help-block">
                        <strong>{{ $errors->first('comments') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="product_name" name="product_name" value="{{ isset($quotation) ? $quotation->product_name : $quotationRequest->product_name }}">
                <label for="product_name">Product Name <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->product_name : '' }})</span></label>
                @if ($errors->has('product_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('product_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('product_photo') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                @if(!isset($quotation) || (isset($quotation) && !$quotation->purchase)) 
                    <input class="form-control" type="file" id="product_photo" name="product_photo">
                    <label for="product_photo">Product Photo</label>
                    @if ($errors->has('product_photo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('product_photo') }}</strong>
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
                <button class="btn btn-success" type="submit">Save</button>
          @endif
            <a class="btn btn-default" href="/public/requests">Back</a>
        </div>
    </div>
