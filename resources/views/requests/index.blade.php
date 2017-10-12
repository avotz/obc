@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="/js/plugins/magnific-popup/magnific-popup.min.css">
@endsection

@section('content')
 
  <div class="content">
                   
    <h2 class="content-heading">Requests quotations</h2>
    <div class="row">
        @forelse($quotationRequests as $request)
        <div class="col-sm-6 col-lg-4">
            <div class="block block-link-hover3" href="javascript:void(0)">
                @include('requests/partials/item', ['request' => $request, 'partner' =>  $request->user->hasRole('partner') ? $request->user : $request->user->partners->first(),  'user' =>  $request->user->hasRole('user') ? $request->user : '' ])
                @if($request->createdBy(auth()->user()))
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
                        <a class="col-xs-4" href="/requests/{{ $request->id }}/edit">
                            <div class="push-5"><i class="si si-list fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Edit</div>
                        </a>
                    
                        
                    </div>
                </div>
                @else 
                <div class="block-content">
                    <div class="row items-push text-center">
                        <a class="btn-questions col-xs-4" href="#" data-toggle="modal" data-target="#modal-questions" data-user="{{ $request->user->hasRole('user') ? $request->user->email : '' }}" data-partner="{{ $request->user->hasRole('partner') ? $request->user->email : $request->user->partners->first()->email }}" data-transaction="{{ $request->transaction_id }}" >
                            <div class="push-5"><i class="si si-question fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Questions</div>
                        </a>
                        <a class="col-xs-4" href="#">
                            <div class="push-5"><i class="si si-cloud-download fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Download</div>
                        </a>
                        <a class="col-xs-4" href="/requests/{{ $request->id }}/quotations/create">
                            <div class="push-5"><i class="si si-wallet fa-2x"></i></div>
                            <div class="h5 font-w300 text-muted">Submit Offer</div>
                        </a>
                        
                    </div>
                </div>

                @endif
            </div>
        </div>
        @empty
        <div class="col-sm-12 text-center" >
            <p>There is no quotation requests</p>
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
<!-- <script src="/js/plugins/bootstrap.min.js"></script> -->
    <script>
    
      $(function () {
       
                // Init page helpers (Magnific Popup plugin)
                App.initHelpers('magnific-popup');

                $("form[data-confirm]").submit(function() {
                    if ( ! confirm($(this).attr("data-confirm"))) {
                        return false;
                    }
                });
                
                var modalForm = $('#modal-questions')
                
                modalForm.on('shown.bs.modal', function (event) {
            
                        var button = $(event.relatedTarget) // Button that triggered the modal
                        var subject = button.attr('data-transaction');
                        var partner = button.attr('data-partner');
                        var user = button.attr('data-user');

                    
                        var modal = $(this);

                            modal.find('#modal-questions-subject').val(subject)
                            modal.find('#modal-questions-partner').val(partner)
                            modal.find('#modal-questions-user').val(user)
            
                });



                modalForm.find('.modal-question-btn-send').on('click', function (e) {
                    e.preventDefault();
                    
                    var form = modalForm.find('#modal-questions-form');
                    var formData = form.serializeArray();
                    
                    formData.push({ name: '_token', value:$('meta[name="csrf-token"]').attr('content')});
                    
                    $('body').addClass('loading');

                    $.ajax({
                        type: 'POST',
                        url: '/questions',
                        data: formData,
                        success: function (resp) {

                            $('body').removeClass('loading');

                            if(resp == 'ok'){
                                modalForm.find('#modal-questions-msg').val('');

                                alert('Message sent');
                            }
                        },
                        error: function () {
                            
                            $('body').removeClass('loading');

                            console.log('error  reminder');
                            

                        }
                    });
                
                });


        });
       
    </script>
@endsection
