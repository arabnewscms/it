<?php
$accept = '';
if ($data['file_type'] == 'pdf') {
	$accept = 'application/pdf';
} elseif ($data['file_type'] == 'docx') {
	$accept = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
} elseif ($data['file_type'] == 'mp4') {
	$accept = 'video/mp4';
} elseif ($data['file_type'] == 'mpeg') {
	$accept = 'video/mpeg';
} elseif ($data['file_type'] == 'mov') {
	$accept = 'video/quicktime';
} elseif ($data['file_type'] == '3gp') {
	$accept = 'video/3gpp';
} elseif ($data['file_type'] == 'webm') {
	$accept = 'video/webm';
} elseif ($data['file_type'] == 'mkv') {
	$accept = 'video/x-matroska';
} elseif ($data['file_type'] == 'wmv') {
	$accept = 'video/x-ms-wmv';
} elseif ($data['file_type'] == 'avi') {
	$accept = 'video/x-msvideo';
} elseif ($data['file_type'] == 'vob') {
	$accept = 'video/video/x-ms-vob';
} elseif ($data['file_type'] == 'video') {
	$accept = 'video/mp4,video/3gpp,video/mpeg,video/quicktime,video/webm,video/x-matroska,video/x-ms-wmv,video/x-msvideo,video/video/x-ms-vob';
} elseif ($data['file_type'] == 'image') {
	$accept = 'image/*';
}

if ($data['use_collective'] == 'yes') {

	$text = '
<div class="' . $data['col_width'] . '">
    <div class="form-group">
        <label for="\'{Convention}\'">{{ trans(\'{lang}.{Convention}\') }}</label>
        <div class="input-group">
            <div class="custom-file">
                {!! Form::file(\'{Convention}\',[\'class\'=>\'custom-file-input\',\'placeholder\'=>trans(\'{lang}.{Convention}\'),"accept"=>"' . $accept . '"]) !!}
                {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\'),[\'class\'=>\'custom-file-label\']) !!}
            </div>
            <div class="input-group-append">
                <span class="input-group-text" id="">{{ trans(\'admin.upload\') }}</span>
            </div>
        </div>
    </div>
</div>
';
} else {
	$text = '
<div class="' . $data['col_width'] . '">
    <div class="form-group">
        <label for="{Convention}">{{trans(\'{lang}.{Convention}\')}}</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" id="{Convention}" name="{Convention}" class="custom-file-input" accept="' . $accept . '" placeholder="{{trans(\'{lang}.{Convention}\')}}" />
            </div>
            <div class="input-group-append">
                <span class="input-group-text" id="">{{ trans(\'admin.upload\') }}</span>
            </div>
        </div>
    </div>
</div>

';
}
$text = str_replace('{Convention}', $data['col_name_convention'], $text);
$text = str_replace('{lang}', $data['lang_file'], $text);
echo $text;
?>