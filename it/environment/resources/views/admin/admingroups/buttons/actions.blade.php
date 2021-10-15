<div class="btn-group">
	<button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i> {{ trans('admin.actions') }}</button>
	<span class="caret"></span>
	<span class="sr-only"></span>
	</button>
	<div class="dropdown-menu" role="menu">
		<a href="{{ aurl('/admingroups/'.$id.'/edit')}}" class="dropdown-item" ><i class="fas fa-edit"></i> {{trans('admin.edit')}}</a>
		<a href="{{ aurl('/admingroups/'.$id)}}" class="dropdown-item" ><i class="fa fa-eye"></i> {{trans('admin.show')}}</a>
		<div class="dropdown-divider"></div>
		<a data-toggle="modal" data-target="#delete_record{{$id}}" href="#" class="dropdown-item">
		<i class="fas fa-trash"></i> {{trans('admin.delete')}}</a>
	</div>
</div>
<div class="modal fade" id="delete_record{{$id}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">{{trans('admin.delete')}}</h4>
				<button class="close" data-dismiss="modal">x</button>
			</div>
			<div class="modal-body">
				<i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$id}})
			</div>
			<div class="modal-footer">
				{!! Form::open([
				'method' => 'DELETE',
				'route' => ['admingroups.destroy', $id]
				]) !!}
				{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger btn-flat']) !!}
				<a class="btn btn-default btn-flat" data-dismiss="modal">{{trans('admin.cancel')}}</a>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>