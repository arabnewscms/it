<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="' . $data['col_width'] . '">
    <div class="form-group">
        <div class="custom-control custom-switch">
            {!! Form::checkbox("{Convention}","{val}",old("{Convention}"),["class"=>"custom-control-input","placeholder"=>trans("{lang}.{val}"),"id"=>"{Convention}"]) !!}
            {!! Form::label("{Convention}",trans("{lang}.{val}"),["class"=>"custom-control-label"]) !!}
        </div>
    </div>
</div>
';
} else {
	$text = '
<div class="' . $data['col_width'] . '">
    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox"
            {{ old("{Convention}") == "{val}"?"checked":"" }}
            name="{Convention}"
            value="{val}"
            class="custom-control-input" id="{Convention}">
            <label class="custom-control-label" for="{Convention}">{{trans(\'{lang}.{val}\')}}</label>
        </div>
    </div>
</div>
';
}

$checkex = explode('#', $data['col_name_convention']);
if (count($checkex) > 0) {
	$text = str_replace('{Convention}', $checkex[0], $text);
	$text = str_replace('{val}', $checkex[1], $text);
} else {
	$text = str_replace('{Convention}', 'No Name', $text);
	$text = str_replace('{val}', 'No value', $text);
}
$text = str_replace('{lang}', $data['lang_file'], $text);
echo $text;
?>