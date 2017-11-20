@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Search Credits & Requests<small></small>
                </h1>
                
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li>Credits & Requests</li>
                    <li><a class="link-effect" href="">Credits Results</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <credits url-credits="/credit/credits" url-credit-requests="/credit/credit-requests"></credits>    
    
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
