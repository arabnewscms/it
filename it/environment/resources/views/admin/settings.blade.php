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
                    <a  href="{{aurl('settings')}}"
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
                    {!! Form::open(['url'=>aurl('/settings'),'id'=>'settings','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
                    <div class="form-group">
                        {!! Form::label('sitename_ar',trans('admin.sitename_ar'),['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('sitename_ar',setting()->sitename_ar,['class'=>'form-control','placeholder'=>trans('admin.sitename_ar')]) !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        {!! Form::label('sitename_en',trans('admin.sitename_en'),['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('sitename_en',setting()->sitename_en,['class'=>'form-control','placeholder'=>trans('admin.sitename_en')]) !!}
                        </div>
                    </div>
                    <br>
                     <div class="form-group">
                        {!! Form::label('sitename_fr',trans('admin.sitename_fr'),['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('sitename_fr',setting()->sitename_fr,['class'=>'form-control','placeholder'=>trans('admin.sitename_fr')]) !!}
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        {!! Form::label('email',trans('admin.email'),['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('email',setting()->email,['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group col-md-6 col-lg-6">
                        {!! Form::label('logo',trans('admin.logo'),['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::file('logo',['class'=>'form-control','placeholder'=>trans('admin.logo')]) !!}
                            @if(!empty(setting()->logo))
                             <img src="{{ it()->url(setting()->logo) }}" style="width:50px;height:50px" />
                            @endif
                        </div>
                    </div>

                     <div class="form-group col-md-6 col-lg-6">
                        {!! Form::label('icon',trans('admin.icon'),['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::file('icon',['class'=>'form-control','placeholder'=>trans('admin.icon')]) !!}
                            @if(!empty(setting()->icon))
                             <img src="{{ it()->url(setting()->icon) }}" style="width:50px;height:50px" />
                            @endif
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <br>
                      <div class="form-group">
                        {!! Form::label('system_status',trans('admin.system_status'),['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::select('system_status',['open'=>trans('admin.open'),'close'=>trans('admin.close')],setting()->system_status,['class'=>'form-control','placeholder'=>trans('admin.system_status')]) !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        {!! Form::label('system_message',trans('admin.system_message'),['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('system_message',setting()->system_message,['class'=>'form-control','placeholder'=>trans('admin.system_message')]) !!}
                        </div>
                    </div>
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