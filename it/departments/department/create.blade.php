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
				{!! Form::open(['url'=>aurl('departments'),'files'=>true,'role'=>'form']) !!}
				<div class="form-body">
					@foreach(L::all() as $lang)
					<div class="form-group">
						{!! Form::label('name_'.$lang,trans('admin.name_'.$lang),['class'=>'control-label']) !!}
						{!! Form::text('name_'.$lang,old('name_'.$lang),['class'=>'form-control','placeholder'=>trans('admin.name_'.$lang)]) !!}
					</div>
					@endforeach
					<div class="form-group">
						{!! Form::label('icon',trans('admin.dep_icon'),['class'=>'control-label']) !!}
						{!! Form::file('icon',old('icon'),['class'=>'form-control','placeholder'=>trans('admin.dep_icon')]) !!}
					</div>
					@if(count($department) > 0)
					@push('js')
					<script type="text/javascript">
									$(document).on('change','.checkparent',function(){
										var parent = $('option:selected',this).val();
										var master = $('option:selected',this).attr('master');
												if(parent == '' || parent == null || master == 'master')
												{
													$('.result').empty();
												}else{
													$.ajax({
														url:'{{aurl('departments/check/parent')}}',
														type:'post',
														dataType:'json',
														data:{parent:parent,'_token':'{!! csrf_token() !!}'},
														beforeSend: function()
														{
															$('.spin_dep').removeClass('hidden');
														},success: function(data)
														{
															if(data != 'false')
															{
															$('.result').append(data);
															}
															$('.spin_dep').addClass('hidden');
														},error: function()
														{
															$('.spin_dep').addClass('hidden');
														}
													});
												}
									});
					</script>
					@endpush
					<div class="form-group">
						{!! Form::label('sub_to',trans('admin.sub_to'),['class'=>'control-label col-md-3']) !!}
						<div class="col-md-9">

						{!! Form::select('parent',$department,old('parent'),['class'=>'form-control checkparent','placeholder'=>trans('admin.master_department')]) !!}
						</div>
					</div>
					@endif
					<div class="clearfix"></div>
					<div class="result"></div>
					<p><i class="fa fa-spinner fa-spin fa-2x hidden spin_dep"></i></p>
					<footer>
						<button type="submit" class="btn btn-primary">
						{{trans('admin.add')}}
						</button>
					</footer>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop