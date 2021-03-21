<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\'),[\'class\'=>\'control-label\']) !!}
        <div class="col-md-12">
            <div class="col-md-9">
                {!! Form::file(\'{Convention}\',[\'class\'=>\'form-control\',\'placeholder\'=>trans(\'{lang}.{Convention}\')]) !!}
            </div>
            <div class="col-md-3">
                @include("admin.show_image",["image"=>{Convention2}])
            </div>
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
            <div class="col-md-9">
                <input type="file" id="{Convention}" name="{Convention}" class="form-control" placeholder="{{trans(\'{lang}.{Convention}\')}}" />
            </div>
            <div class="col-md-3">
                @include("admin.show_image",["image"=>{Convention2}])
            </div>
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