@extends('admin.index')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="widget-extra body-req portlet light bordered">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
        </div>
        <div class="actions">
          <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('admingroups/create')}}"
            data-toggle="tooltip" title="{{trans('admin.admingroups')}}">
            <i class="fa fa-plus"></i>
          </a>
          <span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.admingroups')}}">
            <a data-toggle="modal" data-target="#myModal{{$admingroups->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
              <i class="fa fa-trash"></i>
            </a>
          </span>
          <div class="modal fade" id="myModal{{$admingroups->id}}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">x</button>
                  <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                </div>
                <div class="modal-body">
                  {{trans('admin.ask_del')}} {{trans('admin.id')}} {{$admingroups->id}} ؟
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
          <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/admingroups')}}"
            data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.admingroups')}}">
            <i class="fa fa-list"></i>
          </a>
          <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
            data-original-title="{{trans('admin.fullscreen')}}"
            title="{{trans('admin.fullscreen')}}">
          </a>
        </div>
      </div>
      <div class="portlet-body form">
        <div class="col-md-12">
          <div class="col-md-12 col-lg-12 col-xs-12">
            <b>{{trans('admin.id')}} :</b> {{$admingroups->id}}
          </div>
          <div class="clearfix"></div>
          <hr />
          @if(!empty($admingroups->admin_id()->first()))
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.admin_id')}} :</b>
            {{ $admingroups->admin_id()->first()->name }}
          </div>
          @endif
          <div class="col-md-4 col-lg-4 col-xs-4">
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
          <br>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
@stop