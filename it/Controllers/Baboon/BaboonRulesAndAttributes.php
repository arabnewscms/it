<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;
use Phpanonymous\It\Controllers\Baboon\BaboonSchema;

class BaboonRulesAndAttributes extends Controller {

	public static function SetAttributeNames($r) {
		$SetAttributeNames = '';
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$pre_conv = explode('|', $conv);
				$SetAttributeNames .= '             \'' . $pre_conv[0] . '\'=>trans(\'{lang}.' . $pre_conv[0] . '\'),' . "\n";
			} elseif (preg_match('/#/i', $conv)) {
				$pre_conv = explode('#', $conv);
				if (!preg_match('/' . $pre_conv[0] . '/', $SetAttributeNames)) {

					$SetAttributeNames .= '             \'' . $pre_conv[0] . '\'=>trans(\'{lang}.' . $pre_conv[0] . '\'),' . "\n";
				}
			} elseif ($r->input('col_type')[$i] != 'dropzone') {
				$SetAttributeNames .= '             \'' . $conv . '\'=>trans(\'{lang}.' . $conv . '\'),' . "\n";
			}
			$i++;
		}
		$SetAttributeNames = str_replace('{lang}', $r->input('lang_file'), $SetAttributeNames);
		return $SetAttributeNames;
	}

	public static function rules($r) {
		$rule = '';
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			$valrule = '';
			$valrule .= self::ruleList($r, $i, $conv);

			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$pre_conv = explode('|', $conv);
				$rule .= '             \'' . $pre_conv[0] . '\'=>\'' . rtrim($valrule, '|') . '\',' . "\n";
			} elseif (preg_match('/#/i', $conv)) {
				$pre_conv = explode('#', $conv);
				if (!preg_match('/' . $pre_conv[0] . '/i', $rule)) {
					$rule .= '             \'' . $pre_conv[0] . '\'=>\'' . rtrim($valrule, '|') . '\',' . "\n";
				}
			} elseif ($r->has('image' . $i) and $r->has('image' . $i) == 1) {
				if ($r->input('col_type')[$i] != 'dropzone') {
					$rule .= '             \'' . $conv . '\'=>\'' . rtrim($valrule, '|"') . '\',' . "\n";
				}
			} else {
				if ($r->input('col_type')[$i] != 'dropzone') {
					$rule .= '             \'' . $conv . '\'=>\'' . rtrim($valrule, '|') . '\',' . "\n";
				}
			}
			$i++;
		}
		return $rule;
	}

	public static function CustomSetAttributeNames($r) {
		$SetAttributeNames = '';
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$pre_conv = explode('|', $conv);
				if (checkIfExisitValue('api_show_column', $pre_conv[0])) {
					$SetAttributeNames .= '             \'' . $pre_conv[0] . '\'=>trans(\'{lang}.' . $pre_conv[0] . '\'),' . "\n";
				}
			} elseif (preg_match('/#/i', $conv)) {
				$pre_conv = explode('#', $conv);
				if (!preg_match('/' . $pre_conv[0] . '/', $SetAttributeNames)) {
					if (checkIfExisitValue('api_show_column', $pre_conv[0])) {
						$SetAttributeNames .= '             \'' . $pre_conv[0] . '\'=>trans(\'{lang}.' . $pre_conv[0] . '\'),' . "\n";
					}
				}
			} elseif ($r->input('col_type')[$i] != 'dropzone') {
				if (checkIfExisitValue('api_show_column', $conv)) {
					$SetAttributeNames .= '             \'' . $conv . '\'=>trans(\'{lang}.' . $conv . '\'),' . "\n";
				}
			}
			$i++;
		}
		$SetAttributeNames = str_replace('{lang}', $r->input('lang_file'), $SetAttributeNames);
		return $SetAttributeNames;
	}

	public static function customRules($r) {
		$rule = '';
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			$valrule = '';
			$valrule .= self::ruleList($r, $i, $conv);

			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$pre_conv = explode('|', $conv);
				if (checkIfExisitValue('api_show_column', $pre_conv[0])) {
					$rule .= '             \'' . $pre_conv[0] . '\'=>\'' . rtrim($valrule, '|') . '\',' . "\n";
				}
			} elseif (preg_match('/#/i', $conv)) {
				$pre_conv = explode('#', $conv);
				if (!preg_match('/' . $pre_conv[0] . '/i', $rule)) {
					if (checkIfExisitValue('api_show_column', $pre_conv[0])) {
						$rule .= '             \'' . $pre_conv[0] . '\'=>\'' . rtrim($valrule, '|') . '\',' . "\n";
					}
				}
			} elseif ($r->has('image' . $i) and $r->has('image' . $i) == 1) {
				if ($r->input('col_type')[$i] != 'dropzone') {
					if (checkIfExisitValue('api_show_column', $conv)) {
						$rule .= '             \'' . $conv . '\'=>\'' . rtrim($valrule, '|"') . '\',' . "\n";
					}
				}
			} else {
				if ($r->input('col_type')[$i] != 'dropzone') {
					if (checkIfExisitValue('api_show_column', $conv)) {
						$rule .= '             \'' . $conv . '\'=>\'' . rtrim($valrule, '|') . '\',' . "\n";
					}
				}
			}
			$i++;
		}
		return $rule;
	}

	public static function ruleList($r, $i, $conv = null) {
		$valrule = '';
		if ($r->input('col_name_null' . $i) == 'has') {
			$r->has('sometimes' . $i) ? $valrule .= 'sometimes|' : '';
			$r->has('required' . $i) ? $valrule .= 'required|' : '';
			$r->has('nullable' . $i) ? $valrule .= 'nullable|' : '';
			$r->has('string' . $i) ? $valrule .= 'string|' : '';
			$r->has('numeric' . $i) ? $valrule .= 'numeric|' : '';
			$r->has('integer' . $i) ? $valrule .= 'integer|' : '';
			$r->has('email' . $i) ? $valrule .= 'email|' : '';
			$r->has('file' . $i) ? $valrule .= 'file|' : '';
			$r->has('video' . $i) ? $valrule .= 'video|' : '';
			$r->has('image' . $i) ? $valrule .= "image|" : '';
			$r->has('pdf' . $i) ? $valrule .= "pdf|" : '';

			// Office Exts and mimes //
			$r->has('office' . $i) ? $valrule .= "office|" : '';
			$r->has('docx' . $i) ? $valrule .= "docx|" : '';
			$r->has('potm' . $i) ? $valrule .= "potm|" : '';
			$r->has('ppsm' . $i) ? $valrule .= "ppsm|" : '';
			$r->has('sldm' . $i) ? $valrule .= "sldm|" : '';
			$r->has('pptm' . $i) ? $valrule .= "pptm|" : '';
			$r->has('ppam' . $i) ? $valrule .= "ppam|" : '';
			$r->has('ppt' . $i) ? $valrule .= "ppt|" : '';
			$r->has('xltx' . $i) ? $valrule .= "xltx|" : '';
			$r->has('xlsx' . $i) ? $valrule .= "xlsx|" : '';
			$r->has('xls' . $i) ? $valrule .= "xls|" : '';
			// Office Exts and mimes //

			$r->has('audio' . $i) ? $valrule .= "audio|" : '';
			$r->has('wav' . $i) ? $valrule .= "wav|" : '';
			$r->has('mp3' . $i) ? $valrule .= "mp3|" : '';
			$r->has('ogg' . $i) ? $valrule .= "ogg|" : '';
			$r->has('adp' . $i) ? $valrule .= "adp|" : '';

			// Video Rules //
			$r->has('mp4' . $i) ? $valrule .= "mp4|" : '';
			$r->has('mpeg' . $i) ? $valrule .= "mpeg|" : '';
			$r->has('mov' . $i) ? $valrule .= "mov|" : '';
			$r->has('3gp' . $i) ? $valrule .= "3gp|" : '';
			$r->has('webm' . $i) ? $valrule .= "webm|" : '';
			$r->has('mkv' . $i) ? $valrule .= "mkv|" : '';
			$r->has('wmv' . $i) ? $valrule .= "wmv|" : '';
			$r->has('avi' . $i) ? $valrule .= "avi|" : '';
			$r->has('vob' . $i) ? $valrule .= "vob|" : '';
			// Video Rules //
			$r->has('url' . $i) ? $valrule .= 'url|' : '';
			$r->has('filled' . $i) ? $valrule .= 'filled|' : '';
			$r->has('confirmed' . $i) ? $valrule .= 'confirmed|' : '';
			$r->has('active_url' . $i) ? $valrule .= 'active_url|' : '';
			$r->has('accepted' . $i) ? $valrule .= 'accepted|' : '';
			$r->has('boolean' . $i) ? $valrule .= 'boolean|' : '';
			$r->has('uuid' . $i) ? $valrule .= 'uuid|' : '';
			$r->has('bail' . $i) ? $valrule .= 'bail|' : '';
			$r->has('present' . $i) ? $valrule .= 'present|' : '';
			$r->has('timezone' . $i) ? $valrule .= 'timezone|' : '';
			$r->has('json' . $i) ? $valrule .= 'json|' : '';
			$r->has('array' . $i) ? $valrule .= 'array|' : '';
			$r->has('ip' . $i) ? $valrule .= 'ip|' : '';
			$r->has('ipv4' . $i) ? $valrule .= 'ipv4|' : '';
			$r->has('ipv6' . $i) ? $valrule .= 'ipv6|' : '';
			$r->has('alpha' . $i) ? $valrule .= 'alpha|' : '';
			$r->has('alpha-dash' . $i) ? $valrule .= 'alpha-dash|' : '';
			$r->has('alpha_num' . $i) ? $valrule .= 'alpha_num|' : '';
			$r->has('required_if' . $i) ? $valrule .= 'required_if:' . $r->input('required_if_text' . $i) . '|' : '';
			$r->has('required_unless' . $i) ? $valrule .= 'required_unless:' . $r->input('required_unless_text' . $i) . '|' : '';
			$r->has('required_without' . $i) ? $valrule .= 'required_without:' . $r->input('required_without_text' . $i) . '|' : '';
			$r->has('required_with' . $i) ? $valrule .= 'required_with:' . $r->input('required_with_text' . $i) . '|' : '';
			$r->has('required_with_all' . $i) ? $valrule .= 'required_with_all:' . $r->input('required_with_all_text' . $i) . '|' : '';
			$r->has('required_without_all' . $i) ? $valrule .= 'required_without_all:' . $r->input('required_without_all_text' . $i) . '|' : '';
			$r->has('same' . $i) ? $valrule .= 'same:' . $r->input('same_text' . $i) . '|' : '';
			$r->has('size' . $i) ? $valrule .= 'size:' . $r->input('size_text' . $i) . '|' : '';
			$r->has('starts_with' . $i) ? $valrule .= 'starts_with:' . $r->input('starts_with_text' . $i) . '|' : '';
			$r->has('between' . $i) ? $valrule .= 'between:' . $r->input('between_text' . $i) . '|' : '';
			$r->has('digits_between' . $i) ? $valrule .= 'digits_between:' . $r->input('digits_between_text' . $i) . '|' : '';
			$r->has('different' . $i) ? $valrule .= 'different:' . $r->input('different_text' . $i) . '|' : '';
			$r->has('dimensions' . $i) ? $valrule .= 'dimensions:' . $r->input('dimensions_text' . $i) . '|' : '';
			$r->has('digits' . $i) ? $valrule .= 'digits:' . $r->input('digits_text' . $i) . '|' : '';
			$r->has('ends_with' . $i) ? $valrule .= 'ends_with:' . $r->input('ends_with_text' . $i) . '|' : '';
			$r->has('exclude_if' . $i) ? $valrule .= 'exclude_if:' . $r->input('exclude_if_text' . $i) . '|' : '';
			$r->has('exclude_unless' . $i) ? $valrule .= 'exclude_unless:' . $r->input('exclude_unless_text' . $i) . '|' : '';
			$r->has('gt' . $i) ? $valrule .= 'gt:' . $r->input('gt_text' . $i) . '|' : '';
			$r->has('gte' . $i) ? $valrule .= 'gte:' . $r->input('gte_text' . $i) . '|' : '';
			$r->has('lt' . $i) ? $valrule .= 'lt:' . $r->input('lt_text' . $i) . '|' : '';
			$r->has('lte' . $i) ? $valrule .= 'lte:' . $r->input('lte_text' . $i) . '|' : '';
			$r->has('min' . $i) ? $valrule .= 'min:' . $r->input('min_text' . $i) . '|' : '';
			$r->has('max' . $i) ? $valrule .= 'max:' . $r->input('max_text' . $i) . '|' : '';
			$r->has('multiple_of' . $i) ? $valrule .= 'multiple_of:' . $r->input('multiple_of_text' . $i) . '|' : '';
			$r->has('not_in' . $i) ? $valrule .= 'not_in:' . $r->input('not_in_text' . $i) . '|' : '';
			$r->has('not_regex' . $i) ? $valrule .= 'not_regex:' . $r->input('not_regex_text' . $i) . '|' : '';
			$r->has('regex' . $i) ? $valrule .= 'regex:' . $r->input('regex_text' . $i) . '|' : '';
			$r->has('mimetypes' . $i) ? $valrule .= 'mimetypes:' . $r->input('mimetypes_text' . $i) . '|' : '';
			$r->has('mimes' . $i) ? $valrule .= 'mimes:' . $r->input('mimes_text' . $i) . '|' : '';
			$r->has('in_array' . $i) ? $valrule .= 'in_array:' . $r->input('in_array_text' . $i) . '|' : '';
			$r->has('prohibited_if' . $i) ? $valrule .= 'prohibited_if:' . $r->input('prohibited_if_text' . $i) . '|' : '';
			$r->has('prohibited_unless' . $i) ? $valrule .= 'prohibited_unless:' . $r->input('prohibited_unless_text' . $i) . '|' : '';
			$r->has('unique' . $i) ? $valrule .= 'unique:' . $r->input('unique_text' . $i) . '|' : '';

			// select or dropdown static (enum) In Rules Start
			if ($r->input('col_type')[$i] == 'select') {
				$ex_select = explode('|', $conv);
				if ($r->has('forginkeyto' . $i) != 'yes' && !preg_match('/App/i', $ex_select[1])) {
					if (!empty($ex_select[1])) {
						$options = explode('/', $ex_select[1]);
						$valrule .= 'in:';
						foreach ($options as $op) {
							$kv = explode(',', $op);
							$valrule .= $kv[0] . ',';
						}
						$valrule = rtrim($valrule, ',');
						$valrule .= '|';
					}
				}
			}
			// select or dropdown static (enum) In Rules End

			if ($r->has('exists_table' . $i) && !empty($r->input('exists_table' . $i))) {
				if ($r->input('exists_table' . $i) != 'without check Exist') {
					$modelname = explode('\\', $r->input('exists_table' . $i));
					$tableName = $modelname[count($modelname) - 1];
					$convname = BaboonSchema::convention_name($tableName);
					$valrule .= 'exists:' . $convname . ',id|';
				}
			}

			////////// Date Validation Laravel /////////////////////
			$r->has('date' . $i) ? $valrule .= 'date|' : '';
			$r->has('date_format' . $i) ? $valrule .= $r->input('date_format' . $i) != 'NULL' ? $r->input('date_format' . $i) . '|' : '' : '';

			if ($r->input('before_after_tomorrow' . $i) == 'today' || $r->input('before_after_tomorrow' . $i) == 'tomorrow') {
				$radio_after_before = $r->input('before_after_tomorrow' . $i);
			} elseif ($r->input('before_after_tomorrow' . $i) == 'other_col') {
				$radio_after_before = $r->input('other_cal_before_after' . $i);
			} elseif ($r->input('before_after_tomorrow' . $i) == 'other_carbon') {
				$radio_after_before = "'.Carbon::now()->addDays(" . $r->input('other_carbon' . $i) . ")->toDateString().'";
			}
			$r->has('after_before' . $i) ? $valrule .= $r->input('after_before' . $i) . ':' . $radio_after_before . '|' : '';
			////////// Date Validation Laravel /////////////////////
		}
		return $valrule;
	}

}
