<?php
$input = '';
if (request('use_collective') == 'yes') {
	$input .= '<div class="form-actions">
                <div class="col-md-9">' . "\n";
	$input .= '<button type="submit" name="save" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans(\'{lang}.save\') }}</button>' . "\n";
	$input .= '<button type="submit" name="save_back" class="btn btn-success"><i class="fa fa-save"></i> {{ trans(\'{lang}.save_back\') }}</button>' . "\n";

	$input .= '         </div>

</div>' . "\n";
	$input .= '{!! Form::close() !!}' . "\n";
	$input = str_replace('{lang}', request('lang_file'), $input);
} else {
	$input .= '<div class="form-actions">

                <div class="col-md-9">' . "\n";
	$input .= '<button type="submit" name="save" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans(\'{lang}.save\') }}</button>' . "\n";
	$input .= '<button type="submit" name="save_back" class="btn btn-success"><i class="fa fa-save"></i> {{ trans(\'{lang}.save_back\') }}</button>' . "\n";
	$input .= '         </div>

</div>' . "\n";
	$input = str_replace('{lang}', request('lang_file'), $input);
	$input .= '</form>' . "\n";
}
echo $input;
?>