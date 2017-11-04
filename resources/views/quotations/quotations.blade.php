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
                    @include('quotations/partials/item', ['quotation' => $quotation, 'partner' =>  $quotation->user->companies->first(),  'user' => $quotation->user ])
                    <div class="block-content">
                        <div class="row items-push text-center">
                        @if($quotation->purchase && $quotation->purchase->status == 1)
                            <a class="col-xs-4" href="/purchases/{{ $quotation->purchase->id }}/edit">
                                <div class="h3 push-5 text-success">1</div>
                                <div class="h5 font-w300 text-muted">Purchase Order</div>
                            </a>
                        @endif
                            <a class="col-xs-4" href="{{ getQuotationFile($quotation) }}" target="_blank">
                                <div class="push-5"><i class="si si-cloud-download fa-2x"></i></div>
                                <div class="h5 font-w300 text-muted">Download</div>
                            </a>
                            <a class="col-xs-4" href="/quotations/{{ $quotation->id }}/edit">
                                <div class="push-5"><i class="si si-list fa-2x"></i></div>
                                <div class="h5 font-w300 text-muted">Edit</div>
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
<script src="/js/plugins/magnific-popup/magnific-popup.min.js"></script>
<script src="{{ mix('/js/questions.js') }}"></script>
<script>
        // Init page helpers (Magnific Popup plugin)
        App.initHelpers('magnific-popup');

</script>
@endsection
