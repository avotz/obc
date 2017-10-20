    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $partner->profile->applicant_name }}
                <label for="company_name">Partner Name</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                
                    @foreach($partner->company->countries as $item)
                    <div>
                        {{ $item->name }}
                    </div>
                    @endforeach
                
                <label for="country">Partner Country</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                @foreach ($partner->company->sectors as $sector)
                    @include('layouts.partials.sector-select', ['company' => $partner->company])
                @endforeach
                <label for="sector">Supplier sector</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ trans('utils.geo_type.'.$quotationRequest->geo_type) }}
                <label for="geo_type">Transaction Type</label>
            </div>
        </div>
    </div>    
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $quotationRequest->delivery_time }}
                <label for="delivery_time">Delivery time</label>
            </div>
        </div>
    </div>    
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $quotationRequest->way_of_delivery }}
                <label for="way_of_delivery">Way of delivery</label>
            </div>
        </div>
    </div> 
    
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                @if( $quotationRequest->way_to_pay ) Credit {{ $quotationRequest->way_to_pay }} Days @else Cash @endif
                <label for="way_to_pay">Way to pay</label>
            </div>
        </div>
    </div> 
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $quotationRequest->exp_date }}
                <label for="exp_date">Request valid until</label>
            </div>
        </div>
    </div> 
   
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $quotationRequest->comments }}
                <label for="comments">Additional comment</label>
            </div>
        </div>
    </div> 
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $quotationRequest->product_name }}
                <label for="product_name">Product Name</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <delete-photo-product :transaction-id="{{ $quotationRequest->id }}" url-img="{{ getRequestProductPhoto($quotationRequest) }}" :read="true">Delete Current Photo</delete-photo-product>
                <label for="product_name">Product Photo</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ trans('utils.public.'.$quotationRequest->public) }}
                <label for="product_name">Visibility</label>
            </div>
        </div>
    </div>
   
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
            <a class="btn btn-default" href="/public/requests">Back</a>
        </div>
    </div>
