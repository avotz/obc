@extends('layouts.app')

@section('content')
 
  <div class="content">
                   
    <h2 class="content-heading">Quotations</h2>
    <div class="row">
        @foreach($quotations as $quotation)
        <div class="col-sm-6 col-lg-4">
            <div class="block block-link-hover3" href="javascript:void(0)">
                 @include('quotations/partials/item', ['quotation' => $quotation, 'partner' =>  $quotation->user->hasRole('partner') ? $quotation->user : $quotation->user->partners->first(),  'user' =>  $quotation->user->hasRole('user') ? $quotation->user : '' ])
                <div class="block-content">
                    <div class="row items-push text-center">
                        <a class="col-xs-4" href="#">
                            <div class="push-5"><i class="si si-question fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Questions</div>
                        </a>
                        <a class="col-xs-4" href="#">
                            <div class="push-5"><i class="si si-cloud-download fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Download</div>
                        </a>
                        <a class="col-xs-4" href="#">
                            <div class="push-5"><i class="si si-handbag fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Purchase Order</div>
                        </a>
                        <a class="col-xs-4" href="#">
                            <div class="push-5"><i class="si si-plane fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Shipping</div>
                        </a>
                        <a class="col-xs-4" href="#">
                            <div class="push-5"><i class="si si-credit-card fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Financing</div>
                        </a>
                        <a class="col-xs-4" href="#">
                            <div class="push-5"><i class="si si-check fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Send</div>
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
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
