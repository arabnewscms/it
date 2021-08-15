@extends('admin.index')
@section('content')
<div class="card card-dark">
	<div class="card-header">
		<h3 class="card-title">
		<div class="">
			<a>
			{{ !empty($title)?$title:'' }}
			</a>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
			<span class="sr-only"></span>
			</a>
			<div class="dropdown-menu" role="menu">
				<a href="{{aurl('admins')}}" class="dropdown-item" style="color:#343a40">
				<i class="fas fa-list"></i> {{trans('admin.show_all')}}</a>
			</div>
		</div>
		</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
		</div>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
			{!! Form::open(['url'=>aurl('/admins'),'id'=>'admins','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('name',trans('admin.name'),['class'=>' control-label']) !!}
					{!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>trans('admin.name')]) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('password',trans('admin.password'),['class'=>'control-label']) !!}
					{!! Form::password('password',['class'=>'form-control','placeholder'=>trans('admin.password')]) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="photo_profile">{{ trans('admin.photo_profile') }}</label>
					<div class="input-group">
						<div class="custom-file">
							{!! Form::file('photo_profile',['class'=>'custom-file-input','placeholder'=>trans('admin.photo_profile')]) !!}
							{!! Form::label('photo_profile',trans('admin.photo_profile'),['class'=>'custom-file-label']) !!}
						</div>
						<div class="input-group-append">
							<span class="input-group-text" id="">{{ trans('admin.upload') }}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('email',trans('admin.email'),['class'=>'control-label']) !!}
					{!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('group_id',trans('admin.group_id'),['class'=>'control-label']) !!}
					{!! Form::select('group_id',App\Models\AdminGroup::pluck('group_name','id'),old('group_id'),['class'=>'form-control select2','placeholder'=>trans('admin.choose')]) !!}
				</div>
			</div>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.card-body -->
	<div class="card-footer">
		{!! Form::submit(trans('admin.add'),['class'=>'btn btn-success btn-flat']) !!}
		{!! Form::close() !!}
	</div>
</div>
@endsection