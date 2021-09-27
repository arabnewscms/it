<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="' . $data['col_width'] . '">
    <div class="icheck-success d-inline form-control" id="{Convention}">
        {!! Form::radio("{Convention}","{val}",old("{Convention}") == "{val}"?true:false,["id"=>"{val}"]) !!}
        {!! Form::label("{val}",trans("{lang}.{val}")) !!}
    </div>
</div>
';
} else {
	$text = '
<div class="' . $data['col_width'] . '">
    <div class="icheck-success d-inline form-control" id="{Convention}">
        <input type="radio" {{ old(\'{Convention}\') == \'{val}\'?"checked":"" }} name="{Convention}" value="{val}" id="{val}">
        <label for="{val}">{{trans(\'{lang}.{val}\')}}</label>
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