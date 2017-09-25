@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="/js/plugins/select2/select2.min.css">
@endsection
@section('content')
<!-- Page Header -->
<div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Search Partners 
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li>Partners</li>
                    <li><a class="link-effect" href="">Search Results</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <!-- Search Section -->
    <div class="content filters">
        <form action="/admin/users" method="get" class="form-horizontal">
          
            
            <div class="form-group">
                    <div class="input-group input-group-lg">
                        <input class="form-control" name="q" type="text" placeholder="Search by Public code, Name, Email.." value="{{ $search['q'] }}">
                        <div class="input-group-btn">
                            <button class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
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
                    <a href="#search-users">Admin users</a>
                </li>
                
               
            </ul>
            <div class="block-content tab-content bg-white">
                
                <!-- Users -->
                <div class="tab-pane fade fade-up in active" id="search-users">
               
                    <div class="border-b push-30">
                        <h2 class="push-10">{{ $users->total() }} <span class="h5 font-w400 text-muted">Users Found</span></h2>
                       
                        
                
                    </div>
                    
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 100px;">ID</th>
                                <th class="text-center" style="width: 100px;"><i class="si si-user"></i></th>
                                <th>Name</th>
                               
                                <th class="hidden-xs" style="width: 30%;">Email</th>
                                
                                <th class="hidden-xs">Role</th>
                                <th class="hidden-xs hidden-sm" style="width: 15%;">Status</th>
                                <th class="text-center" style="width: 80px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="font-w600">{{ $user->public_code }}</td>
                                <td class="text-center">
                                    <img class="img-avatar img-avatar48" src="{{ getAvatar($user) }}" alt="User">
                                </td>
                                <td class="font-w600">{{ Optional($user->profile)->applicant_name}}</td>
                                <td class="hidden-xs">{{ $user->email }}</td>
                                
                                <td class="hidden-xs"><span class="label label-{{ trans('utils.role.'.$user->roles->first()->id) }}">{{ $user->roles->first()->name }}</span></td>
                                <td class="hidden-xs hidden-sm">
                                @if ($user->active)
                                
                                        <button type="submit"  class="btn btn-success btn-xs" form="form-active-inactive" formaction="{!! URL::route('admin.users.inactive', [$user->id]) !!}">Active</button>
                                    
    
                                @else
                                    
                                    <button type="submit"  class="btn btn-danger btn-xs " form="form-active-inactive" formaction="{!! URL::route('admin.users.active', [$user->id]) !!}" >Inactive</button>
    
                                @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                   
                                        <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-xs btn-default"data-toggle="tooltip" title="Edit User"><i class="fa fa-pencil"></i></a>
                                   
                                        <button class="btn btn-xs btn-default" type="submit" data-toggle="tooltip" title="Remove User" form="form-delete" formaction="{!! url('/admin/users/'.$user->id) !!}"><i class="fa fa-times"></i></button>
                                    
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
