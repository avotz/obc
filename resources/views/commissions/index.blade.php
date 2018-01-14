@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="/js/plugins/magnific-popup/magnific-popup.min.css">
@endsection
@section('content')
 
  <div class="content content-boxed">
    <div class="row">
        <div class="col-sm-12 col-lg-12">

        <div class="block">
                
                <div class="block-content">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 100px;" title="ID">ID</th>
                                <th title="Compañia">Company</th>
                                <th title="Orden de compra">Purchase Order</th>
                                <th title="Monto">Amount</th>
                                <th title="% OBC">% OBC</th>
                                <th title="Total">Total</th>
                                <th style="width: 15%;" title="Estatus">Status</th>
                                <th class="text-center" style="width: 80px;" title="Acciones">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($commissions as $commission)
                            <tr>
                                <td class="font-w600">{{ $commission->id }}</td>
                                
                                <td class="font-w600">{{ $commission->purchase->quotation->user->companies->first()->company_name }}</td>
                                <td class="font-w600">{{ $commission->purchase->transaction_id  }} <a href="#">ver detalle</a></td>
                                <td class="hidden-xs">{{ $commission->amount }} {{ $commission->currency }}</td>
                                <td class="hidden-xs">{{ $commission->percent }}% - {{ calculatePercentAmount($commission->percent, $commission->amount) }} {{ $commission->currency }}</td>
                                <td class="hidden-xs">{{ $commission->total }} {{ $commission->currency }}</td>
                                <td class="hidden-xs hidden-sm">
                                    @if($commission->status == 0)
                                        <span class="label label-danger" title="Pendiente">Pending</span>
                                    @endif
                                    @if($commission->status == 1)
                                        <span class="label label-warning" title="En transito">In Transit</span>
                                    @endif
                                    @if($commission->status == 2)
                                        <span class="label label-success" title="Pagada">Paid</span>
                                    @endif
                                    
                                </td>
                                <td class="text-center">
                                  @if($commission->status == 0)
                                    <button class="btn btn-success" type="submit" form="form-status-pay" formaction="/commissions/{{ $commission->id }}/status" title="Pagar">Change to Paid</button>
                                     @endif
                                     @if($commission->status == 1 && auth()->user()->hasRole('admin'))
                                          <button class="btn btn-success" type="submit" form="form-status-paid" formaction="/commissions/{{ $commission->id }}/status" title="Confirmar Pago">Confirm pay</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                           
                            
                        </tbody>
                    </table>
                     @if($commissions->count())
                    <div class="row">
                        <div class="col-sm-12 text-center" >
                            <div class="pagination-container">{!!$commissions->render()!!}</div>
                        </div>
                    </div>
                    @endif
                     
                  
                
                   

                </div>
        </div>



               

        </div>
        
    </div>
</div>
<!-- END Page Content -->
 <form method="post" id="form-status-pay">
    <input name="_method" type="hidden" value="PUT">{{ csrf_field() }}
    <input type="hidden" value="1" name="status">
</form>
<form method="post" id="form-status-paid">
    <input name="_method" type="hidden" value="PUT">{{ csrf_field() }}
    <input type="hidden" value="2" name="status">
</form>
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
