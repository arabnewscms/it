<?php
namespace Phpanonymous\It\Controllers\Baboon\Api;

use App\Http\Controllers\Controller;
use Phpanonymous\It\Controllers\Baboon\BaboonSchema;

class BaboonUpdateApi extends Controller {

	public static $copyright = '[It V 1.5.0 | https://it.phpanonymous.com]';

	public static function showMethod($r) {
		$show = '
            /**
             * Display the specified resource.
             * Baboon Script By ' . self::$copyright . '
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $show =  {ModelName}::find($id);
';
		$show .= '                 return response()->json([
              "status"=>true,
              "data"=> $show
              ]);  ;
            }' . "\n";

		$show = str_replace('{lang}', $r->input('lang_file'), $show);
		$show = str_replace('{ModelName}', $r->input('model_name'), $show);

		return $show;
	}

	public static function updateMethod($r) {
		$objectlist = [];
		$update = '
            /**
             * Baboon Script By ' . self::$copyright . '
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function update($id)
            {
                $rules = [' . "\n";
		$update .= '' . self::rules($r) . "\n";
		$update .= '                         ];
             $data = Validator::make(request()->all(),$rules,[],[' . "\n";
		$update .= '' . self::SetAttributeNames($r);
		$update .= '                   ]);' . "\n";
		$update .= '             if($data->fails()){' . "\n";
		$update .= '             return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
               ]); ' . "\n";
		$update .= '             }' . "\n";
		$update .= '             $data = request()->except(["_token"]);' . "\n";

		if ($r->has('has_user_id')) {
			$update .= '              $data[\'user_id\'] = auth()->user()->id; ' . "\n";
		}
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			$objectlist = [];
			if ($r->input('col_type')[$i] == 'file') {
				$update .= '               if(request()->hasFile(\'' . $conv . '\')){' . "\n";
				$folder = str_replace('controller', '', strtolower($r->input('controller_name')));
				$update .= '              it()->delete({ModelName}::find($id)->' . $conv . ');' . "\n";
				$update .= '              $data[\'' . $conv . '\'] = it()->upload(\'' . $conv . '\',\'' . $folder . '\');' . "\n";
				$update .= '               }' . "\n";
			}
			$i++;
		}

		$update .= '              {ModelName}::where(\'id\',$id)->update($data);' . "\n";
		$update .= '
              ${ModelName} = {ModelName}::find($id);

              return response()->json([
               "status"=>true,
               "message"=>trans(\'{lang}.updated\'),
               "data"=> ${ModelName}
               ]);
            }';

		$update = str_replace('{ModelName}', $r->input('model_name'), $update);
		$update = str_replace('{lang}', $r->input('lang_file'), $update);

		return $update;
	}

	public static function SetAttributeNames($r) {
		$SetAttributeNames = '';
		foreach ($r->input('col_name_convention') as $conv) {
			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$pre_conv = explode('|', $conv);
				$SetAttributeNames .= '             \'' . $pre_conv[0] . '\'=>trans(\'{lang}.' . $pre_conv[0] . '\'),' . "\n";
			} elseif (preg_match('/#/i', $conv)) {
				$pre_conv = explode('#', $conv);
				if (!preg_match('/' . $pre_conv[0] . '/', $SetAttributeNames)) {

					$SetAttributeNames .= '             \'' . $pre_conv[0] . '\'=>trans(\'{lang}.' . $pre_conv[0] . '\'),' . "\n";
				}
			} else {
				$SetAttributeNames .= '             \'' . $conv . '\'=>trans(\'{lang}.' . $conv . '\'),' . "\n";
			}
		}
		$SetAttributeNames = str_replace('{lang}', $r->input('lang_file'), $SetAttributeNames);
		return $SetAttributeNames;
	}

	public static function rules($r) {
		$rule = '';
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			$valrule = '';

			if ($r->input('col_name_null' . $i) == 'has') {

				$r->has('required' . $i) ? $valrule .= 'required|' : '';
				$r->has('image' . $i) ? $valrule .= "'.it()->image().'|" : '';
				$r->has('numeric' . $i) ? $valrule .= 'numeric|' : '';
				$r->has('email' . $i) ? $valrule .= 'email|' : '';
				$r->has('url' . $i) ? $valrule .= 'url|' : '';
				$r->has('nullable' . $i) ? $valrule .= 'nullable|' : '';
				$r->has('sometimes' . $i) ? $valrule .= 'sometimes|' : '';
				$r->has('confirmed' . $i) ? $valrule .= 'confirmed|' : '';

				$r->has('string' . $i) ? $valrule .= 'string|' : '';
				$r->has('alpha-dash' . $i) ? $valrule .= 'alpha-dash|' : '';

				if ($r->has('exists_table' . $i) && !empty($r->input('exists_table' . $i))) {
					if ($r->input('exists_table' . $i) != 'without check Exist') {
						$modelname = explode('\\', $r->input('exists_table' . $i));
						$tableName = $modelname[count($modelname) - 1];
						$convname = BaboonSchema::convention_name($tableName);
						$valrule .= 'exists:' . $convname . '|';
					}
				}

				////////// Date Validation Laravel ///////////////////////////////////////////////
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
				////////// Date Validation Laravel ///////////////////////////////////////////////

			} else {
				if ($r->has('col_type')[$i] == 'email') {
					$valrule .= 'email|';
				}
			}

			if ($r->has('col_type')[$i] == 'password' and $conv == 'password') {
				$valrule .= 'confirmed|';
			}

			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$pre_conv = explode('|', $conv);
				$rule .= '             \'' . $pre_conv[0] . '\'=>\'' . rtrim($valrule, '|') . '\',' . "\n";
			} elseif (preg_match('/#/i', $conv)) {

				$pre_conv = explode('#', $conv);
				if (!preg_match('/' . $pre_conv[0] . '/i', $rule)) {
					$rule .= '             \'' . $pre_conv[0] . '\'=>\'' . rtrim($valrule, '|') . '\',' . "\n";
				}

			} else {
				if ($r->has('image' . $i) and $r->has('image' . $i) == 1) {
					$rule .= '             \'' . $conv . '\'=>\'' . rtrim($valrule, '|"') . '\',' . "\n";
				} else {
					$rule .= '             \'' . $conv . '\'=>\'' . rtrim($valrule, '|') . '\',' . "\n";
				}
			}

			$i++;
		}
		return $rule;
	}

	public static function destroyMethod($r) {
		$objectlist = [];
		$destroy = '
            /**
             * Baboon Script By ' . self::$copyright . '
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               ${Name} = {ModelName}::find($id);
' . "\n";
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {

			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '               it()->delete(${Name}->' . $conv . ');' . "\n";
				$destroy .= '               it()->delete(\'{Name2}\',$id);' . "\n";
			}
			$i++;
		}
		$destroy .= '
               @${Name}->delete();
               return response(["status"=>true,"message"=>trans(\'{lang}.deleted\')]);
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input(\'selected_data\');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	${Name} = {ModelName}::find($id);
' . "\n";

		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '                    	it()->delete(${Name}->' . $conv . ');' . "\n";
				$destroy .= '                    	it()->delete(\'{Name2}\',$id);' . "\n";

			}
			$i++;
		}
		$destroy .= '                    	@${Name}->delete();
                    }
                    return response(["status"=>true,"message"=>trans(\'{lang}.deleted\')]);
                }else {
                    ${Name} = {ModelName}::find($data);
 ' . "\n";
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '                    	it()->delete(${Name}->' . $conv . ');' . "\n";
				$destroy .= '                    	it()->delete(\'{Name2}\',$data);' . "\n";

			}
			$i++;
		}
		$destroy .= '
                    @${Name}->delete();
                    return response(["status"=>true,"message"=>trans(\'{lang}.deleted\')]);
                }
            }

            ';
		$Name = str_replace('controller', '', strtolower($r->input('controller_name')));
		$destroy = str_replace('{ModelName}', $r->input('model_name'), $destroy);
		$destroy = str_replace('{lang}', $r->input('lang_file'), $destroy);
		$destroy = str_replace('{Name}', $Name, $destroy);
		$destroy = str_replace('{Name2}', strtolower($r->input('model_name')), $destroy);
		return $destroy;
	}

}
