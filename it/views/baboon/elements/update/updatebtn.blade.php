<?php
$input = '';
if (request('use_collective') == 'yes') {
	$input .= '<button type="submit" name="save" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> {{ trans(\'{lang}.save\') }}</button>' . "\n";
	$input .= '<button type="submit" name="save_back" class="btn btn-success btn-flat"><i class="fa fa-save"></i> {{ trans(\'{lang}.save_back\') }}</button>' . "\n";

	$input .= '{!! Form::close() !!}' . "\n";
	$input = str_replace('{lang}', request('lang_file'), $input);
} else {
	$input .= '<button type="submit" name="save" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> {{ trans(\'{lang}.save\') }}</button>' . "\n";
	$input .= '<button type="submit" name="save_back" class="btn btn-success btn-flat"><i class="fa fa-save"></i> {{ trans(\'{lang}.save_back\') }}</button>' . "\n";
	$input = str_replace('{lang}', request('lang_file'), $input);
	$input .= '</form>' . "\n";
}
echo $input;
?>