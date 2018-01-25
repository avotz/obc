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
        
        <h1 class="h2 text-white push-5-t animated zoomIn" title="Editar orden de compra">Edit Purchase Order </h1><small class="label label-{{ trans('utils.purchase_status_color.'.$purchase->status) }}">{{ trans('utils.purchase_status.'.$purchase->status) }}</small>
        
           
    
       
       
        
        
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <div class="col-sm-7 col-lg-8">
         <div class="block">
                
                <div class="block-content">
                     @if(!$purchase->createdBy(auth()->user()))

                         <div class="form-group">
                         @if(isset($purchase) && $purchase->isPending())
                            <button class="btn btn-success" type="submit" data-toggle="tooltip" title="Aprobar" form="form-approve" formaction="{!! url('/purchases/'.$purchase->id .'/status') !!}" title="Aprovar">Approve</button>
                            <button class="btn btn-danger" type="submit" data-toggle="tooltip" title="Rechazar" form="form-reject" formaction="{!! url('/purchases/'.$purchase->id .'/status') !!}" title="Rechazar">Reject</button>
                         @endif
                        </div>
                    @else 
                        @if(isset($purchase) && $purchase->status != 1)
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit" data-toggle="tooltip" title="Eliminar" form="form-delete" formaction="{!! url('/purchases/'.$purchase->id) !!}" title="Eliminar">Delete</button>
                         </div>
                         @endif
                    @endif
                </div>
        </div>
        <div class="block">
                
                <div class="block-content">
                     
                    <form class="js-validation-register form-horizontal push-50" method="POST" action="/purchases/{{ $purchase->id }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">              
                        {{ csrf_field() }}
                        @include('purchases/partials/form') 
                    
                    </form>
                  
                   

                </div>
        </div>



               

        </div>
        <div class="col-sm-5 col-lg-4">
            
        <div class="col-sm-12">
                <div class="block block-link-hover3" href="javascript:void(0)">
                     @include('quotations/partials/item') 
                    
                </div>
            </div>
           
        </div>
    </div>
</div>
<!-- END Page Content -->
<form method="post" id="form-approve" data-confirm="Estas Seguro?">
   <input type="hidden" name="_method" value="PUT">  
   <input type="hidden" value="1" name="status">            
    {{ csrf_field() }}
</form>
<form method="post" id="form-reject" data-confirm="Estas Seguro?">
    <input type="hidden" name="_method" value="PUT"> 
    <input type="hidden" value="2" name="status">             
    {{ csrf_field() }}
</form>
<form method="post" id="form-delete" data-confirm="Estas Seguro?">
  <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
</form>

@endsection
@section('scripts')
<script src="/js/plugins/select2/select2.full.min.js"></script>
<script src="/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="/js/plugins/ajaxupload.js"></script>
<script src="/js/plugins/magnific-popup/magnific-popup.min.js"></script>
<script src="{{ mix('/js/purchases.js') }}"></script>

<script>
        // Init page helpers (Magnific Popup plugin)
        App.initHelpers('magnific-popup');
        jQuery('input[name=amount]').keyup(function() {
          
            var amount = jQuery('#amount').val() ? parseFloat(jQuery('#amount').val()) : 0;
            var discount = parseFloat({{ $discount }} / 100);

            var subtotal = discount * amount;

            var total = amount - subtotal;

            jQuery('#total').val(total);
            jQuery('#discount').text(subtotal);
        });
</script>
@endsection

