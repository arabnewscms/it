<?php
namespace Phpanonymous\It\Controllers\Baboon\Api;

use App\Http\Controllers\Controller;

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
                ${ModelName} = {ModelName}::find($id);
            	if(is_null(${ModelName}) || empty(${ModelName})){
            	 return errorResponseJson([]);
            	}

';
		$show .= '                 return response([
              "status"=>true,
              "statusCode"=>200,
              "data"=> ${ModelName}
              ],200);  ;
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
            public function update(' . $r->input('controller_name') . 'Request $request,$id)
            {
            	${ModelName} = {ModelName}::find($id);
            	if(is_null(${ModelName}) || empty(${ModelName})){
            	 return errorResponseJson([]);
            	}
                 ' . "\n";

		if ($r->has('has_user_id')) {
			$update .= '              $data[\'user_id\'] = auth()->id(); ' . "\n";
		}
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			$objectlist = [];
			if ($r->input('col_type')[$i] == 'file') {
				$update .= '               if(request()->hasFile(\'' . $conv . '\')){' . "\n";
				$folder = str_replace('controller', '', strtolower($r->input('controller_name')));
				$update .= '              it()->delete(${ModelName}->' . $conv . ');' . "\n";
				$update .= '              $data[\'' . $conv . '\'] = it()->upload(\'' . $conv . '\',\'' . $folder . '\');' . "\n";
				$update .= '               }else{' . "\n";
				$update .= '                $data[\'' . $conv . '\'] = "";' . "\n";
				$update .= '               }' . "\n";
			}
			$i++;
		}

		$update .= '              {ModelName}::where(\'id\',$id)->update($data);' . "\n";
		$update .= '


              return response([
               "status"=>true,
               "statusCode"=>200,
               "message"=>trans(\'{lang}.updated\'),
               "data"=> ${ModelName}
               ],200);
            }';

		$update = str_replace('{ModelName}', $r->input('model_name'), $update);
		$update = str_replace('{lang}', $r->input('lang_file'), $update);

		return $update;
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
            	if(is_null(${Name}) || empty(${Name})){
            	 return errorResponseJson([]);
            	}

' . "\n";
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {

			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '              if(!empty(${Name}->' . $conv . ')){' . "\n";
				$destroy .= '               it()->delete(${Name}->' . $conv . ');' . "\n";
				$destroy .= '              }' . "\n";
			}
			$i++;
		}
		$destroy .= '               it()->delete(\'{Name2}\',$id);' . "\n";
		$destroy .= '
               ${Name}->delete();
               return response(["status"=>true,"statusCode"=>200,"message"=>trans(\'{lang}.deleted\')],200);
            }



 			public function multi_delete()
            {
                $data = request(\'selected_data\');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    ${Name} = {ModelName}::find($id);
	            	if(is_null(${Name}) || empty(${Name})){
	            	 return errorResponseJson([]);
	            	}
' . "\n";

		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '                    	if(!empty(${Name}->' . $conv . ')){' . "\n";
				$destroy .= '                    	it()->delete(${Name}->' . $conv . ');' . "\n";
				$destroy .= '                    	}' . "\n";

			}
			$i++;
		}
		$destroy .= '                    	it()->delete(\'{Name2}\',$id);' . "\n";
		$destroy .= '                    	@${Name}->delete();
                    }
                    return response(["status"=>true,"statusCode"=>200,"message"=>trans(\'{lang}.deleted\')]);
                }else {
                    ${Name} = {ModelName}::find($id);
	            	if(is_null(${Name}) || empty(${Name})){
	            	 return errorResponseJson([]);
	            	}
 ' . "\n";
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if (!empty($r->input('col_type')[$i]) and $r->input('col_type')[$i] == 'file') {
				$destroy .= '                    	if(!empty(${Name}->' . $conv . ')){' . "\n";
				$destroy .= '                    	it()->delete(${Name}->' . $conv . ');' . "\n";
				$destroy .= '                    	}' . "\n";

			}
			$i++;
		}
		$destroy .= '                    	it()->delete(\'{Name2}\',$data);' . "\n";
		$destroy .= '
                    ${Name}->delete();
                    return response(["status"=>true,"statusCode"=>200,"message"=>trans(\'{lang}.deleted\')],200);
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
