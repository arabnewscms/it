
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<!-- Main Sidebar Menu Container -->




<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                  <ol class="breadcrumb {{ app('l') == 'ar'?'float-sm-right':'float-sm-left' }}">
                    @if(!empty(request()->segment(2)))
                    <li class="breadcrumb-item"><a href="{{aurl('/')}}">{{trans('admin.dashboard')}}</a></li>
                    <li class="breadcrumb-item active"><a href="{{aurl(request()->segment(2))}}">{{trans('admin.'.request()->segment(2))}}</a></li>
                    @endif
                  </ol>
                  </div><!-- /.col -->
              <div class="col-sm-12">
                <h1 class="m-0">{{!empty($title)?$title:''}}</h1>
                </div><!-- /.col -->

                  </div><!-- /.row -->
                  </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                  <div class="container-fluid">

@push('js')
<script type="text/javascript">
$(document).ready(function(){
 const Sweet = Swal.mixin({
      //input: 'text',
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 10000,
      timerProgressBar: true,
    });

    @if(session()->has('error'))
      Sweet.fire({
        icon: 'error',
        type: 'error',
        title: ' {{ trans('admin.alert') }} :',
        text: ' {{ session('error') }} '
      });
    @endif

    @if(session()->has('success'))
      Sweet.fire({
        icon: 'success',
        type: 'success',
        title: ' {{ trans('admin.success') }} :',
        text: ' {{ session('success') }} '
      });
    @endif
});
</script>
@endpush

                   {{--  @if(session()->has('error'))
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h6><i class="icon fas fa-exclamation-triangle"></i> {{ trans('admin.alert') }}!</h6>
                        {{ session('error') }}
                    </div>
                    @endif

                     @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h6><i class="icon fas fa-check"></i> {{ trans('admin.success') }}</h6>
                        {{ session('success') }}
                    </div>
                    @endif --}}

@if(count($errors->all()) > 0)
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h6><i class="icon fas fa-exclamation-triangle"></i> {{ trans('admin.alert') }}!</h6>
 <ol>
    @foreach($errors->all() as $error)
     <li>{{ $error }}</li>
    @endforeach
 </ol>
</div>
@endif