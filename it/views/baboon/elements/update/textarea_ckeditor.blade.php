<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="' . $data['col_width'] . '">
    <div class="form-group">
        {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\'),[\'class\'=>\'control-label\']) !!}
        <div class="col-md-12">
            {!! Form::textarea(\'{Convention}\', {Convention2} ,[\'class\'=>\'form-control ckeditor\',\'placeholder\'=>trans(\'{lang}.{Convention}\')]) !!}
        </div>
    </div>
</div>
';
} else {
	$text = '
<div class="' . $data['col_width'] . '">
    <div class="form-group">
        <label for="{Convention}" class="control-label">{{trans(\'{lang}.{Convention}\')}}</label>
        <div class="col-md-12">
            <textarea id="{Convention}" class="form-control ckeditor" placeholder="{{trans(\'{lang}.{Convention}\')}}"
            name="{Convention}" >{{ {Convention2} }}</textarea>
        </div>
    </div>
</div>
';
}
$text = str_replace('{Convention}', $data['col_name_convention'], $text);
$text = str_replace('{Convention2}', $data['col_name_convention2'], $text);
$text = str_replace('{lang}', $data['lang_file'], $text);
echo $text;
?>