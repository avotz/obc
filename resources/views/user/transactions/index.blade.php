@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="/js/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css">
@endsection
@section('content')
<!-- Page Header -->
<div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading" title="Buscar transacciones">
                    Search Transactions<small></small>
                </h1>
               
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li title="Transacciones">Transactions</li>
                    <li><a class="link-effect" href="" title="Resultados de transacciones">Transactions Results</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <transactions :country="{{ $country }}"
                :url-shippings="'/user/shippings'"
                :url-shippings-requests="'/user/shipping-requests'"
                :url-credits="'/user/credits'"
                :url-credit-requests="'/user/credit-requests'"
                :url-quotations="'/user/quotations'"
                :url-quotation-requests="'/user/quotation-requests'"
                :url-purchase-orders="'/user/purchase-orders'"
    ></transactions>    
    

@endsection
@section('scripts')
<script src="/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script>
        jQuery('.js-datepicker').datepicker({
            
    });
        $("form[data-confirm]").submit(function() {
            if ( ! confirm($(this).attr("data-confirm"))) {
                return false;
            }
        });
    </script>
@endsection