@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading" title="Busqueda creditos y solicitudes">
                    Search Credits & Requests<small></small>
                </h1>
                <a href="/quotations/{{ $quotation->id }}/credit-requests/create" class="btn btn-success" title="Crear">Create</a>
                <a href="/requests/{{ $quotation->request_id }}/quotations" class="btn btn-info" title="Regresar a las cotizaciones">Back to quotations</a>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li title="Creditos y solicitudes">Credits & Requests</li>
                    <li><a class="link-effect" href="" title="Resultados de creditos">Credit Results</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <credit-requests url-credits="/quotations/{{ $quotation->id }}/credits" url-credit-requests="/quotations/{{ $quotation->id }}/credit-requests"></credit-requests>    
    
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
