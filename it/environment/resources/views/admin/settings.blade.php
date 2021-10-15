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
        {!! Form::open(['url'=>aurl('/settings'),'id'=>'settings','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('sitename_ar',trans('admin.sitename_ar'),['class'=>'control-label']) !!}
                {!! Form::text('sitename_ar',setting()->sitename_ar,['class'=>'form-control','placeholder'=>trans('admin.sitename_ar')]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('sitename_en',trans('admin.sitename_en'),['class'=>'control-label']) !!}
                {!! Form::text('sitename_en',setting()->sitename_en,['class'=>'form-control','placeholder'=>trans('admin.sitename_en')]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('sitename_fr',trans('admin.sitename_fr'),['class'=>'control-label']) !!}
                {!! Form::text('sitename_fr',setting()->sitename_fr,['class'=>'form-control','placeholder'=>trans('admin.sitename_fr')]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('email',trans('admin.email'),['class'=>'control-label']) !!}
                {!! Form::text('email',setting()->email,['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="exampleInputFile">{{ trans('admin.logo') }}</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    {!! Form::file('logo',['class'=>'custom-file-input','placeholder'=>trans('admin.logo')]) !!}
                                    {!! Form::label('logo',trans('admin.logo'),['class'=>'custom-file-label']) !!}
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">{{ trans('admin.upload') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <br />
                        @include('admin.show_image',['image'=>setting()->logo])
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="exampleInputFile">{{ trans('admin.icon') }}</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    {!! Form::file('icon',['class'=>'custom-file-input','placeholder'=>trans('admin.icon')]) !!}
                                    {!! Form::label('icon',trans('admin.icon'),['class'=>'custom-file-label']) !!}
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">{{ trans('admin.upload') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <br />
                        @include('admin.show_image',['image'=>setting()->icon])
                    </div>
                </div>
            </div>
            <div class="form-group col-md-12">
                {!! Form::label('system_status',trans('admin.system_status'),['class'=>'control-label']) !!}
                {!! Form::select('system_status',['open'=>trans('admin.open'),'close'=>trans('admin.close')],setting()->system_status,['class'=>'form-control','placeholder'=>trans('admin.system_status')]) !!}
            </div>
            <div class="form-group col-md-12">
                {!! Form::label('system_message',trans('admin.system_message'),['class'=>'control-label']) !!}
                {!! Form::textarea('system_message',setting()->system_message,['class'=>'form-control','placeholder'=>trans('admin.system_message')]) !!}
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