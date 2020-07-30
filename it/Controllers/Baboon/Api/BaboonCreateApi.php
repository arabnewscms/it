<?php
namespace Phpanonymous\It\Controllers\Baboon\Api;

use App\Http\Controllers\Controller;
use Phpanonymous\It\Controllers\Baboon\BaboonSchema;

class BaboonCreateApi extends Controller {
	public static $copyright = '[It V 1.2 | https://it.phpanonymous.com]';

	public static function indexMethod($r) {
		$index = '
            /**
             * Baboon Script By '.self::$copyright.'
             * Display a listing of the resource. Api
             * @return \Illuminate\Http\Response
             */
            public function index()
            {
               return response()->json([
               "status"=>true,
               "data"=>{ModelName}::orderBy(\'id\',\'desc\')->paginate(15)
               ]);
            }'."\n";

		return str_replace('{ModelName}', $r->input('model_name'), $index);
	}

	public static function storeMethod($r) {
		$objectlist = [];
		$store      = '
            /**
             * Baboon Script By '.self::$copyright.'
             * Store a newly created resource in storage. Api
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
    public function store()
    {
        $rules = ['."\n";
		$store .= '            '.self::rules($r);
		$store .= '        ];
        $data = Validator::make(request()->all(),$rules,[],['."\n";
		$store .= '            '.self::SetAttributeNames($r);
		$store .= '        ]);
		'."\n";
		$store .= '        if($data->fails()){'."\n";
		$store .= '            return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
            ]); '."\n";
		$store .= '             }'."\n";

		$store .= '        $data = request()->except(["_token"]);'."\n";
		if ($r->has('has_user_id')) {
			$store .= '              $data[\'user_id\'] = auth()->user()->id; '."\n";
		}

		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			$objectlist = [];
			if ($r->input('col_type')[$i] == 'file') {
				$store .= '               if(request()->hasFile(\''.$conv.'\')){'."\n";
				$folder = str_replace('controller', '', strtolower($r->input('controller_name')));

				$store .= '              $data[\''.$conv.'\'] = it()->upload(\''.$conv.'\',\''.$folder.'\');'."\n";
				$store .= '              }'."\n";
			}
			$i++;
		}

		$store .= '        $create = {ModelName}::create($data); '."\n";
		$store .= '
        return response()->json([
            "status"=>true,
            "message"=>trans(\'{lang}.added\'),
            "data"=>$create
        ]);
    }';
		$store = str_replace('{ModelName}', $r->input('model_name'), $store);
		$store = str_replace('{lang}', $r->input('lang_file'), $store);

		return $store;
	}

	public static function SetAttributeNames($r) {
		$SetAttributeNames = '';
		foreach ($r->input('col_name_convention') as $conv) {
			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$pre_conv = explode('|', $conv);
				$SetAttributeNames .= '             \''.$pre_conv[0].'\'=>trans(\'{lang}.'.$pre_conv[0].'\'),'."\n";
			} elseif (preg_match('/#/i', $conv)) {
				$pre_conv = explode('#', $conv);
				if (!preg_match('/'.$pre_conv[0].'/', $SetAttributeNames)) {

					$SetAttributeNames .= '             \''.$pre_conv[0].'\'=>trans(\'{lang}.'.$pre_conv[0].'\'),'."\n";
				}
			} else {
				$SetAttributeNames .= '             \''.$conv.'\'=>trans(\'{lang}.'.$conv.'\'),'."\n";
			}
		}
		$SetAttributeNames = str_replace('{lang}', $r->input('lang_file'), $SetAttributeNames);
		return $SetAttributeNames;
	}

	public static function rules($r) {
		$rule = '';
		$i    = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			$valrule = '';

			if ($r->input('col_name_null'.$i) == 'has') {

				$r->has('required'.$i)?$valrule .= 'required|':'';
				$r->has('image'.$i)?$valrule .= "'.it()->image().'|":'';
				$r->has('numeric'.$i)?$valrule .= 'numeric|':'';
				$r->has('email'.$i)?$valrule .= 'email|':'';
				$r->has('url'.$i)?$valrule .= 'url|':'';
				$r->has('nullable'.$i)?$valrule .= 'nullable|':'';
				$r->has('sometimes'.$i)?$valrule .= 'sometimes|':'';
				$r->has('confirmed'.$i)?$valrule .= 'confirmed|':'';

				$r->has('string'.$i)?$valrule .= 'string|':'';
				$r->has('alpha-dash'.$i)?$valrule .= 'alpha-dash|':'';

				if ($r->has('exists_table'.$i) && !empty($r->input('exists_table'.$i))) {
					if ($r->input('exists_table'.$i) != 'without check Exist') {
						$modelname = explode('\\', $r->input('exists_table'.$i));
						$tableName = $modelname[count($modelname)-1];
						$convname  = BaboonSchema::convention_name($tableName);
						$valrule .= 'exists:'.$convname.'|';
					}
				}

				////////// Date Validation Laravel ///////////////////////////////////////////////
				$r->has('date'.$i)?$valrule .= 'date|':'';
				$r->has('date_format'.$i)?$valrule .= $r->input('date_format'.$i) != 'NULL'?$r->input('date_format'.$i).'|':'':'';

				if ($r->input('before_after_tomorrow'.$i) == 'today' || $r->input('before_after_tomorrow'.$i) == 'tomorrow') {
					$radio_after_before = $r->input('before_after_tomorrow'.$i);
				} elseif ($r->input('before_after_tomorrow'.$i) == 'other_col') {
					$radio_after_before = $r->input('other_cal_before_after'.$i);
				} elseif ($r->input('before_after_tomorrow'.$i) == 'other_carbon') {
					$radio_after_before = "'.Carbon::now()->addDays(".$r->input('other_carbon'.$i).")->toDateString().'";
				}
				$r->has('after_before'.$i)?$valrule .= $r->input('after_before'.$i).':'.$radio_after_before.'|':'';
				////////// Date Validation Laravel ///////////////////////////////////////////////

			} else {
				$r->input('col_type')[$i] == 'email'?$valrule .= 'email|':'';
			}

			$r->input('col_type')[$i] == 'password' and
			$conv == 'password'?
			$valrule .= 'confirmed|':'';

			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$pre_conv = explode('|', $conv);
				$rule .= '             \''.$pre_conv[0].'\'=>\''.rtrim($valrule, '|').'\','."\n";
			} elseif (preg_match('/#/i', $conv)) {

				$pre_conv = explode('#', $conv);
				if (!preg_match('/'.$pre_conv[0].'/i', $rule)) {
					$rule .= '             \''.$pre_conv[0].'\'=>\''.rtrim($valrule, '|').'\','."\n";
				}

			} else {
				if ($r->has('image'.$i) and $r->has('image'.$i) == 1) {
					$rule .= '             \''.$conv.'\'=>\''.rtrim($valrule, '|"').'\','."\n";
				} else {
					$rule .= '             \''.$conv.'\'=>\''.rtrim($valrule, '|').'\','."\n";
				}
			}

			$i++;
		}
		return $rule;
	}

}
