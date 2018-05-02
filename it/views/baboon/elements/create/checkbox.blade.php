<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="form-group">
    {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\'),[\'class\'=>\'col-md-3 control-label\']) !!}
    <div class="col-md-9">
        {!! Form::checkbox(\'{Convention}\',old(\'{Convention}\'),\'{val}\',[\'class\'=>\'form-control\',\'placeholder\'=>trans(\'{lang}.{Convention}\')]) !!}
    </div>
</div>
<br>
';
} else {
	$text = '
<div class="form-group">
    <label for="{Convention}" class="col-md-3 control-label">{{trans(\'{lang}.{Convention}\')}}</label>
    <div class="col-md-9">
        <input type="checkbox" id="{Convention}" @if(old(\'{Convention}\') == \'{val}\') checked @endif  name="{Convention}" value="{val}" class="form-control" placeholder="{{trans(\'{lang}.{Convention}\')}}" />
    </div>
</div>
<br>
';
}
$checkex = @explode('#', $data['col_name_convention']);
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