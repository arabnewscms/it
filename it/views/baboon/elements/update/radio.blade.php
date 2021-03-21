<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\'),[\'class\'=>\'control-label\']) !!}
        <div class="col-md-12">
            {!! Form::radio(\'{Convention}\', {Convention2} ,\'{val}\',[\'class\'=>\'form-control\',\'placeholder\'=>trans(\'{lang}.{Convention}\')]) !!}
        </div>
    </div>
</div>
';
} else {
	$text = '
<div class="col-md-6">
    <div class="form-group">
        <label for="{Convention}" class="control-label">{{trans(\'{lang}.{Convention}\')}}</label>
        <div class="col-md-12">
            <input type="radio" id="{Convention}" name="{Convention}"
            @if({Convention2} == \'{val}\') checked @endif
            value="{val}" class="form-control" placeholder="{{trans(\'{lang}.{Convention}\')}}" />
        </div>
    </div>
</div>
';
}
$checkex = @explode('#', $data['col_name_convention']);
if (count($checkex)) {
	$text = str_replace('{Convention}', $checkex[0], $text);
	$text = str_replace('{val}', $checkex[1], $text);
	$text = str_replace('{Convention2}', $data['col_name_convention2'], $text);
} else {
	$text = str_replace('{Convention}', 'No Name', $text);
	$text = str_replace('{val}', 'No value', $text);
	$text = str_replace('{Convention2}', '', $text);
}
$text = str_replace('{lang}', $data['lang_file'], $text);
echo $text;
?>