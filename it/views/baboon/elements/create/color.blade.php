<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="' . $data['col_width'] . '">
    <!-- Color Picker -->
    <div class="col-md-11 col-sm-11 col-lg-11 col-xs-11">
        <div class="form-group">
            {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\')) !!}
            <div class="input-group colorpicker">
                {!! Form::text(\'{Convention}\',old(\'{Convention}\'),[\'class\'=>\'form-control\',\'placeholder\'=>trans(\'{lang}.{Convention}\'),"readonly"=>"readonly"]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                </div>
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->
    </div>
</div>
';
} else {
	$text = '
<div class="' . $data['col_width'] . '">
    <!-- Color Picker -->
    <div class="col-md-11 col-sm-11 col-lg-11 col-xs-11">
        <div class="form-group">
            <label>{{trans(\'{lang}.{Convention}\')}}</label>
            <div class="input-group colorpicker">
                <input type="text" name="{Convention}" value="{{old(\'{Convention}\')}}" placeholder="{{trans(\'{lang}.{Convention}\')}}" readonly class="form-control">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                </div>
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->
    </div>
</div>
';
}
$text = str_replace('{Convention}', $data['col_name_convention'], $text);
$text = str_replace('{lang}', $data['lang_file'], $text);
echo $text;
?>