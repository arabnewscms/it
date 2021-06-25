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
				<div class="table-responsive">
					{!! Form::open([
					"method" => "post",
					"url" => [aurl('/admingroups/multi_delete')]
					]) !!}
					{!! $dataTable->table(["class"=> "table table-striped table-bordered table-hover table-checkable dataTable no-footer"],true) !!}
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="multi_delete">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">x</button>
					<h4 class="modal-title">{{trans("admin.delete")}} </h4>
				</div>
				<div class="modal-body">
					<div class="delete_done"><i class="fa fa-exclamation-triangle"></i> {{trans("admin.ask-delete")}} <span id="count"></span> {{trans("admin.record")}} ! </div>
					<div class="check_delete">{{trans("admin.check-delete")}}</div>
				</div>
				<div class="modal-footer">
					{!! Form::submit(trans("admin.approval"), ["class" => "btn btn-danger delete_done"]) !!}
					<a class="btn btn-default" data-dismiss="modal">{{trans("admin.cancel")}}</a>
				</div>
			</div>
		</div>
	</div>
</div>
@push('js')
{!! $dataTable->scripts() !!}
@endpush
{!! Form::close() !!}
@endsection