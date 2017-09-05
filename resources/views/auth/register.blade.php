@extends('layouts.login')

@section('content')
<div class="content overflow-hidden">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                    <!-- Login Block -->
                    <div class="block block-themed animated fadeIn">
                        <div class="block-header bg-primary">
                            <ul class="block-options">
                                <li>
                                    <a href="{{ route('password.request') }}">Change Password?</a>
                                </li>
                                <li>
                                    <a href="{{ route('login') }}" data-toggle="tooltip" data-placement="left" title="Login"><i class="si si-login"></i></a>
                                </li>
                            </ul>
                            <h3 class="block-title">Registration</h3>
                        </div>
                        <div class="block-content block-content-full block-content-narrow">
                            <!-- Login Title -->
                            <div class="logo">
                                <h1 class="h2 font-w600 push-5"><img src="/img/logo-obc.png" alt="OBC"></h1>
                            </div>
                            <p>Welcome to OBC Account Creation</p>
                            <!-- END Login Title -->

                            
                            <p> OBC allows the registration of companies and persons in its platform, companies acquire associate status and people the status of users, for security reasons OBC reserves the right to accept or deny the requests of the associates, therefore OBC will check the data provided in the partner application form.</p> 

                            <p>If the account you want to create is a user account, you must take into account that you will need the data of the partner (Company) to which you belong plus the private code of that company in order to create your user account, once sent the form, the associate must approve your request, and until then you can use the online platform and services of OBC 24/7.</p> 

                            <div class="text-center">
                            <h3>Choose the account you want to create</h3>
                            <a class="btn btn-primary" href="/partners/register">
                                Associate Accounts
                            </a>
                            <a class="btn btn-success" href="/users/register">
                                User Accounts
                            </a>
                            </div>
                            
                          
                           
                        </div>
                    </div>
                    <!-- END Login Block -->
                </div>
            </div>
        </div>
@endsection
