@extends('layouts.login')

@section('content')
<!-- Login Content -->
<div class="content overflow-hidden">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                    <!-- Login Block -->
                    <div class="block block-themed animated fadeIn">
                        <div class="block-header bg-primary">
                            
                            <h3 class="block-title" title="Cuenta inactiva">Innactive Account</h3>
                        </div>
                        <div class="block-content block-content-full block-content-narrow">
                            <!-- Login Title -->
                            <h1 class="h2 font-w600 push-30-t push-5">OBC</h1>
                            <p title="Bienvenido, tu cuenta esta inactiva">Welcome, your account is inactive.</p>
                            <!-- END Login Title -->
                            
                            <p title="Su solicitud está en proceso de aprobación por parte del asociado que suministró el código de creación de cuenta de usuario, una vez que el asociado apruebe tu solicitud, tu cuenta estará dada de alta en el sistema de OBC, y podrá ser uso de la plataforma online 24/7."> Your application is in the process of approval by the partner who supplied the user account creation code. Once the partner approves your request, your account will be registered in the OBC system, and you can use the online platform 24/7</p> 

                            <a href="/" class="btn btn-success" title="Regresar a inicio "><i class="si si-login pull-right"></i> Back to home</a>

                        </div>
                    </div>
                    <!-- END Login Block -->
                </div>
            </div>
        </div>
        <!-- END Login Content -->

@endsection
