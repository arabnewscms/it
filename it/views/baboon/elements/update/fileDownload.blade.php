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
<div class="'.$data['col_width'].'">
    <div class="form-group">
        {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\'),[\'class\'=>\'control-label\']) !!}
        <div class="col-md-12">
            <div class="col-md-9">
                {!! Form::file(\'{Convention}\',[\'class\'=>\'form-control\',\'placeholder\'=>trans(\'{lang}.{Convention}\')]) !!}
            </div>
            <div class="col-md-3">
                '.$video.''.$audio.'
                <a href="{{ it()->url({Convention2}) }}" target="_blank"><i class="fa fa-download fa-2x"></i></a>
            </div>
        </div>
    </div>
</div>
';
} else {
	$text = '
<div class="'.$data['col_width'].'">
    <div class="form-group">
        <label for="{Convention}" class="control-label">{{trans(\'{lang}.{Convention}\')}}</label>
        <div class="col-md-12">
            <div class="col-md-9">
                <input type="file" id="{Convention}" name="{Convention}" class="form-control" placeholder="{{trans(\'{lang}.{Convention}\')}}" />
            </div>
            <div class="col-md-3">
                '.$video.''.$audio.'
                <a href="{{ it()->url({Convention2}) }}" target="_blank"><i class="fa fa-download fa-2x"></i></a>
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