<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="' . $data['col_width'] . ' {Convention}">
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label for="\'{Convention}\'">{{ trans(\'{lang}.{Convention}\') }}</label>
                <div class="input-group">
                    <div class="custom-file">
                        {!! Form::file(\'{Convention}\',[\'class\'=>\'custom-file-input\',\'placeholder\'=>trans(\'{lang}.{Convention}\'),"accept"=>it()->acceptedMimeTypes("' . $data['file_type'] . '"),"id"=>"{Convention}"]) !!}
                        {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\'),[\'class\'=>\'custom-file-label\']) !!}
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text" id="">{{ trans(\'admin.upload\') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2" style="padding-top: 30px;">
            @include("admin.show_image",["image"=>{Convention2}])
        </div>
    </div>
</div>
';
} else {
	$text = '
<div class="' . $data['col_width'] . ' {Convention}">
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label for="{Convention}">{{trans(\'{lang}.{Convention}\')}}</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" id="{Convention}" name="{Convention}" class="custom-file-input" placeholder="{{trans(\'{lang}.{Convention}\')}}" accept="{{ it()->acceptedMimeTypes("' . $data['file_type'] . '") }}" />
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text" id="">{{ trans(\'admin.upload\') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            @include("admin.show_image",["image"=>{Convention2}])
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