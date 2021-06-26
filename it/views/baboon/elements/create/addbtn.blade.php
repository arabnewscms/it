<?php
$input = '';
if (request('use_collective') == 'yes') {
	$input .= '<div class="form-actions">
	<div class="col-md-9">' . "\n";
	$input .= '<button type="submit" name="add" class="btn btn-primary"><i class="fa fa-plus"></i> {{ trans(\'{lang}.add\') }}</button>' . "\n";
	$input .= '<button type="submit" name="add_back" class="btn btn-success"><i class="fa fa-plus"></i> {{ trans(\'{lang}.add_back\') }}</button>' . "\n";
	$input .= '         </div>
</div>' . "\n";
	$input .= '{!! Form::close() !!}';
	$input = str_replace('{lang}', request('lang_file'), $input);
} else {
	$input .= '<div class="form-actions">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">' . "\n";
	$input .= '<button type="submit" name="add" class="btn btn-primary"><i class="fa fa-plus"></i> {{ trans(\'{lang}.add\') }}</button>' . "\n";
	$input .= '<button type="submit" name="add_back" class="btn btn-success"><i class="fa fa-plus"></i> {{ trans(\'{lang}.add_back\') }}</button>' . "\n";
	$input .= '         </div>
			</div>
		</div>
	</div>
</div>' . "\n";
	$input = str_replace('{lang}', request('lang_file'), $input);
	$input .= '</form>';
}
echo $input;
?>