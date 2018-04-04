@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="/js/plugins/select2/select2.min.css">
@endsection
@section('content')
<!-- Page Header -->
<div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading" title="Busqueda de sectores">
                    Search Sectors 
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li title="Sectores">Sectors</li>
                    <li><a class="link-effect" href="" title="Resultados de busqueda">Search Results</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <!-- Search Section -->
    <div class="content filters">
        <form action="/superadmin/sectors" method="get" class="form-inline">
            <div class="input-group input-group-lg">
                <input class="form-control" name="q" type="text" placeholder="Name" value="{{ $search['q'] }}">
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
                    <a href="#search-users" title="Sectores y subsectores">Sectors & sub-sectors</a>
                </li>
                
               
            </ul>
            <div class="block-content tab-content bg-white">
                
                <!-- Users -->
                <div class="tab-pane fade fade-up in active" id="search-users">
                <a href="/superadmin/sectors/create" class="btn btn-info pull-right">Create Sector</a>
                    <div class="border-b push-30">
                        <h2 class="push-10" title="{{ $sectors->total() }} Paises encontrados">{{ $sectors->total() }} <span class="h5 font-w400 text-muted">Sectors Found</span></h2>
                       
                       
                
                    </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="hidden-xs text-center" style="width: 100px;" title="ID">ID</th>
                            
                                <th title="Nombre">Name</th>
                               
                                <th class="hidden-xs" style="width: 30%;" title="Traducción">Translate</th>
                                <!-- <th class="hidden-xs" style="width: 30%;">Currency</th> -->
                               
                                <th class="text-center" style="width: 80px;" title="Acciones">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sectors as $sector)
                            <tr>
                                <td class="hidden-xs font-w600">{{ $sector->id }}</td>
                               
                                <td class="font-w600" >
                                @if ($sector->depth > 0 )
                                    {!! get_depth($sector->depth) !!}   {{ $sector->name }}
                                @else 
                                     <b class="text-info">{{ $sector->name }}</b>
                                @endif
                               
                                </td>
                                <td class="hidden-xs">{{ $sector->name_es }}</td>
                                <!-- <td class="hidden-xs">
                                {{ $sector->currency }}
                                </td> -->
                               
                                <td class="text-center">
                                    <div class="btn-group">
                                    @if (auth()->user()->hasRole('superadmin'))
                                        <a href="/superadmin/sectors/{{ $sector->id }}/edit" class="btn btn-xs btn-default"data-toggle="tooltip" title="Editar"><i class="fa fa-pencil"></i></a>
                                    
                                        <button class="btn btn-xs btn-default" type="submit" data-toggle="tooltip" title="Eliminar" form="form-delete" formaction="{!! url('/superadmin/sectors/'.$sector->id) !!}"><i class="fa fa-times"></i></button>
                                    @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    @if ($sectors)
                        <div class="border-t pagination-container">
                            {!!$sectors->appends(['q' => $search['q']])->render()!!}
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
