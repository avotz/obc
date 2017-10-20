  
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $quotation->delivery_time }}
                <label for="delivery_time">Delivery time <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->delivery_time : '' }})</span></label>
            </div>
        </div>
    </div>    
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $quotation->way_of_delivery }}
                <label for="way_of_delivery">Way of delivery <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->way_of_delivery : '' }})</span></label>
            </div>
        </div>
    </div> 
    
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $quotation->way_to_pay }}
                <label for="way_to_pay">Way to pay <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->way_to_pay : '' }})</span></label>
            </div>
        </div>
    </div> 
   
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $quotation->comments }}
                <label for="comments">Additional comment <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->comments : '' }})</span></label>
            </div>
        </div>
    </div> 
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $quotation->product_name }}
                <label for="product_name">Product Name <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->product_name : '' }})</span></label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <delete-photo-product :transaction-id="{{ $quotation->id }}" url-img="{{ getQuotationProductPhoto($quotation) }}" :read="true">Delete Current Photo</delete-photo-product>
                <label for="product_name">Product Photo</label>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
            <a class="btn btn-default" href="/user/quotations">Back</a>
        </div>
    </div>
