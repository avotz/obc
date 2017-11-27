@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="/js/plugins/magnific-popup/magnific-popup.min.css">
@endsection
@section('content')
 
  <div class="content">
                   
    <h2 class="content-heading" title="Tus solicitudes de cotización">Your quotation requests</h2>
    <div class="row">
        @foreach($quotationRequests as $request)
            <div class="col-sm-6 col-lg-4">
                <div class="block block-link-hover3" href="javascript:void(0)">
                    @include('requests/partials/item', ['request' => $request, 'partner' =>  $request->user->companies->first(),  'user' => $request->user])
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
