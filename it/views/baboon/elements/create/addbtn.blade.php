<?php
$input = '';
if (request('use_collective') == 'yes') {
	$input .= '<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">'."\n";
	$input .= '{!! Form::submit(trans(\'{lang}.add\'),[\'class\'=>\'btn btn-success\']) !!}'."\n";
	$input .= '         </div>
            </div>
        </div>
    </div>
</div>'."\n";
	$input .= '{!! Form::close() !!}';
	$input = str_replace('{lang}', request('lang_file'), $input);
} else {
	$input .= '<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">'."\n";
	$input .= '<input type="submit" class="btn btn-success" value="{{ trans(\'{lang}.add\') }}" />'."\n";
	$input .= '         </div>
            </div>
        </div>
    </div>
</div>'."\n";
	$input = str_replace('{lang}', request('lang_file'), $input);
	$input .= '</form>';
}
echo $input;
?>