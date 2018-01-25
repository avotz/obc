@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="/js/plugins/select2/select2.min.css">
@endsection
@section('content')
<!-- Page Header -->
<div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading" title="Busqueda de paises">
                    Search Countries 
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li title="Paises">Countries</li>
                    <li><a class="link-effect" href="" title="Resultados de busqueda">Search Results</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <!-- Search Section -->
    <div class="content filters">
        <form action="/superadmin/countries" method="get" class="form-inline">
            <div class="input-group input-group-lg">
                <input class="form-control" name="q" type="text" placeholder="Name, code.." value="{{ $search['q'] }}">
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
                    <a href="#search-users" title="Paises">Countries</a>
                </li>
                
               
            </ul>
            <div class="block-content tab-content bg-white">
                
                <!-- Users -->
                <div class="tab-pane fade fade-up in active" id="search-users">
                <a href="/superadmin/countries/create" class="btn btn-info pull-right">Create Country</a>
                    <div class="border-b push-30">
                        <h2 class="push-10" title="{{ $countries->total() }} Paises encontrados">{{ $countries->total() }} <span class="h5 font-w400 text-muted">Countries Found</span></h2>
                       
                       
                
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 100px;" title="ID">ID</th>
                                <th class="text-center" style="width: 100px;"><i class="si si-flag"></i></th>
                                <th title="Nombre">Name</th>
                               
                                <th class="hidden-xs" style="width: 30%;" title="Codigo">Code</th>
                                <!-- <th class="hidden-xs" style="width: 30%;">Currency</th> -->
                               
                                <th class="text-center" style="width: 80px;" title="Acciones">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($countries as $country)
                            <tr>
                                <td class="font-w600">{{ $country->id }}</td>
                                <td class="text-center">
                                    <img  src="{{ getFlag($country->code) }}" alt="Flag">
                                </td>
                                <td class="font-w600" >{{ $country->name }}</td>
                                <td class="hidden-xs">{{ $country->code }}</td>
                                <!-- <td class="hidden-xs">
                                {{ $country->currency }}
                                </td> -->
                               
                                <td class="text-center">
                                    <div class="btn-group">
                                    @if (auth()->user()->hasRole('superadmin'))
                                        <a href="/superadmin/countries/{{ $country->id }}/edit" class="btn btn-xs btn-default"data-toggle="tooltip" title="Editar"><i class="fa fa-pencil"></i></a>
                                    
                                        <button class="btn btn-xs btn-default" type="submit" data-toggle="tooltip" title="Eliminar" form="form-delete" formaction="{!! url('/superadmin/countries/'.$country->id) !!}"><i class="fa fa-times"></i></button>
                                    @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    @if ($countries)
                        <div class="border-t pagination-container">
                            {!!$countries->appends(['q' => $search['q']])->render()!!}
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
<script src="/js/plugins/select2/select2.full.min.js"></script>
<script>

    
     function submitForm(){
        $('.filters').find('form').submit();
    }


    $("form[data-confirm]").submit(function() {
        if ( ! confirm($(this).attr("data-confirm"))) {
            return false;
        }
    });
</script>
@endsection
