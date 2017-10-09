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
