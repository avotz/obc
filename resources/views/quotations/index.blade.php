@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="/js/plugins/magnific-popup/magnific-popup.min.css">
@endsection
@section('content')
 
  <div class="content">
                   
    <h2 class="content-heading">Quotations</h2>
    <div class="row">

        @forelse($quotations as $quotation)
        <div class="col-sm-6 col-lg-4">
            <div class="block block-link-hover3" href="javascript:void(0)">
                 @include('quotations/partials/item', ['quotation' => $quotation, 'partner' =>  $quotation->user->companies->first(),  'user' => $quotation->user ])
                <div class="block-content">
                    <div class="row items-push text-center">
                        <a class="col-xs-4" href="#" data-toggle="modal" data-target="#modal-questions" data-user="{{ $quotation->user->email }}" data-partner="{{ $quotation->user->companies->first()->id }}" data-transaction="{{ $quotation->transaction_id }}"  >
                            <div class="push-5"><i class="si si-question fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Questions</div>
                        </a>
                       
                        <a class="col-xs-4" href="{{ getQuotationFile($quotation) }}" target="_blank">
                            <div class="push-5"><i class="si si-cloud-download fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Download</div>
                        </a>
                        @if($quotation->purchase)
                        <a class="col-xs-4" href="/purchases/{{ $quotation->purchase->id}}/edit">
                            <div class="h3 push-5 text-{{ trans('utils.purchase_status_color.'.$quotation->purchase->status) }}"> {{  $quotation->purchase->count() }}</div>
                            <div class="h5 font-w300 text-muted">Purchase Order </div>
                        </a>
                        @else
                        <a class="col-xs-4" href="/quotations/{{ $quotation->id}}/purchases/create">
                            <div class="push-5"><i class="si si-handbag fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Purchase Order </div>
                        </a> 
                        
                        @endif
                        @if($quotation->shippings)
                        <a class="col-xs-4" href="/quotations/{{ $quotation->id}}/shippings">
                            <div class="h3 push-5 text-success"> {{  $quotation->shippings->count() }}</div>
                            <div class="h5 font-w300 text-muted">Shipping</div>
                        </a>
                        @else
                        <a class="col-xs-4" href="/quotations/{{ $quotation->id}}/shippings">
                            <div class="push-5"><i class="si si-plane fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Shipping</div>
                        </a>
                        @endif
                         @if($quotation->credits)
                        <a class="col-xs-4" href="/quotations/{{ $quotation->id}}/credits">
                            <div class="push-5"><i class="si si-credit-card fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Financing</div>
                        </a>
                        @else
                        <a class="col-xs-4" href="/quotations/{{ $quotation->id}}/credits">
                            <div class="push-5"><i class="si si-credit-card fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Financing</div>
                        </a>
                        @endif
                        <a class="col-xs-4" href="#">
                            <div class="push-5"><i class="si si-check fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Send</div>
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-sm-12 text-center" >
            <p>This quotation request does not have offers</p>
        </div>
        @endforelse
    </div>
    @if($quotations->count())
    <div class="row">
        <div class="col-sm-12 text-center" >
            <div class="pagination-container">{!!$quotations->render()!!}</div>
        </div>
    </div>
    @endif
</div>

@include('layouts.partials.questions-modal')

<!-- END question Modal -->
@endsection
@section('scripts')
<script src="/js/plugins/magnific-popup/magnific-popup.min.js"></script>
<script src="{{ mix('/js/questions.js') }}"></script>
<script>
        // Init page helpers (Magnific Popup plugin)
        App.initHelpers('magnific-popup');

</script>
@endsection
