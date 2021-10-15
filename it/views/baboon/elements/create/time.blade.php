<?php
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="' . $data['col_width'] . '">
<div class="bootstrap-timepicker">
  <div class="form-group">
    {!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\')) !!}
    <div class="input-group date timepicker" id="timepicker" data-target-input="nearest">
      {!! Form::text(\'{Convention}\',old(\'{Convention}\'),[\'class\'=>\'form-control datetimepicker-input\',\'placeholder\'=>trans(\'{lang}.{Convention}\'),"data-target"=>".timepicker","readonly"=>"readonly"]) !!}
      <div class="input-group-append" data-target=".timepicker" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="far fa-clock"></i></div>
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
<div class="bootstrap-timepicker">
  <div class="form-group">
    <label for="{Convention}">{{trans(\'{lang}.{Convention}\')}}</label>
    <div class="input-group date timepicker" id="timepicker" data-target-input="nearest">
      <input type="time" id="{Convention}" name="{Convention}" value="{{old(\'{Convention}\')}}" class="form-control datetimepicker-input" data-target=".timepicker" readonly  placeholder="{{trans(\'{lang}.{Convention}\')}}" />
      <div class="input-group-append" data-target=".timepicker" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="far fa-clock"></i></div>
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