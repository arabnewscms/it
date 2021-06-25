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
					<a  href="{{aurl('admingroups')}}"
						class="btn btn-circle btn-icon-only btn-default"
						tooltip="{{trans('admin.show_all')}}"
						title="{{trans('admin.show_all')}}">
						<i class="fa fa-list"></i>
					</a>
					<a class="btn btn-circle btn-icon-only btn-default fullscreen"
						href="#"
						data-original-title="{{trans('admin.fullscreen')}}"
						title="{{trans('admin.fullscreen')}}">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="col-md-12">
					{!! Form::open(['url'=>aurl('/admingroups'),'id'=>'admingroups','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
					<div class="form-group">
						{!! Form::label('group_name',trans('admin.group_name'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::text('group_name',old('group_name'),['class'=>'form-control','placeholder'=>trans('admin.group_name')]) !!}
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
										permission_name="settings"
										name="settings_show"
										{{old('settings_show') == 'yes'?'checked':'' }}
										value="yes" />
									</td>
									<td>
									</td>
									<td>
										<input type="checkbox"
										class="checkinput settings_edit"
										permission_name="settings"
										name="settings_edit" {{old('settings_edit') == 'yes'?'checked':'' }} value="yes" />
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
										value="yes" />
									</td>
									<td>
										<input type="checkbox"
										class="checkinput {{ $perm }}_add"
										permission_name="{{ $perm }}"
										name="{{ $perm }}_add" {{old($perm.'_add') == 'yes'?'checked':'' }} value="yes" />
									</td>
									<td>
										<input type="checkbox"
										class="checkinput {{ $perm }}_edit"
										permission_name="{{ $perm }}"
										name="{{ $perm }}_edit" {{old($perm.'_edit') == 'yes'?'checked':'' }} value="yes" />
									</td>
									<td>
										<input type="checkbox"
										class="checkinput {{ $perm }}_delete"
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
										{!! Form::submit(trans('admin.add'),['class'=>'btn btn-success']) !!}
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