  
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
               
                 @if($quotation->delivery_time == 0)
                   {{ trans('utils.immediate') }}
                @else
                   {{ $quotation->delivery_time }} {{ trans('utils.days') }}
                @endif
                <label for="delivery_time" title="Tiempo de entrega">Delivery time <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->delivery_time : '' }})</span></label>
            </div>
        </div>
    </div>    
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ trans('utils.way_of_delivery.'.$quotation->way_of_delivery) }}
                <label for="way_of_delivery" title="Manera de entrega">Way of delivery <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->way_of_delivery : '' }})</span></label>
            </div>
        </div>
    </div> 
    
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                @if( $quotation->way_to_pay ) Credit {{ $quotation->way_to_pay }} Days @else Cash @endif
                <label for="way_to_pay" title="Manera de pago">Way to pay <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->way_to_pay : '' }})</span></label>
            </div>
        </div>
    </div> 
   
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $quotation->comments }}
                <label for="comments" title="Comentarios adicionales">Additional comment <span class="label label-danger">({{ isset($quotationRequest) ? $quotationRequest->comments : '' }})</span></label>
            </div>
        </div>
    </div> 
     <div class="form-group">
        <div class="col-xs-6">
            <div class="form-material form-material-success">
                {{ $quotation->amount }}
                <label for="amount" title="Monto original de la oferta">Original amount of the offer </label>
               
            </div>
        </div>
         <div class="col-xs-6">
          <div class="form-material form-material-success">
                {{ $quotation->currency }}
                <label for="currency" title="Moneda">Currency</label>
             </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-6">
            <div class="form-material form-material-success">
                <span id="discount">{{ isset($quotation) ? calculatePercentAmount($quotation->discount, $quotation->amount) : '0' }}</span>
                <label for="discount" title="Descuento">Discount OBC( {{ isset($quotation) ? $quotation->discount : $discount }}% ) </label>
                
            </div>
        </div>
         <div class="col-xs-6">
          <div class="form-material form-material-success">
               {{ $quotation->total }}
                <label for="total" title="Total">Total </label>
               
          </div>
        </div>
    </div>

    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
            <delete-file :transaction-id="{{ $quotation->id }}" url-file="{{ getQuotationFile($quotation) }}" filename="{{ $quotation->file }}" url="/quotations/file" :read="true">Delete Current file</delete-file>
                
                <label for="product_name" title="Archivo">File</label>
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
            <a class="btn btn-default" href="/user/quotations" title="Regresar">Back</a>
        </div>
    </div>
