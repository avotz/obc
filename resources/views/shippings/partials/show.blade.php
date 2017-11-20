        <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                 @if($shipping->delivery_time == 1) {{ trans('utils.normal') }} @endif
                  @if($shipping->delivery_time == 2) {{ trans('utils.express') }} @endif
                <label for="delivery_time">Delivery time</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                  {{ $shipping->cost }}
                
                <label for="delivery_time">Cost</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                  {{ $shipping->date }}
                
                <label for="delivery_time">Date</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                   @if(isset($shipping) && $shipping->file)
              
                <delete-file :transaction-id="{{ $shipping->id }}" url-file="{{ getShippingFile($shipping) }}" filename="{{ $shipping->file }}" :read="true">Delete Current File</delete-file>
              
                @endif
                
                <label for="delivery_time">File</label>
            </div>
        </div>
    </div>
     <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                 {{ $shipping->comments }}
                <label for="delivery_time">Additional comment</label>
            </div>
        </div>
    </div>
    
    
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-8 col-md-12">
           @if(isset($shipping) && $shipping->isPending())
                           
                            <button class="btn btn-success" type="submit" form="form-status-approved" formaction="/shippings/{{ $shipping->id }}/status">Aproved</button>
                            <button class="btn btn-danger" type="submit" form="form-status-reject" formaction="/shippings/{{ $shipping->id }}/status">Reject</button>
            @endif
                          
                      
            <a class="btn btn-default" href="/quotations/{{ $quotation->id }}/shippings">Back</a>
        </div>
    </div>

    
    
