@extends('admin.index')
@section('content')
{!! Form::open(["method" => "post","url" => [aurl('/admins/multi_delete')]]) !!}
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
		<div class="row">
			<div class="table-responsive">
				{!! $dataTable->table(["class"=> "table table-striped table-bordered table-hover table-checkable dataTable no-footer"],true) !!}
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.card-body -->
	<div class="card-footer">
	</div>
</div>
<div class="modal fade" id="multi_delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">{{trans("admin.delete")}} </h4>
				<button class="close" data-dismiss="modal">x</button>
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
{!! Form::close() !!}

@push('js')
{!! $dataTable->scripts() !!}
@endpush

@endsection