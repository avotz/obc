
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
<div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="name" name="name" value="{{ isset($country) ? $country->name : old('name') }}">
                <label for="name"> Name</label>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="code" name="code" value="{{ isset($country) ? $country->code : old('code') }}" placeholder="XX">
                <label for="code"> Code <a href="https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2" target="_blank">(ISO 3166-1 alpha-2)</a></label>
                @if ($errors->has('code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('currency') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="currency" name="currency" value="{{ isset($country) ? $country->currency : old('currency') }}" placeholder="XXX">
                <label for="currency"> Currency <a href="https://es.wikipedia.org/wiki/ISO_4217" target="_blank">(ISO 4217)</a></label>
                @if ($errors->has('currency'))
                    <span class="help-block">
                        <strong>{{ $errors->first('currency') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('currency_symbol') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="currency_symbol" name="currency_symbol" value="{{ isset($country) ? $country->currency_symbol : old('currency_symbol') }}">
                <label for="currency"> Currency Symbol</label>
                @if ($errors->has('currency_symbol'))
                    <span class="help-block">
                        <strong>{{ $errors->first('currency_symbol') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('currency_exchange') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="currency_exchange" name="currency_exchange" value="{{ isset($country) ? $country->currency_exchange : old('currency_exchange') }}">
                <label for="currency_exchange"> Currency Exchange</label>
                @if ($errors->has('currency_exchange'))
                    <span class="help-block">
                        <strong>{{ $errors->first('currency_exchange') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    

   
    
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
            <button class="btn btn-block btn-success" type="submit">Save</button>
        </div>
    </div>
                   