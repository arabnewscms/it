<?php
$input = '';
if (request('use_collective') == 'yes') {
	$input .= '<div class="form-actions">

                <div class="col-md-9">' . "\n";
	$input .= '{!! Form::submit(trans(\'{lang}.save\'),[\'class\'=>\'btn btn-success\']) !!}' . "\n";
	$input .= '         </div>

</div>' . "\n";
	$input .= '{!! Form::close() !!}' . "\n";
	$input = str_replace('{lang}', request('lang_file'), $input);
} else {
	$input .= '<div class="form-actions">

                <div class="col-md-9">' . "\n";
	$input .= '<input type="submit" class="btn btn-success" value="{{ trans(\'{lang}.save\') }}" />' . "\n";
	$input .= '         </div>

</div>' . "\n";
	$input = str_replace('{lang}', request('lang_file'), $input);
	$input .= '</form>' . "\n";
}
echo $input;
?>