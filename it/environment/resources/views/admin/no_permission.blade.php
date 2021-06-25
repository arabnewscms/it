@extends('admin.index')
@section('content')

<link href="{{url('design/admin_panel')}}//assets/pages/css/error-rtl.min.css" rel="stylesheet" type="text/css">
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> {{ trans('admin.error_permission_1') }}
<p><small>{{ trans('admin.error_permission_2') }}</small></p>
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12 page-404">
        <div class="number font-green"> 403 </div>
        <div class="details">
            <h3>{{ trans('admin.error_permission_3') }}</h3>
            <p> {{ trans('admin.error_permission_4') }}
                <br/>
                <a href="{{ aurl('/') }}"> {{ trans('admin.error_permission_5') }} </a>
                {{ trans('admin.error_permission_6') }} </p>

            </div>
        </div>
    </div>
</div>
<!-- END CONTENT BODY -->
@endsection