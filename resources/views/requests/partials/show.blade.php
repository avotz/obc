    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $partner->company_name }}
                <label for="company_name" title="Nombre de asociado">Partner Name</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                
                    @foreach($partner->countries as $item)
                    <div>
                        {{ $item->name }}
                    </div>
                    @endforeach
                
                <label for="country" title="País de asociado">Partner Country</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                @foreach ($partner->sectors as $sector)
                    @include('layouts.partials.sector-select', ['company' => $partner->company])
                @endforeach
                <label for="sector" title="Sector suplidor">Supplier sector</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ trans('utils.geo_type.'.$quotationRequest->geo_type) }}
                <label for="geo_type" title="Tipo de trasacción">Transaction Type</label>
            </div>
        </div>
    </div>    
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                @if($quotationRequest->delivery_time == 0)
                   {{ trans('utils.immediate') }}
                @else
                   {{ $quotationRequest->delivery_time }} {{ trans('utils.days') }}
                @endif
                <label for="delivery_time" title="Tiempo de entrega">Delivery time</label>
            </div>
        </div>
    </div>    
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ trans('utils.way_of_delivery.'.$quotationRequest->way_of_delivery) }}
               
                <label for="way_of_delivery" title="Manera de entrega">Way of delivery</label>
            </div>
        </div>
    </div> 
    
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                @if( $quotationRequest->way_to_pay ) Credit {{ $quotationRequest->way_to_pay }} Days @else Cash @endif
                <label for="way_to_pay" title="Manera de pago">Way to pay</label>
            </div>
        </div>
    </div> 
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $quotationRequest->exp_date }}
                <label for="exp_date" title="Solicitud valida hasta">Request valid until</label>
            </div>
        </div>
    </div> 
   
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $quotationRequest->comments }}
                <label for="comments" title="Comentarios adicionales">Additional comment</label>
            </div>
        </div>
    </div> 
   
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
            <delete-file :transaction-id="{{ $quotationRequest->id }}" url-file="{{ getRequestFile($quotationRequest) }}" filename="{{ $quotationRequest->file }}" :read="{{ $quotationRequest->quotations->count() ? 'true': 'false' }}" url="/requests/file" :read="true">Delete Current file</delete-file>
                
                <label for="product_name" title="Archivo">File</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <delete-photo-product :transaction-id="{{ $quotationRequest->id }}" url-img="{{ getRequestProductPhoto($quotationRequest) }}" :read="true">Delete Current Photo</delete-photo-product>
                <label for="product_name" title="Foto del producto">Product Photo</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ trans('utils.public.'.$quotationRequest->public) }}
                <label for="product_name" title="Visibilidad">Visibility</label>
            </div>
        </div>
    </div>
   
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
            
             @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
                <a class="btn btn-default" href="{{ url()->previous() }}" title="Atras">Back</a>
            @else 
                <a class="btn btn-default" href="/public/requests" title="Atras">Back</a>
            @endif  
        </div>
    </div>
