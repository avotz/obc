    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $creditRequest->amount }}
                <label for="amount">Amount</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ trans('utils.credit') }} {{ $creditRequest->credit_time }} {{ trans('utils.days') }}
                <label for="amount">Credit time</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ trans('utils.credit') }} {{ $creditRequest->credit_time }} {{ trans('utils.days') }}
                <label for="credit_time">Credit time</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $creditRequest->date }}
                <label for="amount">Request Date</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $creditRequest->date }}
                <label for="amount">Request Date</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            @if(isset($creditRequest) && $creditRequest->file)
              
                <delete-file :transaction-id="{{ $creditRequest->id }}" url-file="{{ getCreditRequestFile($creditRequest) }}" filename="{{ $creditRequest->file }}" :read="{{ $creditRequest->isPending() ? 'false' : 'true' }}" url="/credit-requests/file">Delete Current File</delete-file>
              
            @endif
        </div>
    </div>    
   
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $creditRequest->comments }}
                <label for="comments">Additional comment</label>
            </div>
        </div>
    </div> 


    
    <div class="form-group">
        <div class="col-xs-12 col-sm-8 col-md-8">
            <a href="/credit/credit-requests/{{ $creditRequest->id }}/credits/create" class="btn btn-success" data-toggle="tooltip" title="Make Offer">Make a Credit Answer</a>
            <a class="btn btn-default" href="/credit/credit-requests">Back</a>
        </div>
    </div>

    
    
