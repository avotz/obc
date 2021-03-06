
     <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
         <div class="col-xs-6">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="amount" name="amount" value="{{ isset($credit) ? $credit->amount : (isset($creditRequest) ? $creditRequest->amount : old('amount') ) }}" {{ (isset($credit) && !$credit->isPending()) ? 'readonly' : '' }}>
                <label for="amount" title="Monto">Amount <span class="label label-danger">( {{ isset($creditRequest) ? $creditRequest->amount : '' }} )</span></label>
                @if ($errors->has('amount'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Monto') }}">{{ $errors->first('amount') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-material form-material-success">
                   @foreach($currencies as $currency)    
                        @if(isset($credit) && $credit->currency == $currency['currency']) 

                            {{ $currency['symbol'] }} ({{ $currency['currency'] }})
                            <input type="hidden" id="currency" name="currency" value="{{ $currency['currency'] }}">
                        @elseif(isset($creditRequest) && $creditRequest->currency == $currency['currency'])  
                             {{ $currency['symbol'] }} ({{ $currency['currency'] }})
                             <input type="hidden" id="currency" name="currency" value="{{ $currency['currency'] }}">
                        @endif 
                   @endforeach
                <!-- <select name="currency" id="currency"  class="form-control" readonly>

                    
                         
    
                        @foreach($currencies as $currency)    
                            <option value="{{ $currency['currency'] }}" @if(isset($credit) && $credit->currency == $currency['currency']) selected="selected" @endif title="{{ $currency['currency'] }}"> {{ $currency['symbol'] }} ({{ $currency['currency'] }})</option>
                        @endforeach
                   
                       
                  
                   
                </select> -->
                <label for="currency" title="Moneda">Currency</label>
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('credit_time') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <select name="credit_time" id="credit_time"  class="form-control">

                    <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                   
                   
                    @foreach($creditDays as $creditDay)    
                        <option value="{{ $creditDay->days }}" @if(isset($credit) && $credit->credit_time == $creditDay->days) selected="selected" @else @if(isset($creditRequest) && $creditRequest->credit_time == $creditDay->days) selected="selected" @endif @endif>{{ trans('utils.credit') }} {{ $creditDay->days }} {{ trans('utils.days') }}</option>
                    @endforeach
                   
                </select>
                <label for="credit_time" title="Tiempo de credito">Credit time <span class="label label-danger">(Credit {{ isset($creditRequest) ? $creditRequest->credit_time : '' }} days)</span></label>
                @if ($errors->has('credit_time'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Tiempo de credito') }}">{{ $errors->first('credit_time') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    
    
    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="js-datepicker form-control" type="text" id="date" name="date" value="{{ isset($credit) ? $credit->date : (isset($creditRequest) ? $creditRequest->date : old('date')) }}" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                <label for="date" title="Fecha de la solicitud">Request Date <span class="label label-danger">({{ isset($creditRequest) ? $creditRequest->date : '' }})</span></label>
                @if ($errors->has('date'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Fecha de la solicitud') }}">{{ $errors->first('date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('approval_date') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="js-datepicker form-control" type="text" id="approval_date" name="approval_date" value="{{ isset($credit) ? $credit->approval_date : old('approval_date') }}" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                <label for="approval_date" title="Fecha de aprobación">Approval Date </label>
                @if ($errors->has('approval_date'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Fecha de la solicitud') }}">{{ $errors->first('approval_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('payment_date') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="js-datepicker form-control" type="text" id="payment_date" name="payment_date" value="{{ isset($credit) ? $credit->payment_date : old('payment_date') }}" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                <label for="payment_date" title="Fecha de pago">Payment Date </label>
                @if ($errors->has('payment_date'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Fecha de pago') }}">{{ $errors->first('payment_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('interest') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="interest" name="interest" value="{{ isset($credit) ? $credit->interest  : $interest }}" {{ (isset($credit) && !$credit->isPending()) ? 'readonly' : '' }} readonly>
                <label for="interest" title="Interes">Interest</label>
                @if ($errors->has('interest'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Interes') }}">{{ $errors->first('interest') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
     <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="total" name="total" value="{{ isset($credit) ? $credit->total  : $total }}" {{ (isset($credit) && !$credit->isPending()) ? 'readonly' : '' }} readonly>
                <label for="total" title="Total">Total</label>
                @if ($errors->has('total'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Total') }}">{{ $errors->first('total') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            @if(!isset($credit) || (isset($credit) && $credit->isPending()))
            <div class="form-material form-material-success">
                <input class="form-control" type="file" id="file" name="file">
                <label for="file" title="Archivo">file</label>
                @if ($errors->has('file'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Archivo') }}">{{ $errors->first('file') }}</strong>
                    </span>
                @endif
            </div>
            @endif
            @if(isset($credit) && $credit->file)
              
                <delete-file :transaction-id="{{ $credit->id }}" url-file="{{ getCreditFile($credit) }}" filename="{{ $credit->file }}" :read="{{ $credit->isPending() ? 'false' : 'true' }}">Delete Current File</delete-file>
              
            @endif
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
               
                <textarea class="form-control" name="comments" id="comments" cols="30" rows="3" {{ (isset($credit) && !$credit->isPending()) ? 'readonly' : '' }}>{{ isset($credit) ? $credit->comments : (isset($creditRequest) ? $creditRequest->comments : old('comments'))  }}</textarea>
                <label for="comments" title="Comentario adicional">Additional comment <span class="label label-danger">( {{ str_limit(isset($creditRequest) ? $creditRequest->comments : '' , 20) }} )</span></label>
                @if ($errors->has('comments'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Comentario adicional') }}">{{ $errors->first('comments') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    
    
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
        @if(isset($credit) && $credit->isPending() || !isset($credit))
            <button class="btn btn-success" type="submit" title="Guardar">Save</button>
        @endif
            
           @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
                <a class="btn btn-default" href="{{ url()->previous() }}" title="Atras">Back</a>
            @else 
                <a class="btn btn-default" href="/credit/credit-requests" title="Atras">Back</a>
            @endif  
           
        </div>
    </div>

    
    
