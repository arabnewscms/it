<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="form-group">
    {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\'),[\'class\'=>\'col-md-3 control-label\']) !!}
    <div class="col-md-9">
        {!! Form::file(\'{Convention}\',[\'class\'=>\'form-control\',\'placeholder\'=>trans(\'{lang}.{Convention}\')]) !!}
        @if(!empty({Convention2}))
        <img src="{{it()->url({Convention2})}}" style="width:150px;height:150px;" />
        @endif
    </div>
</div>
<br>
';
} else {
	$text = '
<div class="form-group">
    <label for="{Convention}" class="col-md-3 control-label">{{trans(\'{lang}.{Convention}\')}}</label>
    <div class="col-md-9">
        <input type="file" id="{Convention}" name="{Convention}" class="form-control" placeholder="{{trans(\'{lang}.{Convention}\')}}" />
        @if(!empty({Convention2}->{Convention}))
        <img src="{{it()->url({Convention2})}}" style="width:150px;height:150px;" />
        @endif
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