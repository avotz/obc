    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                 @if($shippingRequest->delivery_time == 1) {{ trans('utils.normal') }} @endif
                  @if($shippingRequest->delivery_time == 2) {{ trans('utils.express') }} @endif
                <label for="delivery_time">Delivery time</label>
            </div>
        </div>
    </div>
   

    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $shippingRequest->date }}
                <label for="delivery_date">Request date</label>
            </div>
        </div>
    </div>    
    <div class="form-group" >
        <div class="col-xs-12">
            @if(isset($shippingRequest) && $shippingRequest->file)
              
                <delete-file :transaction-id="{{ $shippingRequest->id }}" url-file="{{ getShippingRequestFile($shippingRequest) }}" filename="{{ $shippingRequest->file }}" :read="{{ $shippingRequest->isPending() ? 'false' : 'true' }}" url="/shipping-requests/file">Delete Current File</delete-file>
              
            @endif
        </div>
    </div>    
   
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $shippingRequest->comments }}
                <label for="comments">Additional comment</label>
            </div>
        </div>
    </div> 

    
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-8 col-md-8">
            <a href="/shipping/shipping-requests/{{ $shippingRequest->id }}/shippings/create" class="btn btn-success" data-toggle="tooltip" title="Make Offer">Make a shipping</a>
            <a class="btn btn-default" href="/shipping/shipping-requests">Back</a>
        </div>
    </div>

    
    
