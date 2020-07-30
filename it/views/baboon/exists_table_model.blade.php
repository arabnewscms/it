<select name="exists_table0" class="form-control exists_table" linkmod="'+x2+'">
	<option value="">without check Exist</option>
	<optgroup label="App">
		@foreach(array_filter(glob(app_path().'/*'), 'is_file') as $app_model_file)
<?php
$app_model_file = explode('app', $app_model_file);
$app_model_file = str_replace('.php', '', $app_model_file[1]);
$app_model_file = str_replace('/', '\\', $app_model_file);
?>
<option value="App{{ $app_model_file }}">App{{ $app_model_file }}</option>
		@endforeach
	</optgroup>
	@foreach(array_filter(glob(app_path().'/*'), 'is_dir') as $model_list)
<?php
$data_        = explode('/', $model_list);
$explode_last = $data_[count($data_)-1];
?>
@if(!in_array($explode_last,['Console','Http','Handlers','DataTables','Exceptions','Mail','Providers']))
	<optgroup label="{{ $explode_last }}">
		@foreach(array_filter(glob($model_list.'/*'), 'is_file') as $app_model_file)
<?php
$app_model_file = explode('app', $app_model_file);
$app_model_file = str_replace('.php', '', $app_model_file[1]);
$app_model_file = str_replace('/', '\\', $app_model_file);
?>
		<option value="App{{ $app_model_file }}">App{{ $app_model_file }}</option>
		@endforeach
	</optgroup>
	@endif
	@endforeach
</select>