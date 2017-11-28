@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading" title="Buscar envios y solicitudes">
                    Search Shipping & Requests<small></small>
                </h1>
                <a href="/quotations/{{ $quotation->id }}/shipping-requests/create" class="btn btn-success" title="Crear">Create</a>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li title="Envios y solicitudes">Shipping & Requests</li>
                    <li><a class="link-effect" href="" title="Resultados de envios">Shipping Results</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <shipping-requests url-shippings="/quotations/{{ $quotation->id }}/shippings" url-shippings-requests="/quotations/{{ $quotation->id }}/shipping-requests"></shipping-requests>    
    
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
