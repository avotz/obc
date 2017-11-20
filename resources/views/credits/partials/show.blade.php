    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                  {{ $credit->amount }}
                
                <label for="amount">Amount</label>
            </div>
        </div>
    </div>
     <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ trans('utils.credit') }} {{ $credit->credit_time }} {{ trans('utils.days') }}
                <label for="credit_time">Credit time</label>
            </div>
        </div>
    </div>

     <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $credit->date }} 
                <label for="date">Request Date</label>
            </div>
        </div>
    </div>
     <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $credit->approval_date }} 
                <label for="approval_date">Approval Date</label>
            </div>
        </div>
    </div>
     <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $credit->payment_date }} 
                <label for="payment_date">Payment Date</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $credit->interest }} 
                <label for="interest">Interest</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $credit->total }} 
                <label for="total">Total</label>
            </div>
        </div>
    </div>
     <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                   @if(isset($credit) && $credit->file)
              
                <delete-file :transaction-id="{{ $credit->id }}" url-file="{{ getCreditFile($credit) }}" filename="{{ $credit->file }}" :read="true">Delete Current File</delete-file>
              
                @endif
                
                <label for="file">File</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $credit->comments }} 
                <label for="comments">Additional comment</label>
            </div>
        </div>
    </div>
   
    
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-8 col-md-12">
         @if(isset($credit) && $credit->isPending())
                           
                            <button class="btn btn-success" type="submit" form="form-status-approved" formaction="/credits/{{ $credit->id }}/status">Aproved</button>
                            <button class="btn btn-danger" type="submit" form="form-status-reject" formaction="/credits/{{ $credit->id }}/status">Reject</button>
            @endif
                                 
            <a class="btn btn-default" href="/quotations/{{ $quotation->id }}/credits">Back</a>
        </div>
    </div>

    
    
