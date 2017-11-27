                  <div class="form-group" >
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                {{ $company->public_code }}
                                <label for="company_name" title="Id de asociado">Partner Id</label>
                            </div>
                        </div>
                    </div>
                  <div class="form-group" >
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                {{ $company->company_name }}
                                <label for="company_name" title="Nombre de compañia">Company Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                {{ $company->identification_number }}
                                <label for="identification_number" title="Número de identificación de la compañia">Company identification number</label>
                            </div>
                        </div>
                    </div>
                         
                    <div class="form-group{{ $errors->has('activity') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <select name="activity" id="activity"  class="form-control">
                                    <option value=""></option>
                                    <option value="1" @if($company->activity == 1) selected="selected" @endif title="Consumidor">Consumer</option>
                                    <option value="2" @if($company->activity == 2) selected="selected" @endif title="Suplidor">Supplier</option>
                                </select>
                                <label for="activity" title="Actividad en la plataforma OBC">  Activity on the OBC platform</label>
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
                                            @include('layouts.partials.sector-select', ['element' => $company])
                                        @endforeach
                                </select>
                                  
                                <label for="sectors" title="Sectores y subsectores">  Sectors and subsectors</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('phones') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="form-material form-material-success">
                                <input class="form-control" type="text" id="phones" name="phones" value="{{$company->phones }}">
                                <label for="phones" title="Teléfonos"> Phones</label>
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
                                <input class="form-control" type="text" id="physical_address" name="physical_address" value="{{ $company->physical_address }}">
                                <label for="physical_address" title="Dirección física"> Physical address</label>
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
                                        <option value="{{ $country->id }}" @if($company->countries->first()->id == $country->id) selected="selected" @endif>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <label for="country" title="País"> Country</label>
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
                                <input class="form-control" type="text" id="towns" name="towns" value="{{ $company->towns }}">
                                <label for="towns" title="Ciudad"> Towns</label>
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
                                <input class="form-control" type="text" id="web_address" name="web_address" value="{{ $company->web_address }}">
                                <label for="web_address" title="Dirección Web"> Web address</label>
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
                                <input class="form-control" type="text" id="legal_name" name="legal_name" value="{{ $company->legal_name }}">
                                <label for="legal_name" title="Nombre del representante legal"> Name of the legal representative</label>
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
                                <input class="form-control" type="text" id="legal_first_surname" name="legal_first_surname" value="{{ $company->legal_first_surname }}">
                                <label for="legal_first_surname" title="Primer apellido"> First surname</label>
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
                                <input class="form-control" type="text" id="legal_second_surname" name="legal_second_surname" value="{{ $company->legal_second_surname }}">
                                <label for="legal_second_surname" title="Segundo apellido"> Second surname</label>
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
                                <input class="form-control" type="email" id="legal_email" name="legal_email" value="{{ $company->legal_email }}">
                                <label for="legal_email" title="Correo">Email</label>
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
                            <button class="btn btn-block btn-success" type="submit" title="Actualizar">Update</button>
                        </div>
                    </div>