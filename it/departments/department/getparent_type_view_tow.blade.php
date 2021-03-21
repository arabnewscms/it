<li class="list_department">
	<a href="{{url(app('admin').'/departments/'.$dep->id.'/edit')}}" class="btn btn-info btn-sm">{{trans('admin.edit')}}</a>
	{!! Form::open(['method'=>'delete','url'=>app('admin').'/departments/'.$dep->id,'style'=>'display:inline','class'=>'form'.$dep->id]) !!}
	<a href="#" class="btn btn-danger btn-sm delete_this" namedel="{{ $dep->{'name_'.app('l')} }}" formid="{{$dep->id}}">{{trans('admin.delete')}}</a>
	{!! Form::close() !!}
	@if(App\Model\Department::where('parent','=',$dep->id)->count() > 0)
	<a href="#collapse{{$dep->id}}" data-toggle="collapse" >  <i class="fa fa-arrow-left"></i>  {{ $dep->{'name_'.app('l')}  }}</a>
	<ol class="collapse"  id="collapse{{$dep->id}}">
		{!! App\Http\Controllers\Admin\Departments::get_parent($dep->id) !!}
	</ol>
	@else
	{{ $dep->{'name_'.app('l')}  }}
	@endif
</li>