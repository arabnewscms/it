<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="' . $data['col_width'] . '">
    <div class="form-group">
        {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\'),[\'class\'=>\'control-label\']) !!}
        {!! Form::url(\'{Convention}\', {Convention2} ,[\'class\'=>\'form-control\',\'placeholder\'=>trans(\'{lang}.{Convention}\')]) !!}
    </div>
</div>
';
} else {
	$text = '
<div class="' . $data['col_width'] . '">
    <div class="form-group">
        <label for="{Convention}" class="control-label">{{trans(\'{lang}.{Convention}\')}}</label>
        <input type="url" id="{Convention}" name="{Convention}" value="{{ {Convention2} }}" class="form-control" placeholder="{{trans(\'{lang}.{Convention}\')}}" />
    </div>
</div>
';
}
$text = str_replace('{Convention}', $data['col_name_convention'], $text);
$text = str_replace('{Convention2}', $data['col_name_convention2'], $text);
$text = str_replace('{lang}', $data['lang_file'], $text);
echo $text;
?>