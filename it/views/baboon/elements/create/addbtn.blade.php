<?php
$input = '';
if (request('use_collective') == 'yes') {
	$input .= '<button type="submit" name="add" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> {{ trans(\'{lang}.add\') }}</button>' . "\n";
	$input .= '<button type="submit" name="add_back" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> {{ trans(\'{lang}.add_back\') }}</button>' . "\n";
	$input .= '{!! Form::close() !!}';
	$input = str_replace('{lang}', request('lang_file'), $input);
} else {
	$input .= '<button type="submit" name="add" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> {{ trans(\'{lang}.add\') }}</button>' . "\n";
	$input .= '<button type="submit" name="add_back" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> {{ trans(\'{lang}.add_back\') }}</button>' . "\n";
	$input = str_replace('{lang}', request('lang_file'), $input);
	$input .= '</form>';
}
echo $input;
?>