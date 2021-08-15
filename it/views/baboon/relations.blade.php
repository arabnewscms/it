<div class="input_fields_wrap2">
	@if(!empty($module_data) && count($module_data->relations) > 0)
	@php
	$x = 0;
	@endphp
	@foreach($module_data->relations as $relation)
	<div class="col-md-12 well">
		<div class="col-md-4">
			<div class="form-group">
				<label for="schema_name">{{it_trans('it.schema_name')}}</label>
				<div>
					<input type="text" name="schema_name[]"  value="{{ $relation->schema_name }}" class="form-control schema_name" number="{{ $x }}"  placeholder="{{it_trans('it.schema_name')}}" >
					<!--label> Null: <input type="checkbox" name="schema_null[]" value="1"></label-->
					<br><b>output relation like <br> <code>public function  <span class="funcname{{ $x }}">{{ $relation->schema_name }}</span>(){<br>return $this-><span class="typedata_relation{{ $x }}">{{ $relation->relation_type }}</span>(<span class="classSpace{{ $x }}">\{{ $relation->linkatmodel }}</span>,"id","<span class="forginkey{{ $x }}">{{ $relation->schema_name }}</span>"); <br>}</code> </b>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="linkatmodel">{{it_trans('it.linkatmodel')}}</label>
				<div>
					<select name="linkatmodel[]" class="form-control linkatmodel" linkmod="{{ $x }}">
						<option disabled selected>Select Model</option>
						<optgroup label="App">
							@foreach(array_filter(glob(app_path().'/*'), 'is_file') as $app_model_file)
							<?php
$app_model_file = explode('app', $app_model_file);
$app_model_file = str_replace('.php', '::class', $app_model_file[1]);
$app_model_file = str_replace('/', '\\\\', $app_model_file);
$app_model_file = str_replace('\\\\', '\\', $app_model_file);
?>
							<option value="App{{ $app_model_file }}"
								{{ $relation->linkatmodel == 'App'.$app_model_file?'selected':'' }}
							>App{{ $app_model_file }}</option>
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
$app_model_file = str_replace('.php', '::class', $app_model_file[1]);
$app_model_file = str_replace('/', '\\', $app_model_file);
$app_model_file = str_replace('\\\\', '\\', $app_model_file);
?>
							<option value="App{{ $app_model_file }}"
								{{ $relation->linkatmodel == 'App'.$app_model_file?'selected':'' }}
							>App{{ $app_model_file }}</option>
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
					<select name="relation_type[]" class="form-control relation_type" linkmods="{{ $x }}">
						<option {{ $relation->relation_type == 'hasOne'?'selected':''}} value="hasOne">{{it_trans('it.hasone')}}</option>
						<option {{ $relation->relation_type == 'hasMany'?'selected':''}} value="hasMany">{{it_trans('it.hasmany')}}</option>
						<option {{ $relation->relation_type == 'belongsToMany'?'selected':''}} value="belongsToMany">{{it_trans('it.belongstomany')}}</option>
						<option {{ $relation->relation_type == 'hasManyThrough'?'selected':''}} value="hasManyThrough">{{it_trans('it.hasmanythrough')}}</option>
						<option {{ $relation->relation_type == 'belongsTo'?'selected':''}} value="belongsTo">{{it_trans('it.belongsto')}}</option>
						<option {{ $relation->relation_type == 'morphMap'?'selected':''}} value="morphMap">{{it_trans('it.morphmap')}}</option>
						<option {{ $relation->relation_type == 'morphMany'?'selected':''}} value="morphMany">{{it_trans('it.morphmany')}}</option>
					</select>
				</div>
			</div>
		</div>
		<a href="#" class="remove_field2 btn btn-danger"><i class="fa fa-trash"></i></a>
	</div>
	@php
	$x++;
	@endphp
	@endforeach
	@endif
</div>
<br>
<div class="col-offset-left-2">
	<button class="add_field_button2 btn btn-success" style="background: #090">Add Relation Column DB <i class="fa fa-database"></i></button>
</div>
<br>