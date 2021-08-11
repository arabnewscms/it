@extends('admin.index')
@section('content')
<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">
    <div class="btn-group">
      <button type="button" class="btn btn-default">{{!empty($title)?$title:''}}</button>
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
      <span class="caret"></span>
      <span class="sr-only"></span>
      </button>
      <div class="dropdown-menu" role="menu">
        <a href="{{aurl('admingroups')}}" class="dropdown-item">
        <i class="fas fa-list"></i> {{trans('admin.show_all')}}</a>
        <a class="dropdown-item" href="{{aurl('admingroups/'.$admingroups->id.'/edit')}}">
          <i class="fas fa-edit"></i> {{trans('admin.edit')}}
        </a>
        <a class="dropdown-item" href="{{aurl('admingroups/create')}}">
          <i class="fas fa-plus"></i> {{trans('admin.create')}}
        </a>
        <div class="dropdown-divider"></div>
        <a data-toggle="modal" data-target="#deleteRecord{{$admingroups->id}}" class="dropdown-item" href="">
          <i class="fas fa-trash"></i> {{trans('admin.delete')}}
        </a>
      </div>
    </div>
    </h3>
    @push('js')
    <div class="modal fade" id="deleteRecord{{$admingroups->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{trans('admin.delete')}}</h4>
            <button class="close" data-dismiss="modal">x</button>
          </div>
          <div class="modal-body">
            <i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$admingroups->id}})
          </div>
          <div class="modal-footer">
            {!! Form::open([
            'method' => 'DELETE',
            'route' => ['admingroups.destroy', $admingroups->id]
            ]) !!}
            {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
            <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    @endpush
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="row">
      <div class="col-md-6 col-lg-6 col-xs-6">
        <b>{{trans('admin.id')}} :</b> {{$admingroups->id}}
      </div>
      @if(!empty($admingroups->admin_id()->first()))
      <div class="col-md-6 col-lg-6 col-xs-6">
        <b>{{trans('admin.admin_id')}} :</b>
        {{ $admingroups->admin_id()->first()->name }}
      </div>
      @endif
      <div class="clearfix"></div>
      <hr />
      <div class="col-md-12 col-lg-12 col-xs-12">
        <b>{{trans('admin.group_name')}} :</b>
        {!! $admingroups->group_name !!}
      </div>
      <div class="clearfix"></div>
      <hr />
      <table class="table table-striped table-hover  ">
        <thead>
          <tr>
            <th>{{trans('admin.name')}}</th>
            <th>{{trans('admin.show')}}</th>
            <th>{{trans('admin.create')}}</th>
            <th>{{trans('admin.edit')}}</th>
            <th>{{trans('admin.delete')}}</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{trans('admin.settings')}}</td>
            <td>
              <i class="fa {{ checkPermissionGroup('settings_show',$admingroups)?'fa-check':'fa-times' }}"></i>
            </td>
            <td><i class="fa fa-times"></i></td>
            <td>
              <i class="fa {{ checkPermissionGroup('settings_edit',$admingroups)?'fa-check':'fa-times' }}"></i>
            </td>
            <td><i class="fa fa-times"></i></td>
          </tr>
          @foreach(require app_path('Http/AdminRouteList.php') as $perm)
          <tr>
            <td>{{trans('admin.'.$perm)}}</td>
            <td>
              <i class="fa {{ checkPermissionGroup($perm.'_show',$admingroups)?'fa-check':'fa-times' }}"></i>
            </td>
            <td>
              <i class="fa {{ checkPermissionGroup($perm.'_add',$admingroups)?'fa-check':'fa-times' }}"></i>
            </td>
            <td>
              <i class="fa {{ checkPermissionGroup($perm.'_edit',$admingroups)?'fa-check':'fa-times' }}"></i>
            </td>
            <td>
              <i class="fa {{ checkPermissionGroup($perm.'_delete',$admingroups)?'fa-check':'fa-times' }}"></i>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
  </div>
</div>
@endsection