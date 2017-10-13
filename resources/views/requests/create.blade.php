@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="/js/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css">
@endsection
@section('content')
<div id="infoBox" class="alert alert-success" ></div>
 <!-- Page Header -->
 <div class="content bg-image" style="background-image: url('/img/photo-profile.jpg');">
    <div class="push-50-t push-15 clearfix">
        
        <h1 class="h2 text-white push-5-t animated zoomIn">Quotation Request</h1>
        
           
    
       
       
        
        
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <div class="col-sm-7 col-lg-8">

        <div class="block">
                
                <div class="block-content">
                    <form class="js-validation-register form-horizontal push-50" method="POST" action="/requests" enctype="multipart/form-data">
                                        
                        {{ csrf_field() }}
                        @include('requests/partials/form') 
                    
                    </form>

                </div>
        </div>



               

        </div>
        <div class="col-sm-5 col-lg-4">
            

           
        </div>
    </div>
</div>
<!-- END Page Content -->


@endsection
@section('scripts')
<script src="/js/plugins/select2/select2.full.min.js"></script>
<script src="/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="/js/plugins/ajaxupload.js"></script>
<script src="{{ mix('/js/requests.js') }}"></script>

@endsection

