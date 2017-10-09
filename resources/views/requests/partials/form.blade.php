    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                {{ $user->profile->applicant_name }}
                <label for="company_name">Partner Name</label>
            </div>
        </div>
    </div>
    <div class="form-group" >
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                
                    @foreach($user->company->countries as $item)
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
              
                @foreach ($user->company->sectors as $sector)
                    @include('layouts.partials.sector-select', ['company' => $user->company])
                @endforeach
                <label for="sector">Supplier sector</label>
            </div>
        </div>
    </div>
        
    <div class="form-group{{ $errors->has('geo_type') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <select name="geo_type" id="geo_type"  class="form-control">
               
                    <option value="1" @if(isset($quotationRequest) && $quotationRequest->geo_type == 1) selected="selected" @endif>National</option>
                    <option value="2" @if(isset($quotationRequest) && $quotationRequest->geo_type == 2) selected="selected" @endif>Regional</option>
                    <option value="3" @if(isset($quotationRequest) && $quotationRequest->geo_type == 3) selected="selected" @endif>International</option>
                    <option value="4" @if(isset($quotationRequest) && $quotationRequest->geo_type == 4) selected="selected" @endif>Global</option>
                </select>
                <label for="geo_type">  Transaction Type</label>
                @if ($errors->has('geo_type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('geo_type') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('delivery_time') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="delivery_time" name="delivery_time" value="{{ isset($quotationRequest) ? $quotationRequest->delivery_time : old('delivery_time') }}" placeholder="Immediate... 3 Days...">
                <label for="delivery_time">Delivery time</label>
                @if ($errors->has('delivery_time'))
                    <span class="help-block">
                        <strong>{{ $errors->first('delivery_time') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('way_of_delivery') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="way_of_delivery" name="way_of_delivery" value="{{ isset($quotationRequest) ? $quotationRequest->way_of_delivery : old('way_of_delivery') }}">
                <label for="way_of_delivery">Way of delivery</label>
                @if ($errors->has('way_of_delivery'))
                    <span class="help-block">
                        <strong>{{ $errors->first('way_of_delivery') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('way_to_pay') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <select name="way_to_pay" id="way_to_pay"  class="form-control">

                    <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                    @foreach($creditDays as $creditDay)    
                        <option value="{{ $creditDay->days }}" @if(isset($quotationRequest) && $quotationRequest->way_to_pay == $creditDay->days) selected="selected" @endif>Credit {{ $creditDay->days }} days</option>
                    @endforeach
                   
                </select>
                <label for="way_to_pay">Way to pay</label>
                @if ($errors->has('way_to_pay'))
                    <span class="help-block">
                        <strong>{{ $errors->first('way_to_pay') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('exp_date') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="js-datepicker form-control" type="text" id="exp_date" name="exp_date" value="{{ isset($quotationRequest) ? $quotationRequest->exp_date : old('exp_date') }}" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                <label for="exp_date">Request valid until</label>
                @if ($errors->has('exp_date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('exp_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="comments" name="comments" value="{{ isset($quotationRequest) ? $quotationRequest->comments : old('comments') }}">
                <label for="comments">Additional comment</label>
                @if ($errors->has('comments'))
                    <span class="help-block">
                        <strong>{{ $errors->first('comments') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="product_name" name="product_name" value="{{ isset($quotationRequest) ? $quotationRequest->product_name : old('product_name') }}">
                <label for="product_name">Product Name</label>
                @if ($errors->has('product_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('product_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('product_photo') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="file" id="product_photo" name="product_photo">
                <label for="product_photo">Product Photo</label>
                @if ($errors->has('product_photo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('product_photo') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('public') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <select name="public" id="public"  class="form-control">
                
                    <option value="1" @if(isset($quotationRequest) && $quotationRequest->public == 1) selected="selected" @endif>Public</option>
                    <option value="0" @if(isset($quotationRequest) && $quotationRequest->public == 0) selected="selected" @endif>Private</option>
                </select>
                <label for="public">  Visibility</label>
                @if ($errors->has('public'))
                    <span class="help-block">
                        <strong>{{ $errors->first('public') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group suppliersSelectContainer">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                
                    <select name="suppliers[]" id="suppliers"  class="js-select2 form-control" style="width:100%;" multiple data-placeholder="Type to search for a supplier"> 
                    
                </select>
                    
                <label for="suppliers">  Suppliers</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
            <button class="btn btn-block btn-success" type="submit">Save</button>
        </div>
    </div>
