@extends('admin.index')
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject bold uppercase font-dark">{{$title}}</span>
				</div>
			</div>
			<div class="portlet-body">
		<!--begin: Datatable -->
		<a href="{{url(app('admin').'/departments/create')}}" class="btn btn-info">{{trans('admin.add')}}</a>
		<hr />
		<a href="{{url(app('admin').'/departments')}}?type_view=one" class="btn btn-info">{{trans('admin.view_one')}}
			<i class="fa fa-table"></i>
		</a>
		<a href="{{url(app('admin').'/departments')}}?type_view=tow" class="btn btn-info">{{trans('admin.view_tow')}} <i class="fa fa-list"></i> </a>
		<hr />
		@if(Request::get('type_view')=='one' || !Request::has('type_view'))
		<table class="table table-striped table-bordered table-hovered">
			<tr>
				<td>{{ trans('admin.name_'.app('l')) }}</td>
				<td>{{trans('admin.action')}}</td>
			</tr>
			@foreach($alldep as $dep)
			<tr>
				<td>
					@if(App\Model\Department::where('parent','=',$dep->id)->count() > 0)
					<a href="{{url(app('admin').'/departments?department='.$dep->id)}}">{{ $dep->{'name_'.app('l')}   }}</a>
					@else
					{{ $dep->{'name_'.app('l')}   }}
					@endif
				</td>
				<td>
					<a href="{{url(app('admin').'/departments/'.$dep->id.'/edit')}}" class="btn btn-info btn-sm">{{trans('admin.edit')}}</a>
					{!! Form::open(['method'=>'delete','url'=>app('admin').'/departments/'.$dep->id,'style'=>'display:inline','class'=>'form'.$dep->id]) !!}
					<a href="#" class="btn btn-danger delete_this btn-sm" namedel="{{$dep->{'name_'.app('l')}  }}"  formid="{{$dep->id}}" >{{trans('admin.delete')}}</a>
					{!! Form::close() !!}
				</td>
			</tr>
			@endforeach
		</table>
		@elseif(Request::get('type_view')=='tow')
		<style type="text/css">
		.list_department{
			padding: 15px;
		}
		</style>
		<ol class="">
			@foreach($alldep as $dep)
			<li class="list_department">
				{!! Form::open(['method'=>'delete','url'=>app('admin').'/departments/'.$dep->id,'style'=>'display:inline','class'=>'form'.$dep->id]) !!}
				<a href="{{url(app('admin').'/departments/'.$dep->id.'/edit')}}" class="btn btn-info btn-sm">{{trans('admin.edit')}}</a>
				<a href="#" class="btn btn-danger delete_this btn-sm" namedel="{{$dep->{'name_'.app('l')}  }}" formid="{{$dep->id}}">{{trans('admin.delete')}}</a>
				{!! Form::close() !!}

				@if(App\Model\Department::where('parent','=',$dep->id)->count() > 0)
				<a href="#collapse{{$dep->id}}" data-toggle="collapse" > <i class="fa fa-arrow-left"></i> {{ $dep->{'name_'.app('l')}   }}</a>
				<ol class="collapse"  id="collapse{{$dep->id}}">
					{!! App\Http\Controllers\Admin\Departments::get_parent($dep->id) !!}
				</ol>
				@else
				{{ $dep->{'name_'.app('l')}   }}
				@endif

			</li>
			@endforeach
		</ol>
		@endif
		{!! $alldep->appends(['type_view'=>Request::get('type_view')])->render(); !!}
		</div>
		</div>
	</div>
</div>
@stop