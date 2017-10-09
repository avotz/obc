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
        
        <h1 class="h2 text-white push-5-t animated zoomIn">Quotation for Quotation Request -{{ $quotationRequest->id }} </h1>
        
           
    
       
       
        
        
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <div class="col-sm-7 col-lg-8">

        <div class="block">
                
                <div class="block-content">
                    <form class="js-validation-register form-horizontal push-50" method="POST" action="/requests/{{ $quotationRequest->id }}/quotations" enctype="multipart/form-data">
                                        
                        {{ csrf_field() }}
                        @include('quotations/partials/form') 
                    
                    </form>

                </div>
        </div>



               

        </div>
        <div class="col-sm-5 col-lg-4">
            
            <div class="col-sm-12">
                <div class="block block-link-hover3" href="javascript:void(0)">
                    <div class="block-content block-content-full text-center">
                        <div>
                        
                            <img src="{{ getLogo($quotationRequest->user->company) }}" alt="Logo" id="company-logo" class="img-company-logo  " />
                            
                        </div>
                        <div class="h5 push-15-t push-5">Quotation Request #{{ $quotationRequest->id }} </div> <small class="label label-{{ trans('utils.public.colors.'.$quotationRequest->public) }}">{{ trans('utils.public.'.$quotationRequest->public) }}</small>
                    </div>
                    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                        <div class=" "><b>Partner name:</b> {{ $quotationRequest->user->company->company_name }}</div>
                        <div class=" "><b>Partner country:</b> {{ $quotationRequest->user->company->countries->first()->name }} <img src="{{ getFlag($quotationRequest->user->company->countries->first()->code) }}" alt="flag"></div>
                        <div class=""><b>Supplier sector:</b>  @foreach($quotationRequest->user->company->sectors as $item)
                                        
                                                {{ $item->name }},
                                            
                                            @endforeach</div>
                        <div class=" "><b>Supplier sub-sector:</b> @foreach($quotationRequest->user->company->sectors as $item)
                                        
                                                {{ $item->name }},
                                            
                                            @endforeach</div>
                        <div class=" "><b>Delivery time:</b> {{ $quotationRequest->delivery_time }}</div>
                        <div class=" "><b>Way of delivery:</b> {{ $quotationRequest->way_of_delivery }}</div>
                        <div class=" "><b>Way to pay:</b> {{ $quotationRequest->way_to_pay }}</div>
                        <div class=" "><b>Request valid until:</b> {{ $quotationRequest->exp_date }} </div>
                        <div class=" "><b>Additional comment:</b> {{ $quotationRequest->comments }}</div>
                    </div>
                    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                        <div class=" "><b>Partner ID:</b> {{ $quotationRequest->user->public_code }}</div>
                        <div class=" "><b>Transaction ID:</b> Quotation Request -{{ $quotationRequest->id }}</div>
                        <div class=""><b>User ID:</b>  {{ $quotationRequest->user->public_code }}</div>
                        <div class=" "><b>Date:</b> {{ $quotationRequest->created_at }} </div>
                        
                    </div>
                    <div class="block-content">
                        <div class="row items-push text-center">
                            
                            
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
<!-- END Page Content -->


@endsection
@section('scripts')
<script src="/js/plugins/select2/select2.full.min.js"></script>
<script src="/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="/js/plugins/ajaxupload.js"></script>
<script>
    
    jQuery('.js-select2').select2();
    $('#suppliers').select2({
        ajax: {
            delay: 300,
            url: '/suppliers',
            dataType: 'json',
            data: function (params) {
            var query = {
                q: params.term,
               
            }

            // Query parameters will be ?search=[term]&type=public
            return query;
            },
            processResults: function (data) {
            // Tranforms the top-level key of the response object from 'items' to 'results'
            return {
                results: data
            };
            }
        },
        minimumInputLength: 1,
        });

    jQuery('.suppliersSelectContainer').hide();
    
    jQuery('select[name=public]').change(function(e){
        if(jQuery(this).val() == '1'){
            jQuery('.suppliersSelectContainer').hide();
        }else{
            jQuery('.suppliersSelectContainer').show();
        }
    });

    jQuery('.js-datepicker').datepicker({
            
    });

    $("#UploadPhoto").ajaxUpload({
      url : $("#UploadPhoto").data('url'),
      name: "photo",
      data: {},
      onSubmit: function() {
          $('#infoBox').html('Uploading ... ');

      },
      onComplete: function(result) {

          if(result ==='error'){

            $('#infoBox').addClass('alert-danger').html('Error al subir archivo. Tipo no permitido!!').show();
              setTimeout(function()
              { 
                $('#infoBox').removeClass('alert-danger').hide();
              },3000);

         return

          }

          $('#infoBox').addClass('alert-success').html('La foto se ha guardado con exito!!').show();
            setTimeout(function()
            { 
              $('#infoBox').removeClass('alert-success').hide();
            },3000);
        d = new Date();
        
            $('#user-avatar').attr('src','/storage/'+ result+'?'+d.getTime());
      
      }
  });
  $("#UploadLogo").ajaxUpload({
      url : $("#UploadLogo").data('url'),
      name: "photo",
      data: {},
      onSubmit: function() {
          $('#infoBox').html('Uploading ... ');

      },
      onComplete: function(result) {

          if(result ==='error'){

            $('#infoBox').addClass('alert-danger').html('Error al subir archivo. Tipo no permitido!!').show();
              setTimeout(function()
              { 
                $('#infoBox').removeClass('alert-danger').hide();
              },3000);

         return

          }

          $('#infoBox').addClass('alert-success').html('El logo se ha guardado con exito!!').show();
            setTimeout(function()
            { 
              $('#infoBox').removeClass('alert-success').hide();
            },3000);
        d = new Date();
        
            $('#company-logo').attr('src','/storage/'+ result+'?'+d.getTime());
      
      }
  });
</script>
@endsection

