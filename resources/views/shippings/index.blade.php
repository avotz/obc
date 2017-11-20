@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="/js/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="/js/plugins/magnific-popup/magnific-popup.min.css">
@endsection
@section('content')
<div id="infoBox" class="alert alert-success" ></div>
 <!-- Page Header -->
 <div class="content bg-image" style="background-image: url('/img/photo-profile.jpg');">
    <div class="push-50-t push-15 clearfix">
        
        <h1 class="h2 text-white push-5-t animated zoomIn">Shippings from {{ $shippingRequest->transaction_id }} </h1>
        
           
    
       
       
        
        
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <div class="col-sm-12 col-lg-12">

        <div class="block">
                
                <div class="block-content">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 100px;">ID</th>
                               
                                <th class="text-center"><i class="si si-user"></i></th>
                                <th style="width: 100px;">Delivery Time</th>
                                <th class="hidden-xs" >Request Date</th>
                                <th class="hidden-xs hidden-sm" style="width: 15%;">Status</th>
                                <th class="text-center" style="width: 80px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($shippings as $shipping)
                            <tr>
                                <td class="font-w600">{{ $shipping->transaction_id }}</td>
                                
                                <td class="text-center">
                                    {{ $shipping->quotation->user->companies->first()->public_code }}
                                       
                                </td>
                                <td class="font-w600">{{ ($shipping->delivery_time) ? 'Normal' : 'Express' }}</td>
                                <td class="hidden-xs">{{ Carbon\Carbon::parse($shipping->date)->format('Y-m-d') }}</td>
                                <td class="hidden-xs hidden-sm">
                                    @if($shipping->status == 0)
                                        <span class="label label-warning">Pending</span>
                                    @endif
                                    @if($shipping->status == 1)
                                        <span class="label label-success">Granted</span>
                                    @endif
                                    @if($shipping->status == 2)
                                        <span class="label label-danger">Reject</span>
                                    @endif
                                    
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="/shippings/{{ $shipping->id }}/edit" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit Shipping"><i class="fa fa-eye"></i></a>
                                      
                                        
                                        
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                           
                            
                        </tbody>
                    </table>
                     @if($shippings->count())
                    <div class="row">
                        <div class="col-sm-12 text-center" >
                            <div class="pagination-container">{!!$shippings->render()!!}</div>
                        </div>
                    </div>
                    @endif
                     
                  
                
                   

                </div>
        </div>



               

        </div>
        <!-- <div class="col-sm-5 col-lg-4">
            
            <div class="col-sm-12">
                <div class="block block-link-hover3" href="javascript:void(0)">
                    <div class="block-content block-content-full text-center">
                       Request
                    </div>
                    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                       
                    </div>
                    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                        
                        
                    </div>
                    <div class="block-content">
                        <div class="row items-push text-center">
                            
                            
                        </div>
                    </div>
                </div>
            </div>
           
        </div> -->
    </div>
</div>
<!-- END Page Content -->


@endsection
@section('scripts')
<script src="/js/plugins/select2/select2.full.min.js"></script>
<script src="/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="/js/plugins/ajaxupload.js"></script>
<script src="/js/plugins/magnific-popup/magnific-popup.min.js"></script>
<script src="{{ mix('/js/shippings.js') }}"></script>

<script>
        // Init page helpers (Magnific Popup plugin)
        App.initHelpers('magnific-popup');

</script>
@endsection

