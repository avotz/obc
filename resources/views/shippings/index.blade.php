@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Search Shipping & Requests<small></small>
                </h1>
                <a href="/quotations/{{ $quotation->id }}/shippings-requests/create">Create</a>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li>Shipping & Requests</li>
                    <li><a class="link-effect" href="">Shipping Results</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <shippings url-shippings="/quotations/{{ $quotation->id }}/shippings" url-shippings-requests="/quotations/{{ $quotation->id }}/shipping-requests"></shippings>    
    
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
