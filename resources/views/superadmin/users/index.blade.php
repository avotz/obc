@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="/js/plugins/select2/select2.min.css">
@endsection
@section('content')
<!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading" title="Busqueda de usuarios">
                    Search Users 
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li title="Usuarios">Users</li>
                    <li><a class="link-effect" href="" title="Resultado de busqueda">Search Results</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <!-- Search Section -->
    <div class="content filters">
        <form action="/superadmin/users" method="get" class="form-inline">
          
            
            <div class="form-group">
                    <div class="input-group input-group-lg">
                        <input class="form-control" name="q" type="text" placeholder="Name, Email.." value="{{ $search['q'] }}">
                        <div class="input-group-btn">
                            <button class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
            </div>
               
               
                
            <div class="form-group">
                    
                        <select name="search_country" id="search_country"  class="js-select2 form-control input-lg" data-placeholder="Country">
                                    <option value="" title="Todos">All</option>
                                    @foreach ($countries as $c)
                                    <option value="{{ $c->id}}"  @if($c->id == $search['search_country']) selected="selected" @endif> {{ $c->name }}</option>
                                    @endforeach
                                    
                                </select>
                    
            </div>
                                
                            
                            
                            
                        
                
   
          
        </form>
    </div>
    <!-- END Search Section -->

    <!-- Page Content -->
    <div class="content">
        <div class="block">
            <ul class="nav nav-tabs" data-toggle="tabs">
               
                <li class="active">
                    <a href="#search-users" title="Usuarios administrativos">Admin users</a>
                </li>
                
               
            </ul>
            <div class="block-content tab-content bg-white">
                
                <!-- Users -->
                    <div class="tab-pane fade fade-up in active" id="search-users">
                        <a href="/superadmin/users/create" class="btn btn-info pull-right" title="Crear usuario">Create User</a>
                        <div class="border-b push-30">
                            <h2 class="push-10" title="{{ $users->total() }} Usuarios encontrados">{{ $users->total() }} <span class="h5 font-w400 text-muted">Users Found</span></h2>
                        </div>
                    
                        <table class="table table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 100px;" title="ID">ID</th>
                                    <th class="text-center" style="width: 100px;"><i class="si si-user"></i></th>
                                    <th title="Nombre">Name</th>
                                
                                    <th class="hidden-xs" style="width: 30%;" title="Correo">Email</th>
                                    <th class="hidden-xs" style="width: 30%;" title="País">Country</th>
                                    <th class="hidden-xs">Role</th>
                                    <th class="hidden-xs hidden-sm" style="width: 15%;" title="Estatus">Status</th>
                                    <th class="text-center" style="width: 80px;" title="Acciones">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="font-w600">{{ $user->id }}</td>
                                    <td class="text-center">
                                        <img class="img-avatar img-avatar48" src="{{ getAvatar($user) }}" alt="User">
                                    </td>
                                    <td class="font-w600">{{ Optional($user->profile)->applicant_name}}</td>
                                    <td class="hidden-xs">{{ $user->email }}</td>
                                    <td class="hidden-xs">
                                    @if($user->countries->first())    
                                        <update-country :user-id="{{ $user->id }}" :current-country="{{ $user->countries->first() }}" :countries="{{ $countries }}"></update-country>   
                                    @endif
                                    </td>
                                    <td class="hidden-xs">
                                    @foreach($user->roles as $role)
                                        <span class="label label-{{ trans('utils.role.'.$role->id) }}">{{ $role->name }}</span>
                                     @endforeach
                                    </td>
                                    <td class="hidden-xs hidden-sm">
                                    @if ($user->id != auth()->id())
                                        @if ($user->active)
                                        
                                                <button type="submit"  class="btn btn-success btn-xs" form="form-active-inactive" formaction="{!! URL::route('superadmin.users.inactive', [$user->id]) !!}">Active</button>
                                            
            
                                        @else
                                            
                                            <button type="submit"  class="btn btn-danger btn-xs " form="form-active-inactive" formaction="{!! URL::route('superadmin.users.active', [$user->id]) !!}" >Inactive</button>
            
                                        @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                        @if ($user->id != auth()->id())
                                            <a href="/superadmin/users/{{ $user->id }}/edit" class="btn btn-xs btn-default"data-toggle="tooltip" title="Edit User"><i class="fa fa-pencil"></i></a>
                                    
                                            <button class="btn btn-xs btn-default" type="submit" data-toggle="tooltip" title="Remove User" form="form-delete" formaction="{!! url('/superadmin/users/'.$user->id) !!}"><i class="fa fa-times"></i></button>
                                        @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    @if ($users)
                        <div class="border-t pagination-container">
                            {!!$users->appends(['q' => $search['q']])->render()!!}
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

    jQuery('.js-select2').select2({
        allowClear:true
    });

     function submitForm(){
        $('.filters').find('form').submit();
    }


    $('select[name=search_country]').change(submitForm);

    $("form[data-confirm]").submit(function() {
        if ( ! confirm($(this).attr("data-confirm"))) {
            return false;
        }
    });
</script>
@endsection
