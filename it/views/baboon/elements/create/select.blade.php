<?php
$ex = explode('|', $data['col_name_convention']);
if ($data['use_collective'] == 'yes') {
	$text = '
<div class="' . $data['col_width'] . '">
	<div class="form-group">
		{!! Form::label(\'{Convention}\',trans(\'{lang}.{Convention}\')) !!}' . "\r\n";
	if ($data['link_ajax'] == 'yes') {
		$text .= '		<span class="{Convention}"></span>' . "\r\n";
	} else {
		if ($data['forginkeyto'] == 'yes' || preg_match('/App/i', $ex[1])) {
			$text .= '		{!! Form::select(\'{Convention}\',' . $ex[1];
		} else {
			$text .= '		{!! Form::select(\'{Convention}\',[';
			if (!empty($ex[1])) {
				$options = explode('/', $ex[1]);
				foreach ($options as $op) {
					$kv = explode(',', $op);
					$text .= "'" . $kv[0] . "'=>trans('{lang}." . $kv[0] . "'),";
				}
			}
			$text .= ']';
		}
		$text .= ',old(\'{Convention}\'),[\'class\'=>\'form-control select2\',\'placeholder\'=>trans(\'{lang}.choose\')]) !!}' . "\n";
	}
	$text .= '	</div>
</div>
';
} else {
	$text = '
<div class="' . $data['col_width'] . '">
	<div class="form-group">
				<label for="{Convention}">{{trans(\'{lang}.{Convention}\')}}</label>
							<select id="{Convention}" name="{Convention}" class="form-control select2" placeholder="{{trans(\'{lang}.{Convention}\')}}" >' . "\r\n";
	if ($data['link_ajax'] == 'yes') {
		$text .= '		<span class="{Convention}"></span>' . "\r\n";
	} else {
		if ($data['forginkeyto'] == 'yes' || preg_match('/App/', $ex[1])) {
			$text .= '    @foreach(' . $ex[1] . ' as ${Convention})' . "\r\n";
			$pluck_ex = str_replace('(', '', explode('pluck', $ex[1])[1]);
			$pluck_ex = str_replace(')', '', $pluck_ex);
			$pluck_ex = str_replace("'", "", $pluck_ex);
			$pluck_ex = explode(',', $pluck_ex);
			$text .= '      <option value="{{ ${Convention}->' . $pluck_ex[1] . ' }}" {{old(\'{Convention}\') == ${Convention}->' . $pluck_ex[1] . '?\'selected\':\'\'}}>{{ ${Convention}->' . $pluck_ex[0] . ' }}</option>' . "\r\n";
			$text .= '    @endforeach' . "\r\n";
		} else {
			$options = explode('/', $ex[1]);
			foreach ($options as $op) {
				$kv = explode(',', $op);
				$text .= "\n<option value=\"" . $kv[0] . "\" {{old('{Convention}') == '" . $kv[0] . "'?'selected':''}} >{{trans('{lang}." . $kv[1] . "')}}</option>" . "\n";
			}
		}
		$text .= '   </select>' . "\n";
	}
	$text .= '</div>
</div>
';
}
$text = str_replace('{Convention}', $ex[0], $text);
$text = str_replace('{lang}', $data['lang_file'], $text);
echo $text;
?>