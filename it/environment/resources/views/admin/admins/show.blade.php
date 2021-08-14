@extends('admin.index')
@section('content')
<div class="card card-dark">
  <div class="card-header">
    <h3 class="card-title">
    <div class="">
      <a>{{!empty($title)?$title:''}}</a>
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <span class="caret"></span>
      <span class="sr-only"></span>
      </a>
      <div class="dropdown-menu" role="menu">
        <a href="{{aurl('admins')}}" class="dropdown-item" style="color:#343a40">
        <i class="fas fa-list"></i> {{trans('admin.show_all')}}</a>
        <a class="dropdown-item" style="color:#343a40" href="{{aurl('admins/'.$admins->id.'/edit')}}">
          <i class="fas fa-edit"></i> {{trans('admin.edit')}}
        </a>
        <a class="dropdown-item" style="color:#343a40" href="{{aurl('admins/create')}}">
          <i class="fas fa-plus"></i> {{trans('admin.create')}}
        </a>
        <div class="dropdown-divider"></div>
        <a data-toggle="modal" data-target="#deleteRecord{{$admins->id}}" class="dropdown-item" style="color:#343a40" href="#">
          <i class="fas fa-trash"></i> {{trans('admin.delete')}}
        </a>
      </div>
    </div>
    </h3>
    @push('js')
    <div class="modal fade" id="deleteRecord{{$admins->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{trans('admin.delete')}}</h4>
            <button class="close" data-dismiss="modal">x</button>
          </div>
          <div class="modal-body">
            <i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$admins->id}})
          </div>
          <div class="modal-footer">
            {!! Form::open([
            'method' => 'DELETE',
            'route' => ['admins.destroy', $admins->id]
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
      <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 col-lg-12 col-xs-12">
        <b>{{trans('admin.id')}} :</b> {{$admins->id}}
      </div>
      <div class="clearfix"></div>
      <hr />
      <div class="col-md-6 col-lg-6 col-xs-6">
        <b>{{trans('admin.name')}} :</b>
        {!! $admins->name !!}
      </div>
      <div class="col-md-6 col-lg-6 col-xs-6">
        <b>{{trans('admin.email')}} :</b>
        {!! $admins->email !!}
      </div>
      <div class="col-md-6 col-lg-6 col-xs-6">
        <b>{{trans('admin.photo_profile')}} :</b>
        @include("admin.show_image",["image"=>$admins->photo_profile])
      </div>
      <div class="col-md-6 col-lg-6 col-xs-6">
        <b>{{trans('admin.group_id')}} :</b>
        @if(!empty($admins->group_id()->first()))
        {{ $admins->group_id()->first()->group_name }}
        @endif
      </div>
      <!-- /.row -->
    </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
  </div>
</div>
@endsection