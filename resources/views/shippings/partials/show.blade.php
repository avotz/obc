        <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                 @if($shipping->delivery_time == 1) {{ trans('utils.normal') }} @endif
                  @if($shipping->delivery_time == 2) {{ trans('utils.express') }} @endif
                <label for="delivery_time" title="Tiempo de entrega">Delivery time</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                  {{ $shipping->cost }}
                
                <label for="cost" title="Costo">Cost</label> {{ $shipping->currency }}
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                  {{ $shipping->date }}
                
                <label for="date" title="Fecha">Date</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                   @if(isset($shipping) && $shipping->file)
              
                <delete-file :transaction-id="{{ $shipping->id }}" url-file="{{ getShippingFile($shipping) }}" filename="{{ $shipping->file }}" :read="true">Delete Current File</delete-file>
              
                @endif
                
                <label for="file" title="Archivo">File</label>
            </div>
        </div>
    </div>
     <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                 {{ $shipping->comments }}
                <label for="additional comment" title="Comentarios adicionales">Additional comment</label>
            </div>
        </div>
    </div>
    
    
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-8 col-md-12">
           @if(isset($shipping) && $shipping->isPending())
                            @if(!$shippingsApproved)
                            <button class="btn btn-success" type="submit" form="form-status-approved" formaction="/shippings/{{ $shipping->id }}/status" title="Aprobado">Aproved</button>
                            @endif
                            <button class="btn btn-danger" type="submit" form="form-status-reject" formaction="/shippings/{{ $shipping->id }}/status" title="Rechazado">Reject</button>
            @endif
                          
                      
            <a class="btn btn-default" href="/quotations/{{ $quotation->id }}/shippings" title="Atras">Back</a>
        </div>
    </div>

    
    
