@extends('layouts.login')

@section('content')
<!-- Login Content -->
<div class="content overflow-hidden">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                    <!-- Login Block -->
                    <div class="block block-themed animated fadeIn">
                        <div class="block-header bg-primary">
                            
                            <h3 class="block-title">Innactive Account</h3>
                        </div>
                        <div class="block-content block-content-full block-content-narrow">
                            <!-- Login Title -->
                            <h1 class="h2 font-w600 push-30-t push-5">OBC</h1>
                            <p>Welcome, your account is inactive</p>
                            <!-- END Login Title -->

                            <p> Your request to open a account is being evaluated by the commercial department of OBC, we will respond soon.</p> 

                            <a href="/" class="btn btn-success"><i class="si si-login pull-right"></i> Back to home</a>

                        </div>
                    </div>
                    <!-- END Login Block -->
                </div>
            </div>
        </div>
        <!-- END Login Content -->

@endsection
