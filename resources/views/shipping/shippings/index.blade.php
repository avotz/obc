@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading" title="Buscar envios y solicitudes">
                    Search Shipping & Requests<small></small>
                </h1>
                
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li title="Envios y solicitudes">Shipping & Requests</li>
                    <li><a class="link-effect" href="" title="Resultado de envios">Shipping Results</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <shippings url-shippings="/shipping/shippings" url-shippings-requests="/shipping/shipping-requests"></shippings>    
    
<form method="post" id="form-delete" data-confirm="Estas Seguro?">
  <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
</form>
<form method="post" id="form-active-inactive">
 {{ csrf_field() }}
</form>
@endsection
@section('scripts')
    <script>
        $("form[data-confirm]").submit(function() {
            if ( ! confirm($(this).attr("data-confirm"))) {
                return false;
            }
        });
    </script>
@endsection
