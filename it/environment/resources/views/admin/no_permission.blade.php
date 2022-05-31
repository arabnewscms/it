@extends('admin.index')
@section('content')
<div class="error-page">
    <h2 class="headline text-info">403</h2>
    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-info"></i> {{ trans('admin.error_permission_1') }}</h3>
        <p>
          {{ trans('admin.error_permission_2') }}
        </p>
         <p> {{ trans('admin.error_permission_4') }}
                <br/>
                <a href="{{ aurl('/') }}"> {{ trans('admin.error_permission_5') }} </a>
            {{ trans('admin.error_permission_6') }} </p>

    </div>
</div>
<!-- /.error-page -->
@endsection