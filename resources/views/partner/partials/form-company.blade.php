<div class="form-group" >
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                {{ $user->company->company_name }}
                                <label for="company_name">Company Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                {{ $user->company->identification_number }}
                                <label for="identification_number">Company identification number</label>
                            </div>
                        </div>
                    </div>
                         
                    <div class="form-group{{ $errors->has('activity') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <select name="activity" id="activity"  class="form-control">
                                    <option value=""></option>
                                    <option value="1" @if($user->activity == 1) selected="selected" @endif>Consumer</option>
                                    <option value="2" @if($user->activity == 2) selected="selected" @endif>Supplier</option>
                                </select>
                                <label for="activity">  Activity on the OBC platform</label>
                                @if ($errors->has('activity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('activity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                               
                                    <select name="sectors[]" id="sectors"  class="js-select2 form-control" style="width:100%;" multiple data-placeholder="Type to search for a sector"> 
                                    @foreach ($sectors as $sector)
                                            @include('layouts.partials.sector-select', ['element' => $user->company])
                                        @endforeach
                                </select>
                                  
                                <label for="sectors">  Sectors and subsectors</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('phones') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="phones" name="phones" value="{{$user->company->phones }}">
                                <label for="phones"> Phones</label>
                                @if ($errors->has('phones'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phones') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('physical_address') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="physical_address" name="physical_address" value="{{ $user->company->physical_address }}">
                                <label for="physical_address"> Physical address</label>
                                @if ($errors->has('physical_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('physical_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <select class="js-select2 form-control" name="country" id="country" >
                                    <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                    @foreach($countries as $country)    
                                        <option value="{{ $country->id }}" @if($user->company->countries->first()->id == $country->id) selected="selected" @endif>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <label for="country"> Country</label>
                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                
                    <div class="form-group{{ $errors->has('towns') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="towns" name="towns" value="{{ $user->company->towns }}">
                                <label for="towns"> Towns</label>
                                @if ($errors->has('towns'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('towns') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('web_address') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="web_address" name="web_address" value="{{ $user->company->web_address }}">
                                <label for="web_address"> Web address</label>
                                @if ($errors->has('web_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('web_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('legal_name') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="legal_name" name="legal_name" value="{{ $user->company->legal_name }}">
                                <label for="legal_name"> Name of the legal representative</label>
                                @if ($errors->has('legal_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('legal_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('legal_first_surname') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="legal_first_surname" name="legal_first_surname" value="{{ $user->company->legal_first_surname }}">
                                <label for="legal_first_surname"> First surname</label>
                                @if ($errors->has('legal_first_surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('legal_first_surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('legal_second_surname') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="legal_second_surname" name="legal_second_surname" value="{{ $user->company->legal_second_surname }}">
                                <label for="legal_second_surname"> Second surname</label>
                                @if ($errors->has('legal_second_surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('legal_second_surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('legal_email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="email" id="legal_email" name="legal_email" value="{{ $user->company->legal_email }}">
                                <label for="legal_email">Email</label>
                                @if ($errors->has('legal_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('legal_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-6 col-md-5">
                            <button class="btn btn-block btn-success" type="submit">Update</button>
                        </div>
                    </div>