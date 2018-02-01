<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus"> <!--<![endif]-->
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="/img/favicons/manifest.json">
    <link rel="mask-icon" href="/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Web fonts -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">

    <!-- Page JS Plugins CSS go here -->

    <!-- OneUI CSS framework -->
    @yield('css')
    <link rel="stylesheet" id="css-main" href="/css/oneui.min.css">
    <!-- Styles -->
    <link href="{{  mix('css/app.css') }}" rel="stylesheet">
   
</head>
<body>
    <div id="app">
    
    

    <div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">
            
            @include('layouts/partials/side-overlay')

            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
                @include('layouts/partials/sidebar-admin', ["role" => auth()->user()->roles->first()])
            @elseif(auth()->user()->hasRole('shipping'))
                @include('layouts/partials/sidebar-shipping')
            @elseif(auth()->user()->hasRole('credit'))
                @include('layouts/partials/sidebar-credit')
            @else
                @include('layouts/partials/sidebar', ["role" => auth()->user()->roles->first()])
            @endif
            
            @include('layouts/partials/header')
            
            
            <!-- Main Container -->
            <main id="main-container">
                @yield('content')
            </main>
            <!-- END Main Container -->

            
    </div>
        <!-- END Page Container -->

    @include('layouts/partials/footer')
       


    <alert :type="message.type" v-show="message.show" >@{{ message.text }}</alert>
    @if (session()->has('flash_message'))

      <alert type="{!! session()->get('flash_message_level') !!}" >{!! session()->get('flash_message') !!}</alert>

    @endif
    </div>

    <!-- Scripts -->
    <script src="{{  mix('js/app.js') }}"></script>

    <!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
    <!-- <script src="/js/plugins/bootstrap.min.js"></script> -->
    <script src="/js/oneui.min.js"></script>

    @yield('scripts')

    @if($country = auth()->user()->countries->first())
    <!-- Smartsupp Live Chat script -->
        @if($country->chat_id)
        <script type="text/javascript">
            var _smartsupp = _smartsupp || {};
            _smartsupp.key = '{{ $country->chat_id }}';
            window.smartsupp||(function(d) {
            var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
            s=d.getElementsByTagName('script')[0];c=d.createElement('script');
            c.type='text/javascript';c.charset='utf-8';c.async=true;
            c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
            })(document);
        </script>
        @endif
    @endif
</body>
</html>
