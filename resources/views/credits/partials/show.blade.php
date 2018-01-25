    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                  {{ $credit->amount }}
                
                <label for="amount" title="Monto">Amount</label>
            </div>
        </div>
    </div>
     <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ trans('utils.credit') }} {{ $credit->credit_time }} {{ trans('utils.days') }}
                <label for="credit_time" title="Tiempo de crédito">Credit time</label>
            </div>
        </div>
    </div>

     <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $credit->date }} 
                <label for="date" title="Fecha de solicitud">Request Date</label>
            </div>
        </div>
    </div>
     <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $credit->approval_date }} 
                <label for="approval_date" title="Fecha de aprovación">Approval Date</label>
            </div>
        </div>
    </div>
     <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $credit->payment_date }} 
                <label for="payment_date" title="Fecha de pago">Payment Date</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $credit->interest }} 
                <label for="interest" title="Interes">Interest</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $credit->total }} 
                <label for="total" title="Total">Total</label>
            </div>
        </div>
    </div>
     <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                   @if(isset($credit) && $credit->file)
              
                <delete-file :transaction-id="{{ $credit->id }}" url-file="{{ getCreditFile($credit) }}" filename="{{ $credit->file }}" :read="true">Delete Current File</delete-file>
              
                @endif
                
                <label for="file" title="Archivo">File</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
              
                {{ $credit->comments }} 
                <label for="comments" title="Comentario adicional">Additional comment</label>
            </div>
        </div>
    </div>
   
    
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-8 col-md-12">
         @if(isset($credit) && $credit->isPending())
                           @if(!$creditsApproved)
                            <button class="btn btn-success" type="submit" form="form-status-approved" formaction="/credits/{{ $credit->id }}/status" title="Aprovado">Aproved</button>
                            @endif
                            <button class="btn btn-danger" type="submit" form="form-status-reject" formaction="/credits/{{ $credit->id }}/status" title="Rechazado">Reject</button>
            @endif
             @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
                <a class="btn btn-default" href="{{ url()->previous() }}" title="Atras">Back</a>
            @else 
                <a class="btn btn-default" href="/quotations/{{ $quotation->id }}/credits" title="Atras">Back</a>
            @endif                     
            
        </div>
    </div>

    
    
