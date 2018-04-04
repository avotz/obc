@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="/js/plugins/magnific-popup/magnific-popup.min.css">
@endsection

@section('content')
 
  <div class="content">
                   
    <h2 class="content-heading" title="Solicitudes de cotizaciones">Quotation Requests</h2>
    <div class="row">
        @forelse($quotationRequests as $request)
        <div class="col-sm-6 col-lg-4">
            <div class="block block-link-hover3" href="javascript:void(0)">
                @include('requests/partials/item', ['request' => $request, 'partner' =>  $request->user->companies->first(),  'user' =>  $request->user])
                @if(auth()->user()->companies->first()->id == $request->company_id )
                <div class="block-content">
                    <div class="row items-push text-center">
                        <a class="col-xs-4" href="/requests/{{ $request->id }}/quotations">
                            <div class="h3 push-5"> {{ $request->quotations->count() }}</div>
                            <div class="h5 font-w300 text-muted" title="Ofertas">Offers</div>
                        </a>
                        <a class="col-xs-4" href="{{ getRequestFile($request) }}" target="_blank">
                            <div class="push-5"><i class="si si-cloud-download fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted" title="Descargar">Download</div>
                        </a>
                        <a class="col-xs-4" href="/requests/{{ $request->id }}/edit">
                            <div class="push-5"><i class="si si-list fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted" title="Editar">Edit</div>
                        </a>
                    
                        
                    </div>
                </div>
                @else 
                <div class="block-content">
                    <div class="row items-push text-center">
                        <a class="btn-questions col-xs-4" href="#" data-toggle="modal" data-target="#modal-questions" data-user="{{ $request->user->email }}" data-partner="{{ $request->user->companies->first()->id }}" data-transaction="{{ $request->transaction_id }}" >
                            <div class="push-5"><i class="si si-question fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted" title="Preguntas">Questions</div>
                        </a>
                        <a class="col-xs-4" href="{{ getRequestFile($request) }}" target="_blank">
                            <div class="push-5"><i class="si si-cloud-download fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted" title="Descargar">Download</div>
                        </a>
                        <a class="col-xs-4" href="/requests/{{ $request->id }}/quotations/create">
                            <div class="push-5"><i class="si si-wallet fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted" title="Subir Oferta">Submit Offer</div>
                        </a>
                        
                    </div>
                </div>

                @endif
            </div>
        </div>
        @empty
        <div class="col-sm-12 text-center" >
            <p title="No hay solicitudes de cotizaciones">There is no quotation requests</p>
        </div>
        @endforelse
     
          
      
    </div>
    @if($quotationRequests->count())
    <div class="row">
        <div class="col-sm-12 text-center" >
            <div class="pagination-container">{!!$quotationRequests->render()!!}</div>
        </div>
    </div>
    @endif
</div>

@include('layouts.partials.questions-modal')

@endsection
@section('scripts')
<script src="/js/plugins/magnific-popup/magnific-popup.min.js"></script>
<script src="{{ mix('/js/questions.js') }}"></script>
<script>
        // Init page helpers (Magnific Popup plugin)
        App.initHelpers('magnific-popup');

</script>
@endsection
