<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="' . $data['col_width'] . '">
    <div class="icheck-success d-inline">
        {!! Form::radio(\'{Convention}\',old(\'{Convention}\'),\'{val}\') !!}
        {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\')) !!}
    </div>
</div>
';
} else {
	$text = '
<div class="' . $data['col_width'] . '">
    <div class="icheck-success d-inline">
        <input type="radio" {{ old(\'{Convention}\') == \'{val}\'?"checked":"" }} name="{Convention}" value="{val}" id="{Convention}">
        <label for="{Convention}">{{trans(\'{lang}.{Convention}\')}}</label>
    </div>
</div>
';
}
$checkex = @explode('#', $data['col_name_convention']);
if (count($checkex)) {
	$text = str_replace('{Convention}', $checkex[0], $text);
	$text = str_replace('{val}', $checkex[1], $text);
} else {
	$text = str_replace('{Convention}', 'No Name', $text);
	$text = str_replace('{val}', 'No value', $text);
}
$text = str_replace('{lang}', $data['lang_file'], $text);
echo $text;
?>