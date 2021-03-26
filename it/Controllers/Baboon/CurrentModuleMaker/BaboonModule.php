<?php
namespace Phpanonymous\It\Controllers\Baboon\CurrentModuleMaker;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class BaboonModule extends Controller {
	protected $module;
	protected $file;
	protected $path = 'baboon/';
	protected $ext = '.baboon';

	/**
	 * Initializes the object.
	 */
	public function init() {
		// Set Module Name
		$this->module = 'BMaker_' . strtolower(request('controller_name')) . '_module';

		// Set Module Path
		$this->file = $this->path . $this->module . $this->ext;

		$data = [
			'module_name' => request('project_title'),
			'admin_folder_path' => request('admin_folder_path'),
			'model_namespace' => request('model_namespace'),
			'model_name' => request('model_name'),
			'controller_name' => request('controller_name'),
			'controller_namespace' => str_replace('\\\\', '\\', request('controller_namespace')),
			'fa_icon' => request('fa_icon'),
			'lang_file' => request('lang_file'),
			'use_collective' => !empty(request('use_collective')) ? 'checked' : '',
			'auto_migrate' => !empty(request('auto_migrate')) ? 'checked' : '',
			'make_model' => !empty(request('make_model')) ? 'checked' : '',
			'make_controller' => !empty(request('make_controller')) ? 'checked' : '',
			'make_views' => !empty(request('make_views')) ? 'checked' : '',
		];
		$this->write($this->initdata());
	}

	/**
	 * Made Objects
	 *
	 * @return     <json>  ( data to Make A new Object  )
	 */
	public function initdata() {

		$main_init = [
			'module_name' => request('project_title'),
			'admin_folder_path' => request('admin_folder_path'),
			'model_namespace' => request('model_namespace'),
			'model_name' => request('model_name'),
			'controller_name' => request('controller_name'),
			'controller_namespace' => request('controller_namespace'),
			'fa_icon' => request('fa_icon'),
			'lang_file' => request('lang_file'),
			'use_collective' => !empty(request('use_collective')) ? 'checked' : '',
			'auto_migrate' => !empty(request('auto_migrate')) ? 'checked' : '',
			'make_model' => !empty(request('make_model')) ? 'checked' : '',
			'make_controller' => !empty(request('make_controller')) ? 'checked' : '',
			'make_views' => !empty(request('make_views')) ? 'checked' : '',
			'enable_soft_delete' => !empty(request('enable_soft_delete')) ? 'checked' : '',
			'has_user_id' => !empty(request('has_user_id')) ? 'checked' : '',
			'make_migration' => !empty(request('make_migration')) ? 'checked' : '',
			'make_datatable' => !empty(request('make_datatable')) ? 'checked' : '',
			'relation_count' => !empty(request('schema_name')) && count(request('schema_name')) > 0 ? count(request('schema_name')) : 0,
			'relations' => $this->getRelations(),
			'count_inputs' => count(request('col_name_convention')),
			'inputs_columns' => $this->prepareInputs(),
		];

		return json_encode($main_init, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	}

	/**
	 * prepare all inputs
	 *
	 * @return     array
	 */
	public function prepareInputs() {
		$inputs = [];
		$x = 0;
		foreach (request('col_name_convention') as $conv) {
			$inputs['value_' . $x] = [
				'number' => $x,
				'col_name' => request('col_name')[$x],
				'col_type' => request('col_type')[$x],
				'col_name_convention' => request('col_name_convention')[$x],
				'col_name_null' . $x => request('col_name_null' . $x),
				'rules' => $this->getRules($x),
			];

			$x++;
		}
		return $inputs;
	}

	public function getRules($i) {
		$rules = [];
		$rules['required' . $i] = request()->has('required' . $i) ? 'checked' : '';
		$rules['image' . $i] = request()->has('image' . $i) ? 'checked' : '';
		$rules['numeric' . $i] = request()->has('numeric' . $i) ? 'checked' : '';
		$rules['email' . $i] = request()->has('email' . $i) ? 'checked' : '';
		$rules['url' . $i] = request()->has('url' . $i) ? 'checked' : '';
		$rules['sometimes' . $i] = request()->has('sometimes' . $i) ? 'checked' : '';
		$rules['filled' . $i] = request()->has('filled' . $i) ? 'checked' : '';
		$rules['nullable' . $i] = request()->has('nullable' . $i) ? 'checked' : '';
		$rules['confirmed' . $i] = request()->has('confirmed' . $i) ? 'checked' : '';
		$rules['integer' . $i] = request()->has('integer' . $i) ? 'checked' : '';
		$rules['active_url' . $i] = request()->has('active_url' . $i) ? 'checked' : '';
		$rules['accepted' . $i] = request()->has('accepted' . $i) ? 'checked' : '';
		$rules['boolean' . $i] = request()->has('boolean' . $i) ? 'checked' : '';
		$rules['uuid' . $i] = request()->has('uuid' . $i) ? 'checked' : '';
		$rules['bail' . $i] = request()->has('bail' . $i) ? 'checked' : '';
		$rules['file' . $i] = request()->has('file' . $i) ? 'checked' : '';
		$rules['present' . $i] = request()->has('present' . $i) ? 'checked' : '';
		$rules['timezone' . $i] = request()->has('timezone' . $i) ? 'checked' : '';
		$rules['json' . $i] = request()->has('json' . $i) ? 'checked' : '';
		$rules['array' . $i] = request()->has('array' . $i) ? 'checked' : '';
		$rules['ip' . $i] = request()->has('ip' . $i) ? 'checked' : '';
		$rules['ipv4' . $i] = request()->has('ipv4' . $i) ? 'checked' : '';
		$rules['ipv6' . $i] = request()->has('ipv6' . $i) ? 'checked' : '';
		$rules['string' . $i] = request()->has('string' . $i) ? 'checked' : '';
		$rules['alpha' . $i] = request()->has('alpha' . $i) ? 'checked' : '';
		$rules['alpha-dash' . $i] = request()->has('alpha-dash' . $i) ? 'checked' : '';
		$rules['alpha_num' . $i] = request()->has('alpha_num' . $i) ? 'checked' : '';
		$rules['required_if' . $i] = request()->has('required_if' . $i) ? ['checked', request('required_if_text' . $i)] : '';
		$rules['required_unless' . $i] = request()->has('required_unless' . $i) ? ['checked', request('required_unless_text' . $i)] : '';
		$rules['required_without' . $i] = request()->has('required_without' . $i) ? ['checked', request('required_without_text' . $i)] : '';
		$rules['required_with' . $i] = request()->has('required_with' . $i) ? ['checked', request('required_with_text' . $i)] : '';
		$rules['required_with_all' . $i] = request()->has('required_with_all' . $i) ? ['checked', request('required_with_all_text' . $i)] : '';
		$rules['required_without_all' . $i] = request()->has('required_without_all' . $i) ? ['checked', request('required_without_all_text' . $i)] : '';
		$rules['same' . $i] = request()->has('same' . $i) ? ['checked', request('same_text' . $i)] : '';
		$rules['size' . $i] = request()->has('size' . $i) ? ['checked', request('size_text' . $i)] : '';
		$rules['starts_with' . $i] = request()->has('starts_with' . $i) ? ['checked', request('starts_with_text' . $i)] : '';
		$rules['between' . $i] = request()->has('between' . $i) ? ['checked', request('between_text' . $i)] : '';
		$rules['digits_between' . $i] = request()->has('digits_between' . $i) ? ['checked', request('digits_between_text' . $i)] : '';
		$rules['different' . $i] = request()->has('different' . $i) ? ['checked', request('different_text' . $i)] : '';
		$rules['dimensions' . $i] = request()->has('dimensions' . $i) ? ['checked', request('dimensions_text' . $i)] : '';
		$rules['digits' . $i] = request()->has('digits' . $i) ? ['checked', request('digits_text' . $i)] : '';
		$rules['ends_with' . $i] = request()->has('ends_with' . $i) ? ['checked', request('ends_with_text' . $i)] : '';
		$rules['exclude_if' . $i] = request()->has('exclude_if' . $i) ? ['checked', request('exclude_if_text' . $i)] : '';
		$rules['exclude_unless' . $i] = request()->has('exclude_unless' . $i) ? ['checked', request('exclude_unless_text' . $i)] : '';
		$rules['gt' . $i] = request()->has('gt' . $i) ? ['checked', request('gt_text' . $i)] : '';
		$rules['gte' . $i] = request()->has('gte' . $i) ? ['checked', request('gte_text' . $i)] : '';
		$rules['lt' . $i] = request()->has('lt' . $i) ? ['checked', request('lt_text' . $i)] : '';
		$rules['lte' . $i] = request()->has('lte' . $i) ? ['checked', request('lte_text' . $i)] : '';
		$rules['max' . $i] = request()->has('max' . $i) ? ['checked', request('max_text' . $i)] : '';
		$rules['min' . $i] = request()->has('min' . $i) ? ['checked', request('min_text' . $i)] : '';
		$rules['multiple_of' . $i] = request()->has('multiple_of' . $i) ? ['checked', request('multiple_of_text' . $i)] : '';
		$rules['not_in' . $i] = request()->has('not_in' . $i) ? ['checked', request('not_in_text' . $i)] : '';
		$rules['not_regex' . $i] = request()->has('not_regex' . $i) ? ['checked', request('not_regex_text' . $i)] : '';
		$rules['regex' . $i] = request()->has('regex' . $i) ? ['checked', request('regex_text' . $i)] : '';
		$rules['mimetypes' . $i] = request()->has('mimetypes' . $i) ? ['checked', request('mimetypes_text' . $i)] : '';
		$rules['mimes' . $i] = request()->has('mimes' . $i) ? ['checked', request('mimes_text' . $i)] : '';
		$rules['in_array' . $i] = request()->has('in_array' . $i) ? ['checked', request('in_array_text' . $i)] : '';
		$rules['prohibited_if' . $i] = request()->has('prohibited_if' . $i) ? ['checked', request('prohibited_if_text' . $i)] : '';
		$rules['prohibited_unless' . $i] = request()->has('prohibited_unless' . $i) ? ['checked', request('prohibited_unless_text' . $i)] : '';
		$rules['unique' . $i] = request()->has('unique' . $i) ? ['checked', request('unique_text' . $i)] : '';
		$rules['exists_table' . $i] = request()->has('exists_table' . $i) ? ['selected', request('exists_table' . $i)] : '';

		$rules['date' . $i] = request()->has('date' . $i) && !empty(request('date' . $i)) ? ['checked',
			[
				'date_format' . $i => request('date_format' . $i),
				'after_before' . $i => $this->value('after_before' . $i),
				'before_after_tomorrow' . $i => $this->value('before_after_tomorrow' . $i),
				'other_cal_before_after' . $i => $this->value('other_cal_before_after' . $i),
				'other_carbon' . $i => $this->value('other_carbon' . $i),
			],
		] : '';

		$rules['forginkeyto' . $i] = request()->has('forginkeyto' . $i) ? [
			'checked',
			[
				'references' . $i => request('references' . $i),
				'forgin_table_name' . $i => request('forgin_table_name' . $i),
				'schema_onDelete' . $i => request()->has('schema_onDelete' . $i) ? 'checked' : '',
				'schema_nullable' . $i => request()->has('schema_nullable' . $i) ? 'checked' : '',
			],
		] : '';

		return $rules;
	}

	public function getRelations() {
		$relations = [];
		if (!empty(request('schema_name')) && count(request('schema_name')) > 0) {
			$x = 0;
			foreach (request('schema_name') as $schema) {
				$relations[] = [
					'schema_name' => request('schema_name')[$x],
					'linkatmodel' => request('linkatmodel')[$x],
					'relation_type' => request('relation_type')[$x],
				];

				$x++;
			}
		}
		return $relations;
	}

	public function value($input) {
		return request()->has($input) ? request($input) : '';
	}

	/**
	 * write Data
	 * @param      <text>  $write  The write
	 * @return     <bool>  ( to write text as text file )
	 */
	//$this->encode($write)
	public function write($write) {
		return Storage::disk('local')->put($this->file, $this->encode($write));
	}

	/**
	 * read a module after created
	 *
	 * @return     <string or bool>  ( to read data from baboon File )
	 */
	public function read($file) {
		if ($this->exist($file)) {
			$content = $this->decode(Storage::disk('local')
					->get($file));
			return $content;
		} else {
			return false;
		}
	}

	/**
	 * check to exists file
	 * @return  <bool>
	 */
	public function exist($file) {
		return Storage::disk('local')->exists($file);
	}

	/**
	 * get size
	 *
	 * @return     <int>  ( to get size )
	 */
	public function size($file) {
		return Storage::disk('local')->size($file);
	}

	/**
	 * get last Modified
	 *
	 * @return     <date>  ( to get last Modified Date as Date )
	 */
	public function lastModified($file) {
		return Storage::disk('local')->lastModified($file);
	}

	/**
	 * get all Modules Files
	 *
	 * @return     <array>  ( to get all Files as array )
	 */
	public function getAllModules() {
		$modules = Storage::disk('local')->files($this->path); // allFiles method
		$view_module = [];
		foreach ($modules as $module) {
			$read = $this->read($module);
			//return dd($read->module_name);
			if ($read !== false) {
				$view_module[] = [
					'module_name' => $read->module_name,
					'file' => explode('/', $module)[1],
					'size' => $this->size($module),
					'lastModified' => $this->lastModified($module),
				];
			}
		}

		return $view_module;
	}

	/**
	 * Deletes the file
	 *
	 * @return     <bool>  ( to delete module )
	 */
	public function delete() {
		return Storage::disk('local')->delete($this->file);
	}

	/**
	 * encode String
	 *
	 * @param      <string>  $str    The string
	 *
	 * @return     <string>  ( to Crypt String )
	 */
	public function encode($str) {
		return base64_encode($str);
	}

	/**
	 * decode string
	 *
	 * @param      <string>  $str    The string
	 *
	 * @return     <string>  ( to Decrypt String )
	 */
	public function decode($str) {
		$decode = base64_decode($str);
		return json_decode($decode);
	}

}