@extends('layouts.login')
@section('css')
    <link rel="stylesheet" href="/js/plugins/select2/select2.min.css">
@endsection
@section('content')

<!-- Register Content -->
<div class="content overflow-hidden">
            <div class="row">
            <h1 class="text-center">Partner account</h1>
            
            <form class="js-validation-register form-horizontal push-50-t push-50" method="POST" action="{{ route('registerPartner') }}">
                                {{ csrf_field() }}
            <div class="col-md-4">
                <!-- <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4"> -->
                    <!-- Register Block -->
                    <div class="block block-themed animated fadeIn">
                        <div class="block-header bg-primary">
                            
                            <h3 class="block-title" title="Datos de la compañia">Company data</h3>
                        </div>
                        <div class="block-content block-content-full block-content-narrow">
                            <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" >
                                        <label for="company_name" title="Nombre de la compañia">Company Name *</label>
                                        @if ($errors->has('company_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('identification_number') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="identification_number" name="identification_number" value="{{ old('identification_number') }}">
                                        <label for="identification_number" title="Número de identificación de la compañía"> Company identification number *</label>
                                        @if ($errors->has('identification_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('identification_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('activity') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <select name="activity" id="activity"  class="form-control">
                                            <option value=""></option>
                                            <option value="1" @if(1 == old('activity')) selected="selected" @endif title="Consumidor">Consumer</option>
                                            <option value="2" @if(2 == old('activity')) selected="selected" @endif title="Suplidor">Supplier</option>
                                        </select>
                                        <label for="activity" title="Actividad en la plataforma OBC">  Activity on the OBC platform *</label>
                                        @if ($errors->has('activity'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('activity') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('sectors') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                            
                                            <select name="sectors[]" id="sectors"  class="select-sectors form-control" style="width:100%;" multiple data-placeholder="Type to search for a sector" title="Escriba para buscar un sector"> 
                                                @foreach ($sectors as $sector)
                                                        @include('layouts.partials.sector-select')
                                                    @endforeach
                                            </select>
                                       
                                         <!-- <sector-subsectors :sectors="{{ $sectors }}"></sector-subsectors> -->
                                         <label for="sectors" title="Sectores y subsectores">  Sectors and subsectors *</label>
                                         @if ($errors->has('sectors'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('sectors') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('phones') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="phones" name="phones" value="{{ old('phones') }}">
                                        <label for="phones" title="Teléfonos"> Phones *</label>
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
                                        <input class="form-control" type="text" id="physical_address" name="physical_address" value="{{ old('physical_address') }}">
                                        <label for="physical_address" title="Dirección"> Physical address *</label>
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
                                        <select class="form-control" name="country" id="country">
                                            <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                            @foreach($countries as $country)    
                                                <option value="{{ $country->id }}" @if($country->id == old('country')) selected="selected" @endif>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="country" title="País"> Country *</label>
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
                                        <input class="form-control" type="text" id="towns" name="towns" value="{{ old('towns') }}">
                                        <label for="towns" title="Ciudad"> Towns *</label>
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
                                        <input class="form-control" type="text" id="web_address" name="web_address" value="{{ old('web_address') }}">
                                        <label for="web_address" title="Direccíon Web"> Web address</label>
                                        @if ($errors->has('web_address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('web_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                   
                    
                </div>
                <div class="col-md-4">
                <div class="block block-themed animated fadeIn">
                        <div class="block-header bg-primary">
                               
                                <h3 class="block-title" title="REPRESENTANTE LEGAL DE LA COMPAÑÍA">Legal Representative of the Company</h3>
                            </div>
                            <div class="block-content block-content-full block-content-narrow">
                                <div class="form-group{{ $errors->has('legal_name') ? ' has-error' : '' }}">
                                        <div class="col-xs-12">
                                            <div class="form-material form-material-success">
                                                <input class="form-control" type="text" id="legal_name" name="legal_name" value="{{ old('legal_name') }}">
                                                <label for="legal_name" title="Nombre del representante legal"> Name of the legal representative *</label>
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
                                                <input class="form-control" type="text" id="legal_first_surname" name="legal_first_surname" value="{{ old('legal_first_surname') }}">
                                                <label for="legal_first_surname" title="Primer Apellido"> First surname *</label>
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
                                                <input class="form-control" type="text" id="legal_second_surname" name="legal_second_surname" value="{{ old('legal_second_surname') }}">
                                                <label for="legal_second_surname" title="Segundo Apellido"> Second surname *</label>
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
                                                <input class="form-control" type="email" id="legal_email" name="legal_email" value="{{ old('legal_email') }}">
                                                <label for="legal_email" title="Correo">Email *</label>
                                                @if ($errors->has('legal_email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('legal_email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                            </div>
                    </div>
                </div>
                <div class="col-md-4">
                        <div class="block block-themed animated fadeIn">
                            <div class="block-header bg-primary">
                                <ul class="block-options">
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#modal-terms" title="Ver política de uso">View Usage Policy</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('login') }}" data-toggle="tooltip" data-placement="left" title="Log In"><i class="si si-login"></i></a>
                                    </li>
                                </ul>
                                <h3 class="block-title" title="Cuenta de asociado">Partner Account</h3>
                            </div>
                            <div class="block-content block-content-full block-content-narrow">
                            <div class="form-group{{ $errors->has('applicant_name') ? ' has-error' : '' }}">
                                        <div class="col-xs-12">
                                                <div class="form-material form-material-success">
                                                    <input class="form-control" type="text" id="applicant_name" name="applicant_name" value="{{ old('applicant_name') }}">
                                                    <label for="applicant_name" title="Nombre del solicitante"> Applicant name *</label>
                                                    @if ($errors->has('applicant_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('applicant_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('first_surname') ? ' has-error' : '' }}">
                                            <div class="col-xs-12">
                                                <div class="form-material form-material-success">
                                                    <input class="form-control" type="text" id="first_surname" name="first_surname" value="{{ old('first_surname') }}">
                                                    <label for="first_surname" title="Primer Apellido"> First surname *</label>
                                                    @if ($errors->has('first_surname'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('first_surname') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('second_surname') ? ' has-error' : '' }}">
                                            <div class="col-xs-12">
                                                <div class="form-material form-material-success">
                                                    <input class="form-control" type="text" id="second_surname" name="second_surname" value="{{ old('second_surname') }}">
                                                    <label for="second_surname" title="Segundo Apellido"> Second surname *</label>
                                                    @if ($errors->has('second_surname'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('second_surname') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('position_held') ? ' has-error' : '' }}">
                                            <div class="col-xs-12">
                                                <div class="form-material form-material-success">
                                                    <input class="form-control" type="text" id="position_held" name="position_held" value="{{ old('position_held') }}">
                                                    <label for="position_held" title="Cargo que ocupa"> Position held *</label>
                                                    @if ($errors->has('position_held'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('position_held') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <div class="col-xs-12">
                                                <div class="form-material form-material-success">
                                                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}">
                                                    <label for="email" title="Correo">Email *</label>
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <div class="col-xs-12">
                                                <div class="form-material form-material-success">
                                                    <input class="form-control" type="password" id="password" name="password">
                                                    <label for="password" title="Contraseña">Password *</label>
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            <div class="col-xs-12">
                                                <div class="form-material form-material-success">
                                                    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" >
                                                    <label for="password_confirmation" title="Confirmación de Contraseña">Confirm Password *</label>
                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label class="css-input switch switch-sm switch-success">
                                                    <input type="checkbox" id="register-terms" name="register-terms" required><span></span> <a href="#" data-toggle="modal" data-target="#modal-terms" title="De acuerdo con la Política de uso">I agree with usage Policy *</a> 
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-6 col-md-5">
                                                <button class="btn btn-block btn-success" type="submit" title="Regístrate"><i class="fa fa-plus pull-right"></i> Sign Up</button>
                                            </div>
                                        </div>
                            </div>
                        </div>
                </div>
                
                </form>
                 <!-- END Register Form -->
            </div>
        </div>
        <!-- END Register Content -->
        <!-- Terms Modal -->
        <div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-popout">
                <div class="modal-content">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <ul class="block-options">
                                <li>
                                    <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title" title="Política de Uso">Usage Policy</h3>
                        </div>
                        <div class="block-content">
                        <p title="Todos los campos con asteriscos son obligatorios, recuerde que el correo electrónico será su nombre de usuario, por consiguiente, introduzca una dirección de correo valida con el fin de poder recuperar su clave de acceso por medio de este correo electrónico en caso de perdida u olvido.">
                        All fields with asterisks are mandatory, remember that the email will be your username, therefore, enter a valid email address in order to be able to retrieve your password by means of this email in case of lost or forgotten .</p>   
                        
                        <p title="Al registrar su empresa, usted autoriza a OBC a confirmar todos los datos suministrados en el formulario de creación de cuentas de asociados, una vez confirmado dichos datos, OBC autorizará su cuenta y usted podrá utilizar la plataforma en línea 24/7."> By registering your company, you authorize OBC to confirm all the data provided in the account creation form of partners, once confirmed that data, OBC will authorize the use of your account and you will be able to use the online platform 24/7.</p>   
                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal" title="Cerrar">Close</button>
                        <button class="btn btn-sm btn-primary" type="button" data-dismiss="modal" title="Estoy de acuerdo"><i class="fa fa-check"></i> I agree</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Terms Modal -->
@endsection
@section('scripts')
<script src="/js/plugins/select2/select2.full.min.js"></script>
<script>
    function matchEsLabel(params, data) {
       
       // If there are no search terms, return all of the data
        if ($.trim(params.term) === '') {
            return data;
        }

        // Skip if there is no 'children' property
        if (typeof data.children === 'undefined') {
            return null;
        }

        // `data.children` contains the actual options that we are matching against
        var filteredChildren = [];
        $.each(data.children, function (idx, child) {
            if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0 || child.title.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
            filteredChildren.push(child);
            }
        });

        // If we matched any of the timezone group's children, then set the matched children on the group
        // and return the group object
        if (filteredChildren.length) {
            var modifiedData = $.extend({}, data, true);
            modifiedData.children = filteredChildren;

            // You can return modified objects from here
            // This includes matching the `children` how you want in nested data sets
            return modifiedData;
        }

        // Return `null` if the term should not be displayed
        return null;
    }


    jQuery('.select-sectors').select2({
        matcher: matchEsLabel
    });
    
    jQuery('select[name=activity]').change(function(e){
        if(jQuery(this).val() == '1'){
            jQuery('#sectors').attr('disabled','disabled');
        }else{
            jQuery('#sectors').attr('disabled',false);
        }
    });
</script>
@endsection
