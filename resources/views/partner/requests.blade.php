@extends('layouts.app')

@section('content')
 
  <div class="content">
                   
    <h2 class="content-heading">Your Requests quotations</h2>
    <div class="row">
    @foreach($quotationRequests as $request)
        <div class="col-sm-6 col-lg-4">
            <div class="block block-link-hover3" href="javascript:void(0)">
                @include('requests/partials/item', ['request' => $request, 'partner' =>  $request->user->hasRole('partner') ? $request->user : $request->user->partners->first(),  'user' =>  $request->user->hasRole('user') ? $request->user : '' ])
                <div class="block-content">
                    <div class="row items-push text-center">
                        <a class="col-xs-4" href="/requests/{{ $request->id }}/quotations">
                            <div class="h3 push-5"> {{ $request->quotations->count() }}</div>
                            <div class="h5 font-w300 text-muted">Offers</div>
                        </a>
                        <a class="col-xs-4" href="#">
                            <div class="push-5"><i class="si si-cloud-download fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Download</div>
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
