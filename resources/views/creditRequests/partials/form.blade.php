    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
        <div class="col-xs-6">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="amount" name="amount" value="{{ isset($creditRequest) ? $creditRequest->amount : old('amount') }}" {{ (isset($credit) && !$credit->isPending()) ? 'readonly' : '' }}>
                <label for="comments">Amount </label>
                @if ($errors->has('amount'))
                    <span class="help-block">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span>
                @endif
            </div>
        </div>
         <div class="col-xs-6">
          <div class="form-material form-material-success">
            <select name="currency" id="currency"  class="form-control">

                    
                         
    
                        @foreach($currencies as $currency)    
                            <option value="{{ $currency['currency'] }}" @if(isset($creditRequest) && $creditRequest->currency == $currency['currency']) selected="selected" @endif title="{{ $currency['currency'] }}"> {{ $currency['symbol'] }} ({{ $currency['currency'] }})</option>
                        @endforeach
                   
                       
                  
                   
                </select>
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
                        <option value="{{ $creditDay->days }}" @if(isset($creditRequest) && $creditRequest->credit_time == $creditDay->days) selected="selected"  @endif>{{ trans('utils.credit') }} {{ $creditDay->days }} {{ trans('utils.days') }}</option>
                    @endforeach
                   
                </select>
                <label for="credit_time">Credit time</label>
                @if ($errors->has('credit_time'))
                    <span class="help-block">
                        <strong>{{ $errors->first('credit_time') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    
    
    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="js-datepicker form-control" type="text" id="date" name="date" value="{{ isset($creditRequest) ? $creditRequest->date : old('date') }}" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                <label for="date">Request Date </label>
                @if ($errors->has('date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('purchase_file') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            @if(!isset($creditRequest) || (isset($creditRequest) && $creditRequest->isPending()))
            <div class="form-material form-material-success">
                <input class="form-control" type="file" id="file" name="file">
                <label for="purchase_file">file</label>
                @if ($errors->has('file'))
                    <span class="help-block">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                @endif
            </div>
            @endif
            @if(isset($creditRequest) && $creditRequest->file)
              
                <delete-file :transaction-id="{{ $creditRequest->id }}" url-file="{{ getCreditRequestFile($creditRequest) }}" filename="{{ $creditRequest->file }}" :read="{{ $creditRequest->isPending() ? 'false' : 'true' }}">Delete Current File</delete-file>
              
            @endif
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
               
                <textarea class="form-control" name="comments" id="comments" cols="30" rows="3" {{ (isset($creditRequest) && !$creditRequest->isPending()) ? 'readonly' : '' }}>{{ isset($creditRequest) ? $creditRequest->comments : old('comments')  }}</textarea>
                <label for="comments">Additional comment </label>
                @if ($errors->has('comments'))
                    <span class="help-block">
                        <strong>{{ $errors->first('comments') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    
    
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
        @if(isset($creditRequest) && !$creditRequest->credits->count() || !isset($creditRequest))
            <button class="btn btn-success" type="submit">Save</button>
        @endif
           
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
                <a class="btn btn-default" href="{{ url()->previous() }}" title="Atras">Back</a>
            @else 
                <a class="btn btn-default" href="/quotations/{{ $quotation->id }}/credits" title="Atras">Back</a>
            @endif  
        </div>
    </div>

    
    
