    <div class="form-group{{ $errors->has('delivery_time') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
               
                <select name="delivery_time" id="delivery_time"  class="form-control">

                    <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                    
                         
                    <option value="1" @if(isset($shippingRequest) && $shippingRequest->delivery_time == 1) selected="selected" @endif> {{ trans('utils.normal') }}</option>
                    <option value="2" @if(isset($shippingRequest) && $shippingRequest->delivery_time == 2) selected="selected" @endif> {{ trans('utils.express') }}</option>
                   
                       
                  
                   
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
    
    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="js-datepicker form-control" type="text" id="date" name="date" value="{{ isset($shippingRequest) ? $shippingRequest->date : old('date') }}" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                <label for="date">Request Date</label>
                @if ($errors->has('date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('purchase_file') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            @if(!isset($shippingRequest) || (isset($shippingRequest) && $shippingRequest->isPending()))
            <div class="form-material form-material-success">
                <input class="form-control" type="file" id="file" name="file">
                <label for="purchase_file">file</label>
                @if ($errors->has('file'))
                    <span class="help-block">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                @endif
            </div>
            @endif
            @if(isset($shippingRequest) && $shippingRequest->file)
              
                <delete-file :transaction-id="{{ $shippingRequest->id }}" url-file="{{ getShippingRequestFile($shippingRequest) }}" filename="{{ $shippingRequest->file }}" :read="{{ !$shippingRequest->shippings->count() ? 'false' : 'true' }}" url="/shippings-requests/file">Delete Current File</delete-file>
              
            @endif
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
               
                <textarea class="form-control" name="comments" id="comments" cols="30" rows="3" {{ (isset($shippingRequest) && !$shippingRequest->isPending()) ? 'readonly' : '' }}>{{ isset($shippingRequest) ? $shippingRequest->comments : ''  }}</textarea>
                <label for="comments">Additional comment</label>
                @if ($errors->has('comments'))
                    <span class="help-block">
                        <strong>{{ $errors->first('comments') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

     <div class="form-group{{ $errors->has('public') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <select name="public" id="public"  class="form-control">
                
                    <option value="1" @if(isset($shippingRequest) && $shippingRequest->public == 1) selected="selected" @endif>All</option>
                   
                    <option value="0" @if(isset($shippingRequest) && $shippingRequest->public == 0) selected="selected" @endif>Specific</option>
                   
                </select>
                <label for="public">  Shipping Company</label>
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
                    
                <label for="suppliers"> Shipping Companies</label>
            </div>
        </div>
    </div>
    
    
    
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
        @if(isset($shippingRequest) && !$shippingRequest->shippings->count() || !isset($shippingRequest))
            <button class="btn btn-success" type="submit">Save</button>
        @endif
            <a class="btn btn-default" href="/quotations/{{ $quotation->id }}/shippings">Back</a>
        </div>
    </div>

    
    
