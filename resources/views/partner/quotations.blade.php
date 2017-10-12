@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="/js/plugins/magnific-popup/magnific-popup.min.css">
@endsection
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
                    @if($quotation->purchase)
                        <a class="col-xs-4" href="/quotations/{{ $quotation->id }}/purchase">
                            <div class="h3 push-5">1</div>
                            <div class="h5 font-w300 text-muted">Purchase Order</div>
                        </a>
                    @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
</div>
@endsection
@section('scripts')
<script src="/js/plugins/magnific-popup/magnific-popup.min.js"></script>

    <script>
         $(function () {
       
                // Init page helpers (Magnific Popup plugin)
                App.initHelpers('magnific-popup');

                $("form[data-confirm]").submit(function() {
                    if ( ! confirm($(this).attr("data-confirm"))) {
                        return false;
                    }
                });
        });
    </script>
@endsection
