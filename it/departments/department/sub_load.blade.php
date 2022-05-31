@if(count($department) > 0)
<div class="form-group">
	<label class="col-md-3 control-label">{{trans('admin.sub_to')}}</label>
	<div class="col-md-9">
		<select name="parent" class="form-control checkparent">
			<option master="master" value="{{$parent}}" @if($parent == old('parent')) selected @endif >{{trans('admin.master_department')}}</option>
			@foreach($department as $dep)
			<option value="{{$dep->id}}" @if($parent == $dep->id) selected @endif >{{$dep->{'name_'.app('l')} }}</option>
			@endforeach
		</select>
	</div>
</div>
@endif