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
					<a  href="{{aurl('admins')}}"
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

					{!! Form::open(['url'=>aurl('/admins'),'id'=>'admins','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('name',trans('admin.name'),['class'=>' control-label']) !!}
							<div class="col-md-12">
								{!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>trans('admin.name')]) !!}
							</div>
						</div>
					</div><div class="col-md-6">
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
							{!! Form::file('photo_profile',['class'=>'form-control','placeholder'=>trans('admin.photo_profile')]) !!}
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						{!! Form::label('email',trans('admin.email'),['class'=>'control-label']) !!}
						<div class="col-md-12">
							{!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						{!! Form::label('group_id',trans('admin.group_id'),['class'=>'control-label']) !!}
						<div class="col-md-12">
							{!! Form::select('group_id',App\Models\AdminGroup::pluck('group_name','id'),old('group_id'),['class'=>'form-control','placeholder'=>trans('admin.choose')]) !!}
						</div>
					</div>
				</div>
				<div class="form-actions">
					<div class="col-md-9">
						{!! Form::submit(trans('admin.add'),['class'=>'btn btn-success']) !!}
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