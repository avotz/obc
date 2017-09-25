
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
                <input class="form-control" type="text" id="code" name="code" value="{{ isset($country) ? $country->code : old('code') }}">
                <label for="code"> Code</label>
                @if ($errors->has('code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <!-- <div class="form-group{{ $errors->has('currency') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="currency" name="currency" value="{{ isset($country) ? $country->currency : old('currency') }}">
                <label for="currency"> Currency</label>
                @if ($errors->has('currency'))
                    <span class="help-block">
                        <strong>{{ $errors->first('currency') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div> -->
    

   
    
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
            <button class="btn btn-block btn-success" type="submit">Save</button>
        </div>
    </div>
                   