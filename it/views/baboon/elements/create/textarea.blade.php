<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="form-group">
    {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\'),[\'class\'=>\'col-md-3 control-label\']) !!}
    <div class="col-md-9">
        {!! Form::textarea(\'{Convention}\',old(\'{Convention}\'),[\'class\'=>\'form-control\',\'placeholder\'=>trans(\'{lang}.{Convention}\')]) !!}
    </div>
</div>
<br>
';
} else {
	$text = '
<div class="form-group">
    <label for="{Convention}" class="col-md-3 control-label">{{trans(\'{lang}.{Convention}\')}}</label>
    <div class="col-md-9">
        <textarea id="{Convention}" class="form-control" placeholder="{{trans(\'{lang}.{Convention}\')}}"
        name="{Convention}" >{{old(\'{Convention}\')}}</textarea>
    </div>
</div>
<br>
';
}
$text = str_replace('{Convention}', $data['col_name_convention'], $text);
$text = str_replace('{lang}', $data['lang_file'], $text);
echo $text;
?>