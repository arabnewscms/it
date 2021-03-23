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
					<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('admins/create')}}"
						data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.admins')}}">
						<i class="fa fa-plus"></i>
					</a>
					<span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.admins')}}">
						<a data-toggle="modal" data-target="#myModal{{$admins->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
							<i class="fa fa-trash"></i>
						</a>
					</span>
					<div class="modal fade" id="myModal{{$admins->id}}">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button class="close" data-dismiss="modal">x</button>
									<h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
								</div>
								<div class="modal-body">
									<i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$admins->id}}) ؟
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
					<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('admins')}}"
						data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.admins')}}">
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

					{!! Form::open(['url'=>aurl('/admins/'.$admins->id),'method'=>'put','id'=>'admins','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('name',trans('admin.name'),['class'=>'control-label']) !!}
							<div class="col-md-12">
								{!! Form::text('name', $admins->name ,['class'=>'form-control','placeholder'=>trans('admin.name')]) !!}
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('password',trans('admin.password'),['class'=>'control-label']) !!}
							<div class="col-md-12">
								{!! Form::password('password',['class'=>'form-control','placeholder'=>trans('admin.password')]) !!}
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('photo_profile',trans('admin.photo_profile'),['class'=>'control-label']) !!}
							<div class="col-md-12">
								<div class="col-md-9">
									{!! Form::file('photo_profile',['class'=>'form-control','placeholder'=>trans('admin.photo_profile')]) !!}
								</div>
								<div class="col-md-3">
									@include("admin.show_image",["image"=>$admins->photo_profile])
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('email',trans('admin.email'),['class'=>'control-label']) !!}
							<div class="col-md-12">
								{!! Form::email('email', $admins->email ,['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('group_id',trans('admin.group_id'),['class'=>'control-label']) !!}
							<div class="col-md-12">
								{!! Form::select('group_id',App\Models\AdminGroup::pluck('group_name','id'), $admins->group_id ,['class'=>'form-control','placeholder'=>trans('admin.group_id')]) !!}
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="col-md-9">
							{!! Form::submit(trans('admin.save'),['class'=>'btn btn-success']) !!}
						</div>
					</div>
					{!! Form::close() !!}
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
@endsection