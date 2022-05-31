<?php
namespace Phpanonymous\It\Controllers\Baboon\Api;

use App\Http\Controllers\Controller;
use Phpanonymous\It\Controllers\Baboon\BaboonRulesAndAttributes as BaboonAttr;

class BaboonUpdateApi extends Controller {

	public static function showMethod($r) {
		$show = '

            /**
             * Display the specified resource.
             * Baboon Api Script By ' . it_version_message() . '
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                ${ModelName} = {ModelName}::with($this->arrWith())->find($id,$this->selectColumns);
            	if(is_null(${ModelName}) || empty(${ModelName})){
            	 return errorResponseJson([
            	  "message"=>trans("{lang}.undefinedRecord")
            	 ]);
            	}

';
		$show .= '                 return successResponseJson([
              "data"=> ${ModelName}
              ]);  ;
            }' . "\n";

		$show = str_replace('{lang}', request('lang_file'), $show);
		$show = str_replace('{ModelName}', request('model_name'), $show);

		return $show;
	}

	public static function updateMethod($r) {
		$objectlist = [];
		$update = '
            /**
             * Baboon Api Script By ' . it_version_message() . '
             * update a newly created resource in storage.
             * @return \Illuminate\Http\Response
             */
            public function updateFillableColumns() {
				       $fillableCols = [];
				       foreach (array_keys((new ' . request('controller_name') . 'Request)->attributes()) as $fillableUpdate) {
  				        if (!is_null(request($fillableUpdate))) {
						  $fillableCols[$fillableUpdate] = request($fillableUpdate);
						}
				       }
  				     return $fillableCols;
  	     		}

            public function update(' . request('controller_name') . 'Request $request,$id)
            {
            	${ModelName} = {ModelName}::find($id);
            	if(is_null(${ModelName}) || empty(${ModelName})){
            	 return errorResponseJson([
            	  "message"=>trans("{lang}.undefinedRecord")
            	 ]);
  			       }

            	$data = $this->updateFillableColumns();
                 ' . "\n";

		if ($r->has('has_user_id')) {
			$update .= '              $data["user_id"] = auth()->id(); ' . "\n";
		}
		$i = 0;
		foreach (request('col_name_convention') as $conv) {
			$objectlist = [];
			if (checkIfExisitValue('api_show_column', $conv)) {
				if (request('col_type')[$i] == 'file') {
					$update .= '               if(request()->hasFile("' . $conv . '")){' . "\n";
					$folder = str_replace('controller', '', strtolower(request('controller_name')));
					$update .= '              it()->delete(${ModelName}->' . $conv . ');' . "\n";
					$update .= '              $data["' . $conv . '"] = it()->upload("' . $conv . '","' . $folder . '/".${ModelName}->id);' . "\n";
					$update .= '               }' . "\n";
				}
			}
			$i++;
		}

		$update .= '              {ModelName}::where("id",$id)->update($data);' . "\n";
		$update .= '
              ${ModelName} = {ModelName}::with($this->arrWith())->find($id,$this->selectColumns);
              return successResponseJson([
               "message"=>trans("{lang}.updated"),
               "data"=> ${ModelName}
               ]);
            }';

		$update = str_replace('{ModelName}', request('model_name'), $update);
		$update = str_replace('{lang}', request('lang_file'), $update);

		return $update;
	}

	public static function destroyMethod($r) {
		$objectlist = [];
		$destroy = '
            /**
             * Baboon Api Script By ' . it_version_message() . '
             * destroy a newly created resource in storage.
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               ${Name} = {ModelName}::find($id);
            	if(is_null(${Name}) || empty(${Name})){
            	 return errorResponseJson([
            	  "message"=>trans("{lang}.undefinedRecord")
            	 ]);
            	}

' . "\n";
		$i = 0;
		foreach (request('col_name_convention') as $conv) {

			if (!empty(request('col_type')[$i]) and request('col_type')[$i] == 'file') {
				$destroy .= '              if(!empty(${Name}->' . $conv . ')){' . "\n";
				$destroy .= '               it()->delete(${Name}->' . $conv . ');' . "\n";
				$destroy .= '              }' . "\n";
			}
			$i++;
		}
		$destroy .= '               it()->delete("{Name2}",$id);' . "\n";
		$destroy .= '
               ${Name}->delete();
               return successResponseJson([
                "message"=>trans("{lang}.deleted")
               ]);
            }



 			public function multi_delete()
            {
                $data = request("selected_data");
                if(is_array($data)){
                    foreach($data as $id){
                    ${Name} = {ModelName}::find($id);
	            	if(is_null(${Name}) || empty(${Name})){
	            	 return errorResponseJson([
	            	  "message"=>trans("{lang}.undefinedRecord")
	            	 ]);
	            	}
' . "\n";

		$i = 0;
		foreach (request('col_name_convention') as $conv) {
			if (!empty(request('col_type')[$i]) and request('col_type')[$i] == 'file') {
				$destroy .= '                    	if(!empty(${Name}->' . $conv . ')){' . "\n";
				$destroy .= '                    	it()->delete(${Name}->' . $conv . ');' . "\n";
				$destroy .= '                    	}' . "\n";

			}
			$i++;
		}
		$destroy .= '                    	it()->delete("{Name2}",$id);' . "\n";
		$destroy .= '                    	${Name}->delete();
                    }
                    return successResponseJson([
                     "message"=>trans("{lang}.deleted")
                    ]);
                }else {
                    ${Name} = {ModelName}::find($data);
	            	if(is_null(${Name}) || empty(${Name})){
	            	 return errorResponseJson([
	            	  "message"=>trans("{lang}.undefinedRecord")
	            	 ]);
	            	}
 ' . "\n";
		$i = 0;
		foreach (request('col_name_convention') as $conv) {
			if (!empty(request('col_type')[$i]) and request('col_type')[$i] == 'file') {
				$destroy .= '                    	if(!empty(${Name}->' . $conv . ')){' . "\n";
				$destroy .= '                    	it()->delete(${Name}->' . $conv . ');' . "\n";
				$destroy .= '                    	}' . "\n";

			}
			$i++;
		}
		$destroy .= '                    	it()->delete("{Name2}",$data);' . "\n";
		$destroy .= '
                    ${Name}->delete();
                    return successResponseJson([
                     "message"=>trans("{lang}.deleted")
                    ]);
                }
            }

            ';
// Dropzone Upload Start//
		$x = 0;
		$dz_rules = '';
		$dz_attribute = '';
		$dz_uploads = '';
		$dz_exisit = false;
		foreach ($r->input('col_type') as $col_type) {
			if ($col_type == 'dropzone') {
				$dz_exisit = true;
				$valrule = rtrim(BaboonAttr::ruleList($r, $x), '|"');

				$dropzone_name = request('col_name_convention')[$x];
				$dz_rules .= 'if(request()->hasFile("' . $dropzone_name . '")){
				$rules["' . $dropzone_name . '"] = "' . $valrule . '";
			}' . "\n";
				$dz_attribute .= '"' . $dropzone_name . '" => trans("{lang}.' . $dropzone_name . '"),' . "\n";

				$dz_uploads .= 'if(request()->hasFile("' . $dropzone_name . '")){
				it()->upload("' . $dropzone_name . '", request("dz_path"), "{Name}", request("dz_id"));
			}' . "\n";
			}
			$x++;
		}

		if ($dz_exisit) {
			$destroy .= '
	// Delete Files From Dropzone Library
	public function delete_file() {
		if (request("type_file") && request("type_id")) {
			if (it()->getFile(request("type_file"), request("type_id"))) {
				it()->delete(null, null, request("id"));
				return successResponseJson([]);
			}
		}
	}

	// Multi upload with dropzone
	public function multi_upload() {
			$rules = [];
			' . $dz_rules . '

			$this->validate(request(), $rules, [], [
				 ' . $dz_attribute . '
			]);

			' . $dz_uploads . '
			return successResponseJson([
				"type" => request("dz_type"),
				"file" => it()->getFile("{Name}", request("dz_id")),
			]);
	}';
		}
// Dropzone Upload End//

		$Name = str_replace('controller', '', strtolower(request('controller_name')));
		$destroy = str_replace('{ModelName}', request('model_name'), $destroy);
		$destroy = str_replace('{lang}', request('lang_file'), $destroy);
		$destroy = str_replace('{Name}', $Name, $destroy);
		$destroy = str_replace('{Name2}', strtolower(request('model_name')), $destroy);
		return $destroy;
	}

}
