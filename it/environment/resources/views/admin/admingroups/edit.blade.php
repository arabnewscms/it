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
<div class="row">
	<div class="col-md-12">
		<div class="widget-extra body-req portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject bold uppercase font-dark">{{$title}}</span>
				</div>
				<div class="actions">
					<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('admingroups/create')}}"
						data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.admingroups')}}">
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
									<i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$admingroups->id}}) ؟
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
					<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('admingroups')}}"
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
					{!! Form::open(['url'=>aurl('/admingroups/'.$admingroups->id),'method'=>'put','id'=>'admingroups','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
					<div class="form-group">
						{!! Form::label('group_name',trans('admin.group_name'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::text('group_name', $admingroups->group_name ,['class'=>'form-control','placeholder'=>trans('admin.group_name')]) !!}
						</div>
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
									<input type="checkbox"
									class="checkinput settings_show"
									{{ checkPermissionGroup('settings_show',$admingroups)?'checked':'' }}
									permission_name="settings"
									name="settings_show"
									value="yes" />
								</td>
								<td>
								</td>
								<td>
									<input type="checkbox"
									{{ checkPermissionGroup('settings_edit',$admingroups)?'checked':'' }}
									class="checkinput settings_edit"
									permission_name="settings"
									name="settings_edit"   value="yes" />
								</td>
								<td>
								</td>
							</tr>
								@foreach(require app_path('Http/AdminRouteList.php') as $perm)
								<tr>
									<td>{{trans('admin.'.$perm)}}</td>
									<td>
										<input type="checkbox"
										class="checkinput {{ $perm }}_show"
										permission_name="{{ $perm }}"
										name="{{ $perm }}_show"
										{{old($perm.'_show') == 'yes'?'checked':'' }}
										{{ checkPermissionGroup($perm.'_show',$admingroups)?'checked':'' }}
										value="yes" />
									</td>
									<td>
										<input type="checkbox"
										class="checkinput {{ $perm }}_add"
										permission_name="{{ $perm }}"
										{{ checkPermissionGroup($perm.'_add',$admingroups)?'checked':'' }}
										name="{{ $perm }}_add" {{old($perm.'_add') == 'yes'?'checked':'' }} value="yes" />
									</td>
									<td>
										<input type="checkbox"
										class="checkinput {{ $perm }}_edit"
										permission_name="{{ $perm }}"
										{{ checkPermissionGroup($perm.'_edit',$admingroups)?'checked':'' }}
										name="{{ $perm }}_edit" {{old($perm.'_edit') == 'yes'?'checked':'' }} value="yes" />
									</td>
									<td>
										<input type="checkbox"
										class="checkinput {{ $perm }}_delete"
										{{ checkPermissionGroup($perm.'_delete',$admingroups)?'checked':'' }}
										permission_name="{{ $perm }}"
										name="{{ $perm }}_delete" {{old($perm.'_delete') == 'yes'?'checked':'' }} value="yes" />
									</td>
								</tr>
								@endforeach

						</tbody>
					</table>
				</div>
				<div class="clearfix"></div>
				<br>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									{!! Form::submit(trans('admin.save'),['class'=>'btn btn-success']) !!}
								</div>
							</div>
						</div>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
</div>
@stop