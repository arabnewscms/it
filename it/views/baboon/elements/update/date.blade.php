<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="form-group">
    {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\'),[\'class\'=>\'col-md-3 control-label\']) !!}
    <div class="col-md-9">
        {!! Form::text(\'{Convention}\', {Convention2} ,[\'class\'=>\'form-control date-picker\',\'placeholder\'=>trans(\'{lang}.{Convention}\'),\'readonly\'=>\'readonly\',\'data-date\'=>date("Y-m-d"),\'data-date-format\'=>\'yyyy-mm-dd\']) !!}
    </div>
</div>
<br>
';
} else {
	$text = '
<div class="form-group">
    <label for="{Convention}" class="col-md-3 control-label">{{trans(\'{lang}.{Convention}\')}}</label>
    <div class="col-md-9">
        <input type="date" id="{Convention}" name="{Convention}" value="{{ {Convention2} }}" class="form-control date-picker" data-date="{{date("Y-m-d")}}" data-date-format="yyyy-mm-dd" readonly placeholder="{{trans(\'{lang}.{Convention}\')}}" />
    </div>
</div>
<br>
';
}
$text = str_replace('{Convention}', $data['col_name_convention'], $text);
$text = str_replace('{Convention2}', $data['col_name_convention2'], $text);
$text = str_replace('{lang}', $data['lang_file'], $text);
echo $text;
?>