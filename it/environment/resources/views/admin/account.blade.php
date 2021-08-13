@extends('admin.index')
@section('content')
<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">{{!empty($title)?$title:''}}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['url'=>aurl('account'),'id'=>'account','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('name',trans('admin.name'),['class'=>'control-label']) !!}
                <div class="">
                    {!! Form::text('name',admin()->user()->name,['class'=>'form-control','placeholder'=>trans('admin.name')]) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('email',trans('admin.email'),['class'=>'control-label']) !!}
                <div class="">
                    {!! Form::text('email',admin()->user()->email,['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile">{{ trans('admin.photo_profile') }}</label>
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
                        <br />
                        @include('admin.show_image',['image'=>admin()->user()->photo_profile])
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('password',trans('admin.password'),['class'=>'control-label']) !!}
                <div class="">
                    {!! Form::password('password',['class'=>'form-control','placeholder'=>trans('admin.password')]) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('password_confirmation',trans('admin.password_confirmation'),['class'=>' control-label']) !!}
                <div class="">
                    {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>trans('admin.password_confirmation')]) !!}
                </div>
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