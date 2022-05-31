<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="' . $data['col_width'] . '">
    <div class="form-group">
        <div class="custom-control custom-switch">
            {!! Form::checkbox(\'{Convention}\', \'{val}\',{Convention2} == "{val}"?true:false ,[\'class\'=>\'custom-control-input\',\'placeholder\'=>trans(\'{lang}.{Convention}\'),"id"=>"{Convention}"]) !!}
            {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\'),[\'class\'=>\'custom-control-label\']) !!}
        </div>
    </div>
</div>
';
} else {
	$text = '
<div class="' . $data['col_width'] . '">
    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" {{ {Convention2} == \'{val}\'?"checked":"" }} name="{Convention}" value="{val}" class="custom-control-input" id="{Convention}">
            <label class="custom-control-label" for="{Convention}">{{trans(\'{lang}.{Convention}\')}}</label>
        </div>
    </div>
</div>
';
}

$checkbox = explode('#', $data['col_name_convention']);
if (count($checkbox)) {
	$text = str_replace('{Convention}', $checkbox[0], $text);
	$text = str_replace('{val}', $checkbox[1], $text);
	$text = str_replace('{Convention2}', $data['col_name_convention2'], $text);
} else {
	$text = str_replace('{Convention}', 'No Name', $text);
	$text = str_replace('{val}', 'No value', $text);
	$text = str_replace('{Convention2}', '', $text);
}
$text = str_replace('{lang}', $data['lang_file'], $text);
echo $text;
?>