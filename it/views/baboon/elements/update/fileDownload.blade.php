<?php
if ($data['video']['status']) {
	$video = '@include("admin.show_video",["video"=>{Convention2}])';
} else {
	$video = '';
}
if ($data['audio']['status']) {
	$audio = '@include("admin.show_audio",["audio"=>{Convention2}])';
} else {
	$audio = '';
}

if ($data['use_collective'] == 'yes') {
	$text = '
<div class="' . $data['col_width'] . ' {Convention}">
    <div class="row">
        <div class="col-md-8">
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
        <div class="col-md-4" style="padding-top: 30px;">
            <div class="row">
                <div class="col-md-6">
                    ' . $video . '' . $audio . '
                </div>
                <div class="col-md-6">
                    <a href="{{ it()->url({Convention2}) }}" target="_blank"><i class="fa fa-download fa-2x"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
';
} else {
	$text = '
<div class="' . $data['col_width'] . '">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="{Convention}">{{trans(\'{lang}.{Convention}\')}}</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" id="{Convention}" name="{Convention}" class="custom-file-input"  accept="{{ it()->acceptedMimeTypes("' . $data['file_type'] . '") }}" placeholder="{{trans(\'{lang}.{Convention}\')}}" />
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text" id="">{{ trans(\'admin.upload\') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="padding-top: 30px;">
            <div class="row">
                <div class="col-md-6">
                    ' . $video . '' . $audio . '
                </div>
                <div class="col-md-6">
                    <a href="{{ it()->url({Convention2}) }}" target="_blank"><i class="fa fa-download fa-2x"></i></a>
                </div>
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