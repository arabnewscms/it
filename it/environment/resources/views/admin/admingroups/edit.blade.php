@extends('admin.index')
@section('content')
@push('js')
<script type="text/javascript">
$(document).ready(function(){
$(document).on('click','.checkinput',function(){
	var permission_name = $(this).attr('permission_name');
	if($('.'+permission_name+'_validation').prop("checked") &&
	$(this).hasClass(permission_name+'_validation')){
		$('.'+permission_name+'_show').prop('checked',true);
		$('.'+permission_name+'_add').prop('checked',true);
		$('.'+permission_name+'_edit').prop('checked',true);
		$('.'+permission_name+'_delete').prop('checked',true);
	}else if(
		!$('.'+permission_name+'_validation').prop("checked") &&
		$(this).hasClass(permission_name+'_validation')){
		$('.'+permission_name+'_show').prop('checked',false);
		$('.'+permission_name+'_add').prop('checked',false);
		$('.'+permission_name+'_edit').prop('checked',false);
		$('.'+permission_name+'_delete').prop('checked',false);
	}else if(!$(this).hasClass(permission_name+'_show') && !$(this).hasClass(permission_name+'_show') && $(this).prop("checked")){
	$('.'+permission_name+'_show').prop('checked',true);
	}else if(
		!$('.'+permission_name+'_add').prop("checked") &&
		!$('.'+permission_name+'_edit').prop("checked") &&
		!$('.'+permission_name+'_delete').prop("checked") &&
		!$('.'+permission_name+'_validation').prop("checked") &&
		!$(this).hasClass(permission_name+'_show')){
		$('.'+permission_name+'_show').prop('checked',false);
	}
});
});
</script>
@endpush
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
				<a class="dropdown-item" href="{{aurl('admingroups/create')}}">
					<i class="fa fa-plus"></i> {{trans('admin.create')}}
				</a>
				<div class="dropdown-divider"></div>
				<a data-toggle="modal" data-target="#deleteRecord{{$admingroups->id}}" class="dropdown-item" href="">
					<i class="fa fa-trash"></i> {{trans('admin.delete')}}
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
		</a>
	</div>
</div>
<!-- /.card-header -->
<div class="card-body">
		{!! Form::open(['url'=>aurl('/admingroups/'.$admingroups->id),'method'=>'put','id'=>'admingroups','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
	<div class="row">
		<div class="form-group col-md-12">
			{!! Form::label('group_name',trans('admin.group_name'),['class'=>'control-label']) !!}
			{!! Form::text('group_name',$admingroups->group_name,['class'=>'form-control','placeholder'=>trans('admin.group_name')]) !!}
		</div>
		<div class="col-md-12 col-lg-12">
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
							<div class="form-group">
								<div class="custom-control custom-switch">
									<input
									type="checkbox"
									class="custom-control-input checkinput settings_show"
									permission_name="settings"
									name="settings_show"
									{{ checkPermissionGroup('settings_show',$admingroups)?'checked':'' }}
									value="yes"
									id="settings_show">
									<label class="custom-control-label" for="settings_show"></label>
								</div>
							</div>
						</td>
						<td>
						</td>
						<td>
							<div class="form-group">
								<div class="custom-control custom-switch">
									<input
									type="checkbox"
									class="custom-control-input checkinput settings_edit"
									permission_name="settings"
									name="settings_edit"
									{{ checkPermissionGroup('settings_edit',$admingroups)?'checked':'' }}
									value="yes"
									id="settings_edit">
									<label class="custom-control-label" for="settings_edit"></label>
								</div>
							</div>
						</td>
						<td>
						</td>
					</tr>
					@foreach(require app_path('Http/AdminRouteList.php') as $perm)
					<tr>
						<td>{{trans('admin.'.$perm)}}</td>
						<td>
							<div class="form-group">
								<div class="custom-control custom-switch">
									<input
									type="checkbox"
									class="custom-control-input checkinput {{ $perm }}_show"
									permission_name="{{ $perm }}"
									name="{{ $perm }}_show"
									{{ checkPermissionGroup($perm.'_show',$admingroups)?'checked':'' }}
									value="yes"
									id="{{ $perm }}_show">
									<label class="custom-control-label" for="{{ $perm }}_show"></label>
								</div>
							</div>
						</td>
						<td>
							<div class="form-group">
								<div class="custom-control custom-switch">
									<input
									type="checkbox"
									class="custom-control-input checkinput {{ $perm }}_add"
									permission_name="{{ $perm }}"
									name="{{ $perm }}_add"
									{{ checkPermissionGroup($perm.'_add',$admingroups)?'checked':'' }}
									value="yes"
									id="{{ $perm }}_add">
									<label class="custom-control-label" for="{{ $perm }}_add"></label>
								</div>
							</div>
						</td>
						<td>
							<div class="form-group">
								<div class="custom-control custom-switch">
									<input
									type="checkbox"
									class="custom-control-input checkinput {{ $perm }}_edit"
									permission_name="{{ $perm }}"
									name="{{ $perm }}_edit"
									{{ checkPermissionGroup($perm.'_edit',$admingroups)?'checked':'' }}
									value="yes"
									id="{{ $perm }}_edit">
									<label class="custom-control-label" for="{{ $perm }}_edit"></label>
								</div>
							</div>
						</td>
						<td>
							<div class="form-group">
								<div class="custom-control custom-switch">
									<input
									type="checkbox"
									class="custom-control-input checkinput {{ $perm }}_delete"
									permission_name="{{ $perm }}"
									name="{{ $perm }}_delete"
									{{ checkPermissionGroup($perm.'_delete',$admingroups)?'checked':'' }}
									value="yes"
									id="{{ $perm }}_delete">
									<label class="custom-control-label" for="{{ $perm }}_delete"></label>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- /.row -->
</div>
<!-- /.card-body -->
<div class="card-footer">
	{!! Form::submit(trans('admin.save'),['class'=>'btn btn-success btn-flat']) !!}
	{!! Form::close() !!}
</div>
</div>
@endsection