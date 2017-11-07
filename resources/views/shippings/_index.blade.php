@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Search Shipping <small></small>
                </h1>
                <a href="/quotations/{{ $quotation->id }}/shippings/create">Create</a>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li>Shipping Requests</li>
                    <li><a class="link-effect" href="">Shipping Results</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <!-- Search Section -->
    <div class="content">
        <form action="/quotations/{{ $quotation->id }}/shippings" method="get">
            <div class="input-group input-group-lg">
                <input class="form-control" name="q" type="text" placeholder="Search user by Transaction ID.." value="{{ $search['q'] }}">
                <div class="input-group-btn">
                    <button class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <!-- END Search Section -->

    <!-- Page Content -->
    <div class="content">
        <div class="block">
            <ul class="nav nav-tabs" data-toggle="tabs">
               
                <li class="active">
                    <a href="#search-shippings-request">Shipping Requests</a>
                </li>
                <li >
                    <a href="#search-shippings">Shippings</a>
                </li>
               
               
            </ul>
            <div class="block-content tab-content bg-white">
                
                <!-- Users -->
                <div class="tab-pane fade fade-up in active" id="search-shippings-request">
                    <div class="border-b push-30">
                        <h2 class="push-10">{{ $shippings->total() }} <span class="h5 font-w400 text-muted">Shippings Request Found</span></h2>
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 100px;">ID</th>
                                <th class="text-center" style="width: 100px;"><i class="si si-user"></i></th>
                                <th>Delivery Time</th>
                                <th class="hidden-xs" style="width: 30%;">Request Date</th>
                                <th class="hidden-xs hidden-sm" style="width: 15%;">Status</th>
                                <th class="text-center" style="width: 80px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shippings as $shipping)
                            <tr>
                                <td class="font-w600">{{ $shipping->transaction_id }}</td>
                                <td class="text-center">
                                    {{ $shipping->quotation->user->public_code }}
                                </td>
                                <td class="font-w600">{{ $shipping->delivery_time }}</td>
                                <td class="hidden-xs">{{ $shipping->date }}</td>
                                <td class="hidden-xs hidden-sm">
                                @if ($shipping->status == 0)
                                
                                        <button type="submit"  class="btn btn-success btn-xs" form="form-active-inactive" formaction="{!! URL::route('users.inactive', [$shipping->id]) !!}">Accept</button>
                                    
                                        <button type="submit"  class="btn btn-danger btn-xs " form="form-active-inactive" formaction="{!! URL::route('users.active', [$shipping->id]) !!}" >Reject</button>
                                @elseif ($shipping->status == 1)
                                    
                                     <span class="label label-success">Accept</span>
                                @else 
                                     <span class="label label-danger">Reject</span>
                                @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="/shippings/{{ $shipping->id }}/edit" class="btn btn-xs btn-default"data-toggle="tooltip" title="Edit Shipping"><i class="fa fa-pencil"></i></a>
                                        @if($shipping->isPending())
                                        <button class="btn btn-xs btn-default" type="submit" data-toggle="tooltip" title="Remove Client" form="form-delete" formaction="{!! url('/shippings/{{ $shipping->id }}') !!}"><i class="fa fa-times"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    @if ($shippings)
                        <div class="border-t pagination-container">
                            {!!$shippings->appends(['q' => $search['q']])->render()!!}
                        </div>
                       
                    @endif
                   
                </div>
                <!-- END Users -->
                <div class="tab-pane fade fade-up in " id="search-shippings">
                    <div class="border-b push-30">
                        <h2 class="push-10">{{ $shippings->total() }} <span class="h5 font-w400 text-muted">Shippings Found</span></h2>
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 100px;">ID</th>
                                <th class="text-center" style="width: 100px;"><i class="si si-user"></i></th>
                                <th>Delivery Time</th>
                                <th class="hidden-xs" style="width: 30%;">Request Date</th>
                                <th class="hidden-xs hidden-sm" style="width: 15%;">Status</th>
                                <th class="text-center" style="width: 80px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shippings as $shipping)
                            <tr>
                                <td class="font-w600">{{ $shipping->transaction_id }}</td>
                                <td class="text-center">
                                    {{ $shipping->quotation->user->public_code }}
                                </td>
                                <td class="font-w600">{{ $shipping->delivery_time }}</td>
                                <td class="hidden-xs">{{ $shipping->date }}</td>
                                <td class="hidden-xs hidden-sm">
                                @if ($shipping->status == 0)
                                
                                        <button type="submit"  class="btn btn-success btn-xs" form="form-active-inactive" formaction="{!! URL::route('users.inactive', [$shipping->id]) !!}">Accept</button>
                                    
                                        <button type="submit"  class="btn btn-danger btn-xs " form="form-active-inactive" formaction="{!! URL::route('users.active', [$shipping->id]) !!}" >Reject</button>
                                @elseif ($shipping->status == 1)
                                    
                                     <span class="label label-success">Accept</span>
                                @else 
                                     <span class="label label-danger">Reject</span>
                                @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="/shippings/{{ $shipping->id }}/edit" class="btn btn-xs btn-default"data-toggle="tooltip" title="Edit Shipping"><i class="fa fa-pencil"></i></a>
                                        @if($shipping->isPending())
                                        <button class="btn btn-xs btn-default" type="submit" data-toggle="tooltip" title="Remove Client" form="form-delete" formaction="{!! url('/shippings/{{ $shipping->id }}') !!}"><i class="fa fa-times"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    @if ($shippings)
                        <div class="border-t pagination-container">
                            {!!$shippings->appends(['q' => $search['q']])->render()!!}
                        </div>
                       
                    @endif
                   
                </div>
                <!-- END Users -->

               
            </div>
        </div>
    </div>
    <!-- END Page Content -->
<form method="post" id="form-delete" data-confirm="Estas Seguro?">
  <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
</form>
<form method="post" id="form-active-inactive">
 {{ csrf_field() }}
</form>
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
