`
<div class="col-md-12 well">
	<div class="col-md-4">
		<div class="form-group">
			<label for="schema_name">{{it_trans('it.schema_name')}}</label>
			<div>
				<input type="text" name="schema_name[]" value="{{old('schema_name')}}" class="form-control schema_name" number="`+x2+`"  placeholder="{{it_trans('it.schema_name')}}" ><!--label> Null: <input type="checkbox" name="schema_null[]" value="1"></label-->
				<br><b>output relation like <br> <code>public function  <span class="funcname`+x2+`"></span>(){<br>return $this-><span class="typedata_relation`+x2+`">hasOne</span>(<span class="classSpace`+x2+`"></span>,"id","<span class="forginkey`+x2+`"></span>"); <br>}</code> </b>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="linkatmodel">{{it_trans('it.linkatmodel')}}</label>
			<div>
				<select name="linkatmodel[]" class="form-control linkatmodel" linkmod="`+x2+`">
					<option disabled selected>Select Model</option>
					<optgroup label="App">
						@foreach(array_filter(glob(app_path().'/*'), 'is_file') as $app_model_file)
						<?php
$app_model_file = explode('app', $app_model_file);
if (isset($app_model_file[2]) && !empty($app_model_file[2])) {
	$app_model_file = str_replace('.php', '::class', $app_model_file[2]);
} else {
	$app_model_file = str_replace('.php', '::class', $app_model_file[1]);
}
$app_model_file = str_replace('/', '\\\\', $app_model_file);
?>
						<option value="App\{{ $app_model_file }}">App\{{ $app_model_file }}</option>
						@endforeach
					</optgroup>
					@foreach(array_filter(glob(app_path().'/*'), 'is_dir') as $model_list)
					<?php
$data_ = explode('/', $model_list);
$explode_last = $data_[count($data_) - 1];
?>
					@if(!in_array($explode_last,['Console','Http','Handlers','DataTables','Exceptions','Mail','Providers']))
					<optgroup label="{{ $explode_last }}">
						@foreach(array_filter(glob($model_list.'/*'), 'is_file') as $app_model_file)
						<?php
$app_model_file = explode('app', $app_model_file);
if (isset($app_model_file[2]) && !empty($app_model_file[2])) {
	$app_model_file = str_replace('.php', '::class', $app_model_file[2]);
} else {
	$app_model_file = str_replace('.php', '::class', $app_model_file[1]);
}
$app_model_file = str_replace('/', '\\\\', $app_model_file);
?>
						<option value="App\{{ $app_model_file }}">App\{{ $app_model_file }}</option>
						@endforeach
					</optgroup>
					@endif
					@endforeach
				</select>
				<br><small>Example: Namespace/ExtraPath/ModelName</small>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="relation_type" >{{it_trans('it.relation_type')}}</label>
			<div>
				<select name="relation_type[]" class="form-control relation_type" linkmods="`+x2+`">
					<option value="hasOne">{{it_trans('it.hasone')}}</option>
					<option value="hasMany">{{it_trans('it.hasmany')}}</option>
					<option value="belongsToMany">{{it_trans('it.belongstomany')}}</option>
					<option value="hasManyThrough">{{it_trans('it.hasmanythrough')}}</option>
					<option value="belongsTo">{{it_trans('it.belongsto')}}</option>
					<option value="morphMap">{{it_trans('it.morphmap')}}</option>
					<option value="morphMany">{{it_trans('it.morphmany')}}</option>
				</select>
			</div>
		</div>
	</div>
	<a href="#" class="remove_field2 btn btn-danger"><i class="fa fa-trash"></i></a>
</div>
`