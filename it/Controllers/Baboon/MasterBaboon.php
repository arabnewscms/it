<?php
namespace Phpanonymous\It\Controllers\Baboon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Phpanonymous\It\Controllers\Baboon\Api\BaboonCreateApi;
use Phpanonymous\It\Controllers\Baboon\Api\BaboonUpdateApi;
use Phpanonymous\It\Controllers\Baboon\BaboonCreate;
use Phpanonymous\It\Controllers\Baboon\BaboonSchema;
use Phpanonymous\It\Controllers\Baboon\BaboonUpdate;

class MasterBaboon extends Controller {
	//
	static $full_path = '';

	public static function makeController($r, $namespace, $model, $classname) {
		$routename = strtolower($classname);
		$controller = '<?php
namespace {Space};
use App\Http\Controllers\Controller;
use App\DataTables\{ClassName2}DataTable;
use Carbon\Carbon;
use {Model};

use App\Http\Controllers\Validations\{ClassName}Request;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  ' . it_version_message() . '
// Copyright Reserved  ' . it_version_message() . '
class {ClassName} extends Controller
{

	public function __construct() {

		$this->middleware(\'AdminRole:' . $routename . '_show\', [
			\'only\' => [\'index\', \'show\'],
		]);
		$this->middleware(\'AdminRole:' . $routename . '_add\', [
			\'only\' => [\'create\', \'store\'],
		]);
		$this->middleware(\'AdminRole:' . $routename . '_edit\', [
			\'only\' => [\'edit\', \'update\'],
		]);
		$this->middleware(\'AdminRole:' . $routename . '_delete\', [
			\'only\' => [\'destroy\', \'multi_delete\'],
		]);
	}

	' . "\n";
		$controller .= BaboonCreate::indexMethod($r) . "\n";
		$controller .= BaboonCreate::createMethod($r) . "\n";
		$controller .= BaboonCreate::storeMethod($r) . "\n";
		$controller .= BaboonUpdate::showMethod($r) . "\n";
		$controller .= BaboonUpdate::editMethod($r) . "\n";
		$controller .= BaboonUpdate::updateMethod($r) . "\n";
		$controller .= BaboonUpdate::destroyMethod($r) . "\n";
		$controller .= '}';
		$controller = str_replace('{Space}', $namespace, $controller);
		$controller = str_replace('{Model}', $model, $controller);
		$controller = str_replace('{ClassName}', $classname, $controller);
		$classname = str_replace('Controller', '', $classname);
		$classname = str_replace('controller', '', $classname);
		$controller = str_replace('{ClassName2}', $classname, $controller);
		return $controller;
	}

	public static function makeControllerApi($r, $namespace, $model, $classname) {
		$controller = '<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use {Model};
use Validator;
use App\Http\Controllers\ValidationsApi\V1\{ClassName}Request;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  ' . it_version_message() . '
// Copyright Reserved  ' . it_version_message() . '
class {ClassName}Api extends Controller{' . "\n";
		$controller .= '	protected $selectColumns = [' . "\n";
		$selectColumns = '		"id",' . "\n";
		$i = 0;
		foreach (request('col_name_convention') as $conv) {
			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$pre_conv = explode('|', $conv);
				if (checkIfExisitValue('api_show_column', $pre_conv[0])) {
					$selectColumns .= '		"' . $pre_conv[0] . '",' . "\n";
				}
			} elseif (preg_match('/#/i', $conv)) {
				$pre_conv = explode('#', $conv);
				if (!preg_match('/' . $pre_conv[0] . '/i', $selectColumns)) {
					if (checkIfExisitValue('api_show_column', $pre_conv[0])) {
						$selectColumns .= '		"' . $pre_conv[0] . '",' . "\n";
					}
				}
			} elseif (request('image' . $i) and request('image' . $i) == 1) {
				if (request('col_type')[$i] != 'dropzone') {
					if (checkIfExisitValue('api_show_column', $conv)) {
						$selectColumns .= '		"' . $conv . '",' . "\n";
					}
				}
			} else {
				if (request('col_type')[$i] != 'dropzone') {
					if (checkIfExisitValue('api_show_column', $conv)) {
						$selectColumns .= '		"' . $conv . '",' . "\n";
					}
				}
			}
			$i++;
		}
		$controller .= "" . $selectColumns . "	];" . "\n";
		$controller .= BaboonCreateApi::indexMethod($r) . "\n";
		$controller .= BaboonCreateApi::storeMethod($r) . "\n";
		$controller .= BaboonUpdateApi::showMethod($r) . "\n";
		$controller .= BaboonUpdateApi::updateMethod($r) . "\n";
		$controller .= BaboonUpdateApi::destroyMethod($r) . "\n";

		$controller .= '}';
		//$controller = str_replace('{Space}', $namespace, $controller);
		$controller = str_replace('{Model}', $model, $controller);
		$controller = str_replace('{ClassName}', $classname, $controller);
		$classname = str_replace('Controller', '', $classname);
		$classname = str_replace('controller', '', $classname);
		$controller = str_replace('{ClassName2}', $classname, $controller);
		return $controller;
	}

	public static function convention($string) {
		$newstring = explode('_', $string);
		if (count($newstring) > 0) {
			$word = '';
			foreach ($newstring as $n) {
				$word .= ucfirst($n);
			}
			return $word;
		} else {
			return ucfirst($string);
		}
	}

	public static function get_cols($r) {
		$cols = '';
		$i = 0;
		if ($r->has('schema_name')) {
			$i = 0;
			$schema_null = $r->input('schema_null');
			foreach ($r->input('schema_name') as $schema_name) {
				if (!empty($schema_null[$i])) {
					$cols .= "        '" . $schema_name . "'," . "\n";
				} else {
					//$cols .= "        '" . $schema_name . "'," . "\n";
				}
				$i++;
			}
		}
		$i = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$cols .= self::enum($conv, $i, $r) . "\n";
			} elseif (preg_match('/#/i', $conv)) {
				$pre_conv = explode('#', $conv);
				if (!preg_match('/' . $pre_conv[0] . '/i', $cols)) {
					$cols .= self::check_radio($conv, $i, $r) . "\n";
				}
			} elseif ($r->input('col_type')[$i] != 'dropzone') {
				$cols .= self::str_num($conv, $i, $r) . "\n";
			}
			$i++;
		}
		return $cols;
	}

	public static function check_radio($name, $i, $r) {
		$name = explode('#', $name);
		return "        '" . $name[0] . "',";
	}

	public static function str_num($name, $i, $r) {
		return "        '" . $name . "',";
	}

	public static function enum($name, $i, $r) {
		$pre_name = explode('|', $name);
		$pre_name2 = explode('/', $pre_name[1]);
		$cols = "        '" . $pre_name[0] . "'," . "\n";
		return $cols;
	}

	public static function makeModel($namespace, $classname) {
		$model = '<?php
namespace {Space};
use Illuminate\Database\Eloquent\Model;
';
		if (request()->has('enable_soft_delete')) {
			$model .= 'use Illuminate\Database\Eloquent\SoftDeletes;' . "\n\r";
		}
		$model .= '
// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  ' . it_version_message() . '
// Copyright Reserved  ' . it_version_message() . '
class {ClassName} extends Model {' . "\n\r";
		if (request()->has('enable_soft_delete')) {
			$model .= '	use SoftDeletes;' . "\r\n";
			$model .= '	protected $dates = [\'deleted_at\'];' . "\r\n";
		}
		$model .= '
protected $table    = \'{TBLNAME}\';
protected $fillable = [' . "\n";
		$model .= "		'id'," . "\n";
		$model .= '		' . request()->has('has_user_id') ? "		'admin_id'," . "\n" : "" . "\n";
		$model .= "" . self::get_cols(request());
		$model .= "		'created_at'," . "\n";
		$model .= "		'updated_at'," . "\n";
		if (request()->has('enable_soft_delete')) {
			$model .= "		'deleted_at'," . "\n";
		}
		$model .= '	];' . "\n";
		if (request()->has('has_user_id')) {
			$model .= '
	/**
	 * admin id relation method to get how add this data
	 * @type hasOne
	 * @param void
	 * @return object data
	 */
   public function admin_id() {
	   return $this->hasOne(\App\Models\Admin::class, \'id\', \'admin_id\');
   }
	' . "\n";
		}
		$model = str_replace('{Space}', $namespace, $model);
		$model = str_replace('{ClassName}', $classname, $model);
		$model = str_replace('{TBLNAME}', self::convention_name($classname), $model);
		if (request()->has('linkatmodel')) {
			$i = 0;
			foreach (request('linkatmodel') as $linkat) {
				$linkat_final = !preg_match('/::class/i', $linkat) ? '\'\\' . $linkat . '\'' : $linkat;
				$model .= '
	/**
    * ' . request('schema_name')[$i] . ' relation method
    * @param void
    * @return object data
    */
   public function ' . request('schema_name')[$i] . '(){
      return $this->' . request('relation_type')[$i] . '(\\' . $linkat_final . ',\'id\',\'' . request('schema_name')[$i] . '\');
   }
';
				$i++;
			}
		}
		$model .= '
 	/**
    * Static Boot method to delete or update or sort Data
    * @param void
    * @return void
    */
   protected static function boot() {
      parent::boot();
      // if you disable constraints should by run this static method to Delete children data
         static::deleting(function($' . strtolower($classname) . ') {' . "\n";
		if (request()->has('linkatmodel')) {
			$x = 0;
			foreach (request('linkatmodel') as $linkat) {
				$model .= '			//$' . strtolower($classname) . '->' . request('schema_name')[$x] . '()->delete();' . "\n";
			}
		}
		$model .= '         });
   }
		';
		$model .= '
}
';
		return $model;
	}

	public static function migrate($r) {
		return BaboonSchema::migrate($r);
	}

	public static function write($data, $filename, $namespace) {
		$file =
			fopen(base_path(
			static::$full_path . '/' .
			str_replace('\\', '/', str_replace('App', 'app', $namespace))
			. '/' . $filename . '.php')
			, "w");
		fwrite($file, $data);
		fclose($file);
	}

	public static function check_path($path) {
		$path = explode('\\', $path);
		$full_path = '';
		$checkpath = '';
		if (!is_dir(base_path($checkpath))) {
			mkdir(base_path($checkpath), 0755);
		}

		foreach ($path as $p) {
			if ('App' == $p) {
				$full_path .= strtolower($p) . '/';
			} else {
				$full_path .= $p . '/';
			}
			if (!is_dir(base_path($full_path)) || !file_exists(base_path($full_path))) {

				mkdir(base_path($full_path), 0755);
			}
		}
		return true;
	}

	public static function convention_name($string) {
		$conv = strtolower(ltrim(preg_replace('/(?<!\ )[A-Z]/', '_$0', $string), '_'));
		if (!in_array(substr($conv, -1), ['s'])) {
			if (substr($conv, -1) == 'y') {
				$conv = substr($conv, 0, -1) . 'ies';
			} else {
				$conv = $conv . 's';
			}
		}
		return $conv;
	}

	public static function fileType($i) {
		if (!empty(request('pdf' . $i))) {
			return 'pdf';
		} elseif (!empty(request('office' . $i))) {
			return 'office';
		} elseif (!empty(request('xls' . $i))) {
			return 'xls';
		} elseif (!empty(request('xlsx' . $i))) {
			return 'xlsx';
		} elseif (!empty(request('xltx' . $i))) {
			return 'xltx';
		} elseif (!empty(request('ppt' . $i))) {
			return 'ppt';
		} elseif (!empty(request('ppam' . $i))) {
			return 'ppam';
		} elseif (!empty(request('pptm' . $i))) {
			return 'pptm';
		} elseif (!empty(request('sldm' . $i))) {
			return 'sldm';
		} elseif (!empty(request('ppsm' . $i))) {
			return 'ppsm';
		} elseif (!empty(request('potm' . $i))) {
			return 'potm';
		} elseif (!empty(request('docx' . $i))) {
			return 'docx';
		} elseif (!empty(request('mp4' . $i))) {
			return 'mp4';
		} elseif (!empty(request('mpeg' . $i))) {
			return 'mpeg';
		} elseif (!empty(request('mov' . $i))) {
			return 'mov';
		} elseif (!empty(request('3gp' . $i))) {
			return '3gp';
		} elseif (!empty(request('webm' . $i))) {
			return 'webm';
		} elseif (!empty(request('mkv' . $i))) {
			return 'mkv';
		} elseif (!empty(request('wmv' . $i))) {
			return 'wmv';
		} elseif (!empty(request('avi' . $i))) {
			return 'avi';
		} elseif (!empty(request('vob' . $i))) {
			return 'vob';
		} elseif (!empty(request('video' . $i))) {
			return 'video';
		} elseif (!empty(request('audio' . $i))) {
			return 'audio';
		} elseif (!empty(request('mp3' . $i))) {
			return 'mp3';
		} elseif (!empty(request('wav' . $i))) {
			return 'wav';
		} elseif (!empty(request('xm' . $i))) {
			return 'xm';
		} elseif (!empty(request('ogg' . $i))) {
			return 'ogg';
		} elseif (!empty(request('adp' . $i))) {
			return 'adp';
		} elseif (!empty(request('image' . $i))) {
			return 'image';
		} else {
			return '';
		}
	}

	public static function includeAjax($type) {
		$route = strtolower(request('controller_name'));
		$ajax = '';
		$i = 0;
		if ($type == 'create') {
			foreach (request('col_name_convention') as $input) {
				if (!empty(request('link_ajax' . $i)) && request('link_ajax' . $i) == 'yes') {
					$explode_name = explode('|', $input);
					$col_name = count($explode_name) > 0 ? $explode_name[0] : $input;
					$explode_connect = explode('|', request('select_ajax_link' . $i));
					$connect_name = count($explode_connect) > 0 ? $explode_connect[0] : request('select_ajax_link' . $i);
					$ajax .= '@include(\'admin.ajax\',[
	\'typeForm\'=>\'create\',
	\'selectID\'=>\'' . $connect_name . '\',
	\'outputClass\'=>\'' . $col_name . '\',
	\'url\'=>aurl(\'' . $route . '/get/' . str_replace('_', '/', $col_name) . '\'),
])' . "\n";
				}
				$i++;
			}
		} elseif ($type == 'edit') {
			foreach (request('col_name_convention') as $input) {
				if (!empty(request('link_ajax' . $i)) && request('link_ajax' . $i) == 'yes') {
					$explode_name = explode('|', $input);
					$col_name = count($explode_name) > 0 ? $explode_name[0] : $input;
					$explode_connect = explode('|', request('select_ajax_link' . $i));
					$connect_name = count($explode_connect) > 0 ? $explode_connect[0] : request('select_ajax_link' . $i);
					$ajax .= '@include(\'admin.ajax\',[
	\'typeForm\'=>\'edit\',
	\'selectID\'=>\'' . $connect_name . '\',
	\'parentValue\'=>$' . $route . '->' . $connect_name . ',
	\'outputClass\'=>\'' . $col_name . '\',
	\'selectedvalue\'=>$' . $route . '->' . $col_name . ',
	\'url\'=>aurl(\'' . $route . '/get/' . str_replace('_', '/', $col_name) . '\'),
])' . "\n";
				}
				$i++;
			}
		}
		return $ajax;
	}

	public static function inputsCreate($r) {
		$blade_path = str_replace('resources.views.', '', str_replace('/', '.', $r->input('admin_folder_path')));
		$route = strtolower($r->input('controller_name'));
		$route = str_replace('controller', '', $route);

		// Ajax Request Form
		if (!empty(request('ajax_request')) && request('ajax_request') == 'yes') {
			$ajax_request_component = '@include("' . $blade_path . '.layouts.components.submit_form_ajax",["form"=>"#{route2}"])';
		} else {
			$ajax_request_component = '';
		}

		$input = '@extends(\'' . $blade_path . '.index\')
@section(\'content\')
' . self::includeAjax('create') . '
' . $ajax_request_component . '
<div class="card card-dark">
	<div class="card-header">
		<h3 class="card-title">
		<div class="">
			<span>
			{{ !empty($title)?$title:\'\' }}
			</span>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
			<span class="sr-only"></span>
			</a>
			<div class="dropdown-menu" role="menu">
				<a href="{{ aurl(\'{route2}\') }}"  style="color:#343a40"  class="dropdown-item">
				<i class="fas fa-list"></i> {{ trans(\'{lang}.show_all\') }}</a>
			</div>
		</div>
		</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
		</div>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
								' . "\n";
		$input = str_replace('{route2}', $route, $input);
		$input = str_replace('{lang}', $r->input('lang_file'), $input);
		if ($r->input('use_collective') == 'yes') {
			$input .= '{!! Form::open([\'url\'=>aurl(\'/{route}\'),\'id\'=>\'' . $route . '\',\'files\'=>true,\'class\'=>\'form-horizontal form-row-seperated\']) !!}';
			$input .= "\n";
			$input .= "<div class=\"row\">";
			$input .= "\n";
			$input = str_replace('{route}', $route, $input);
		} else {
			$input .= '<form action="{route}" enctype="multipart/form-data" class="form-horizontal form-row-seperated" method="post" id="' . $route . '">';
			$input .= "\n";
			$input .= "<div class=\"row\">";
			$input .= "\n";
			$input .= '<input type="hidden" name="_token" value="{{csrf_token()}}">';
			$input .= "\n";
			$input .= '<input type="hidden" name="_method" value="post">';
			$input = str_replace('{route}', '{{aurl(\'/' . $route . '\')}}', $input);
		}
		$input .= "\n";
		if ($r->has('col_type') and $r->has('col_name')) {
			$i = 0;
			foreach ($r->input('col_name') as $col_name) {
				$col_width_lg = $r->input('col_width_lg')[$i];
				$col_width_md = $r->input('col_width_md')[$i];
				$col_width_sm = $r->input('col_width_sm')[$i];
				$col_width_xs = $r->input('col_width_xs')[$i];
				$col_width = 'col-md-' . $col_width_md . ' col-lg-' . $col_width_lg . ' col-sm-' . $col_width_sm . ' col-xs-' . $col_width_xs;
				$data = [
					'use_collective' => $r->input('use_collective'),
					'lang_file' => $r->input('lang_file'),
					'col_name_convention' => $r->input('col_name_convention')[$i],
					'col_width' => $col_width,
					'name' => $col_name,
					'route' => $route,
					'forginkeyto' => $r->input('forginkeyto' . $i) ? 'yes' : 'no',
					'link_ajax' => $r->input('link_ajax' . $i) ? 'yes' : 'no',
					'file_type' => self::fileType($i),
					'i' => $i,
				];

				if (!empty($r->input('col_type')[$i]) and 'text' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::text($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'dropzone' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::dropzone($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'email' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::email($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'select' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::select($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'url' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::url($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'password' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::password($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'textarea' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::textarea($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'textarea_ckeditor' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::textarea_ckeditor($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'date' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::date($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'date_time' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::date_time($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'checkbox' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::checkbox($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'radio' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::radio($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'file' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::file($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'color' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::color($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'time' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::time($data);
				}
				$i++;
			}
			$input .= "\n";
			$input .= "</div>
		<!-- /.row -->
	</div>
	<!-- /.card-body -->
	<div class=\"card-footer\">";
			$input .= BaboonCreate::addbutton($data);
			$input .= '	</div>
</div>
@endsection';
			return $input;
		}
	}

	public static function isVideo($i) {
		if (request()->has('mp4' . $i) ||
			request()->has('mpeg' . $i) ||
			request()->has('video' . $i) ||
			request()->has('mov' . $i) ||
			request()->has('3gp' . $i) ||
			request()->has('webm' . $i) ||
			request()->has('mkv' . $i) ||
			request()->has('wmv' . $i) ||
			request()->has('avi' . $i) ||
			request()->has('vob' . $i)) {
			return [
				'status' => true,
				'video' => request()->has('video' . $i) ? 'yes' : 'no',
				'mp4' => request()->has('mp4' . $i) ? 'yes' : 'no',
				'mpeg' => request()->has('mpeg' . $i) ? 'yes' : 'no',
				'mov' => request()->has('mov' . $i) ? 'yes' : 'no',
				'3gp' => request()->has('3gp' . $i) ? 'yes' : 'no',
				'webm' => request()->has('webm' . $i) ? 'yes' : 'no',
				'mkv' => request()->has('mkv' . $i) ? 'yes' : 'no',
				'wmv' => request()->has('wmv' . $i) ? 'yes' : 'no',
				'avi' => request()->has('avi' . $i) ? 'yes' : 'no',
				'vob' => request()->has('vob' . $i) ? 'yes' : 'no',
			];
		} else {
			return [
				'status' => false,
			];
		}
	}

	public static function isAudio($i) {
		if (request()->has('mp3' . $i)) {
			return [
				'status' => true,
				'mp3' => request()->has('mp3' . $i) ? 'yes' : 'no',
			];
		} else {
			return [
				'status' => false,
			];
		}
	}

	public static function inputsUpdate($r) {
		$blade_path = str_replace('resources.views.', '', str_replace('/', '.', $r->input('admin_folder_path')));
		$route = strtolower($r->input('controller_name'));
		$route = str_replace('controller', '', $route);

		// Ajax Request Form
		if (!empty(request('ajax_request')) && request('ajax_request') == 'yes') {
			$ajax_request_component = '@include("' . $blade_path . '.layouts.components.submit_form_ajax",["form"=>"#{route2}"])';
		} else {
			$ajax_request_component = '';
		}

		$input = '@extends(\'' . $blade_path . '.index\')
@section(\'content\')
' . self::includeAjax('edit') . '
' . $ajax_request_component . '
<div class="card card-dark">
	<div class="card-header">
		<h3 class="card-title">
		<div class="">
			<span>{{!empty($title)?$title:\'\'}}</span>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
			<span class="sr-only"></span>
			</a>
			<div class="dropdown-menu" role="menu">
				<a href="{{aurl(\'{route2}\')}}" class="dropdown-item" style="color:#343a40">
				<i class="fas fa-list"></i> {{trans(\'{lang}.show_all\')}} </a>
				<a href="{{aurl(\'{route2}/\'.${route2}->id)}}" class="dropdown-item" style="color:#343a40">
				<i class="fa fa-eye"></i> {{trans(\'{lang}.show\')}} </a>
				<a class="dropdown-item" style="color:#343a40" href="{{aurl(\'{route2}/create\')}}">
					<i class="fa fa-plus"></i> {{trans(\'{lang}.create\')}}
				</a>
				<div class="dropdown-divider"></div>
				<a data-toggle="modal" data-target="#deleteRecord{{${route2}->id}}" class="dropdown-item" style="color:#343a40" href="#">
					<i class="fa fa-trash"></i> {{trans(\'{lang}.delete\')}}
				</a>
			</div>
		</div>
		</h3>
		@push(\'js\')
		<div class="modal fade" id="deleteRecord{{${route2}->id}}">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">{{trans(\'{lang}.delete\')}}</h4>
						<button class="close" data-dismiss="modal">x</button>
					</div>
					<div class="modal-body">
						<i class="fa fa-exclamation-triangle"></i>   {{trans(\'{lang}.ask_del\')}} {{trans(\'{lang}.id\')}}  ({{${route2}->id}})
					</div>
					<div class="modal-footer">
						{!! Form::open([
						\'method\' => \'DELETE\',
						\'route\' => [\'{route2}.destroy\', ${route2}->id]
						]) !!}
						{!! Form::submit(trans(\'{lang}.approval\'), [\'class\' => \'btn btn-danger btn-flat\']) !!}
						<a class="btn btn-default btn-flat" data-dismiss="modal">{{trans(\'{lang}.cancel\')}}</a>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
		@endpush
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
		</div>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
										' . "\n";
		$input = str_replace('{route2}', $route, $input);
		if ($r->input('use_collective') == 'yes') {
			$input .= '{!! Form::open([\'url\'=>aurl(\'/{route}/\'.${editid}->id),\'method\'=>\'put\',\'id\'=>\'' . $route . '\',\'files\'=>true,\'class\'=>\'form-horizontal form-row-seperated\']) !!}';
			$input .= "\n";
			$input .= "<div class=\"row\">";
			$input .= "\n";
			$input = str_replace('{route}', $route, $input);
			$input = str_replace('{editid}', $route, $input);
		} else {
			$input .= '<form action="{route}"  class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" id="' . $route . '">';
			$input .= "\n";
			$input .= "<div class=\"row\">";
			$input .= '<input type="hidden" name="_token" value="{{csrf_token()}}">';
			$input .= "\n";
			$input .= '<input type="hidden" name="_method" value="put">';
			$varname = '$' . $route . '->id';
			$input = str_replace('{route}', '{{aurl(\'/' . $route . '/\'.' . $varname . ')}}', $input);
			$input = str_replace('{lang}', $r->input('lang_file'), $input);
		}
		$input .= "\n";
		if ($r->has('col_type') and $r->has('col_name')) {
			$i = 0;
			foreach ($r->input('col_name') as $col_name) {
				$col_width_lg = $r->input('col_width_lg')[$i];
				$col_width_md = $r->input('col_width_md')[$i];
				$col_width_sm = $r->input('col_width_sm')[$i];
				$col_width_xs = $r->input('col_width_xs')[$i];
				$col_width = 'col-md-' . $col_width_md . ' col-lg-' . $col_width_lg . ' col-sm-' . $col_width_sm . ' col-xs-' . $col_width_xs;
				$data = [
					'use_collective' => $r->input('use_collective'),
					'lang_file' => $r->input('lang_file'),
					'col_name_convention' => $r->input('col_name_convention')[$i],
					'col_name_convention2' => '$' . $route . '->' . @explode('#', $r->input('col_name_convention')[$i])[0],
					'selectvar' => '$' . $route . '->',
					'name' => $col_name,
					'route' => $route,
					'col_width' => $col_width,
					'forginkeyto' => $r->input('forginkeyto' . $i) ? 'yes' : 'no',
					'link_ajax' => $r->input('link_ajax' . $i) ? 'yes' : 'no',
					'i' => $i,
					'video' => self::isVideo($i),
					'audio' => self::isAudio($i),
					'file_type' => self::fileType($i),
				];

				if (!empty($r->input('col_type')[$i]) and 'text' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::text($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'dropzone' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::dropzone($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'email' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::email($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'select' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::select($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'url' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::url($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'password' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::password($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'textarea' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::textarea($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'textarea_ckeditor' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::textarea_ckeditor($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'date' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::date($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'date_time' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::date_time($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'checkbox' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::checkbox($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'radio' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::radio($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'file' == $r->input('col_type')[$i] && $r->has('image' . $i)) {
					$input .= BaboonUpdate::file($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'file' == $r->input('col_type')[$i] && !$r->has('image' . $i)) {
					$input .= BaboonUpdate::fileDownload($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'color' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::color($data);
				} elseif (!empty($r->input('col_type')[$i]) and 'time' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::time($data);
				}
				$i++;
			}
			$input .= "\n";
			$input .= "</div>
		<!-- /.row -->
		</div>
	<!-- /.card-body -->
	<div class=\"card-footer\">";
			$input .= BaboonUpdate::updatebutton($data);
			$input .= '</div>
</div>
@endsection';
			$input = str_replace('{lang}', $r->input('lang_file'), $input);

			return $input;
		}
	}

	public static function insertRoleInTbl(array $data) {
		if (class_exists(\App\Models\AdminGroupRole::class)) {
			if (class_exists(\App\Models\AdminGroup::class)) {
				if (\App\Models\AdminGroup::where('id', 1)->count() == 0) {
					\App\Models\AdminGroup::UpdateOrCreate([
						'admin_id' => 1,
						'group_name' => 'Full Permission Group By IT PKG',
					]);
				}
				\App\Models\AdminGroupRole::UpdateOrCreate($data);
			}

		}
	}
	public static function RouteListRoles($r) {

		// Setting Roles //
		self::insertRoleInTbl([
			'name' => 'settings',
			'admin_groups_id' => 1,
			'show' => 'yes',
			'add' => 'no',
			'edit' => 'yes',
			'delete' => 'no',
		]);
		// Setting Roles //

		$checkRoute = app_path('Http/AdminRouteList.php');
		if (file_exists($checkRoute)) {
			$baboonRouteListRole = include $checkRoute;
		} else {
			$baboonRouteListRole = [];
		}
		$the_master_admin_route_list = $baboonRouteListRole;
		$routes = '<?php
/*
* To implement in admingroups permissions
* to remove CRUD from Validation remove route name
* CRUD Role permission (create,read,update,delete)
* ' . it_version_message() . '
*/
return [' . "\n";

		$routeName = str_replace('controller', '', strtolower($r->input('controller_name')));
		$mastername = [];
		$mastername[$routeName] = ["create", "update", "read", "delete"];

		$the_master_admin_route_list = array_merge($mastername, $the_master_admin_route_list);
		$x2 = 0;
		foreach ($the_master_admin_route_list as $key => $value) {
			$rules = '';

			if (is_array($value) && in_array('create', $value)) {
				$rules .= '"create",';
			}

			if (is_array($value) && in_array('read', $value)) {
				$rules .= '"read",';
			}

			if (is_array($value) && in_array('update', $value)) {
				$rules .= '"update",';
			}

			if (is_array($value) && in_array('delete', $value)) {
				$rules .= '"delete",';
			}

			$rules = rtrim($rules, ",");
			$routes .= '	"' . $key . '"=>[' . $rules . '],' . "\n";

			// Add Full Role In TBL to Master Group 1
			self::insertRoleInTbl([
				'name' => $key,
				'admin_groups_id' => 1,
				'show' => 'yes',
				'add' => 'yes',
				'edit' => 'yes',
				'delete' => 'yes',
			]);
		}

		$routes .= '];';

		return $routes;
	}

	public static function Makelang($r, $folder = 'ar') {
		$checklang = base_path('resources/lang/' . $folder . '/' . $r->input('lang_file') . '.php');
		if (file_exists($checklang)) {
			$baboonLang = include $checklang;
		}
		$the_master_lang = [];
		$lang = '<?php
		return [' . "\n";

		$mastername = str_replace('controller', '', strtolower($r->input('controller_name')));

		$the_master_lang += [$mastername => $r->input('project_title')];
		$i = 0;
		foreach ($r->input('col_name_convention') as $name) {
			if (preg_match('/\|/', $name) && !preg_match('/\//', $name)) {
				$pre_name = explode('|', $name);
				$the_master_lang += [$pre_name[0] => $r->input('col_name')[$i]];
			} elseif (preg_match('/(\d+)\+(\d+)|,/i', $name)) {
				$pre_name = explode('|', $name);
				if (!$r->has('forginkeyto' . $i)) {
					$the_master_lang += [$pre_name[0] => $r->input('col_name')[$i]];
					$pre_name2 = explode('/', $pre_name[1]);
					foreach ($pre_name2 as $kk => $vall) {
						$k = explode(',', $vall);
						$the_master_lang += [$k[0] => $k[1]];
					}
				}
			} elseif (preg_match('/#/', $name)) {
				$pre_name = explode('#', $name);
				if ($r->input('col_type')[$i] == 'radio') {

					$the_master_lang += [$pre_name[1] => $r->input('col_name')[$i]];
				} else {
					$the_master_lang += [$pre_name[0] => $r->input('col_name')[$i]];
				}
			} else {
				$the_master_lang += [$name => $r->input('col_name')[$i]];
			}
			$i++;
		}

		if (!empty($baboonLang)) {
			foreach ($baboonLang as $k => $v) {
				$the_master_lang += [$k => $v];
			}
		}

		// Prepeare Update Names
		foreach (array_reverse($the_master_lang) as $k => $v) {
			$lang .= '		"' . $k . '"	=>		"' . $v . '"';
			$lang .= ',' . "\n";
		}
		$lang .= "\n" . '];';
		return $lang;
	}

	public static function actions($r) {
		$route = strtolower($r->input('controller_name'));
		$route = str_replace('controller', '', $route);

		$edit = '
 <div class="btn-group">
	<button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i> {{ trans(\'{file_lang}.actions\') }}</button>
	<span class="caret"></span>
	<span class="sr-only"></span>
	</button>
	<div class="dropdown-menu" role="menu">
		<a href="{{ aurl(\'/{route}/\'.$id.\'/edit\')}}" class="dropdown-item" ><i class="fas fa-edit"></i> {{trans(\'{file_lang}.edit\')}}</a>
		<a href="{{ aurl(\'/{route}/\'.$id)}}" class="dropdown-item" ><i class="fa fa-eye"></i> {{trans(\'{file_lang}.show\')}}</a>
		<div class="dropdown-divider"></div>
		<a data-toggle="modal" data-target="#delete_record{{$id}}" href="#" class="dropdown-item">
		<i class="fas fa-trash"></i> {{trans(\'{file_lang}.delete\')}}</a>
	</div>
</div>
<div class="modal fade" id="delete_record{{$id}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">{{trans(\'{file_lang}.delete\')}}</h4>
				<button class="close" data-dismiss="modal">x</button>
			</div>
			<div class="modal-body">
				<i class="fa fa-exclamation-triangle"></i> {{trans(\'{file_lang}.ask_del\')}} {{trans(\'{file_lang}.id\')}} ({{$id}})
			</div>
			<div class="modal-footer">
				{!! Form::open([
				\'method\' => \'DELETE\',
				\'route\' => [\'{route}.destroy\', $id]
				]) !!}
				{!! Form::submit(trans(\'{file_lang}.approval\'), [\'class\' => \'btn btn-danger btn-flat\']) !!}
				<a class="btn btn-default btn-flat" data-dismiss="modal">{{trans(\'{file_lang}.cancel\')}}</a>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
		';
		$edit = str_replace('{route}', $route, $edit);
		$edit = str_replace('{file_lang}', $r->input('lang_file'), $edit);
		return $edit;
	}

	public static function IndexBlade($r) {
		$blade_path = str_replace('resources.views.', '', str_replace('/', '.', $r->input('admin_folder_path')));
		$route = strtolower($r->input('controller_name'));
		$route = str_replace('controller', '', $route);
		$index = '@extends(\'' . $blade_path . '.index\')' . "\n";
		$index .= '@section(\'content\')';
		$index .= '
{!! Form::open(["method" => "post","url" => [aurl(\'/{route}/multi_delete\')]]) !!}
<div class="card card-dark">
	<div class="card-header">
		<h3 class="card-title">{{!empty($title)?$title:\'\'}}</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
		</div>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="row">
			<div class="table-responsive">
			{!! $dataTable->table(["class"=> "table table-striped table-bordered table-hover table-checkable dataTable no-footer"],true) !!}
			</div>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.card-body -->
	<div class="card-footer">
	</div>
</div>
<div class="modal fade" id="multi_delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
					<h4 class="modal-title">{{trans("{lang}.delete")}} </h4>
					<button class="close" data-dismiss="modal">x</button>
			</div>
			<div class="modal-body">
					<div class="delete_done"><i class="fa fa-exclamation-triangle"></i> {{trans("{lang}.ask-delete")}} <span id="count"></span> {{trans("{lang}.record")}} </div>
					<div class="check_delete">{{trans("{lang}.check-delete")}}</div>
			</div>
			<div class="modal-footer">
					{!! Form::submit(trans("{lang}.approval"), ["class" => "btn btn-danger btn-flat delete_done"]) !!}
					<a class="btn btn-default" data-dismiss="modal">{{trans("{lang}.cancel")}}</a>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}

@push(\'js\')
{!! $dataTable->scripts() !!}
@endpush
		';
		$index .= '@endsection
		';
		$index = str_replace('{route}', $route, $index);
		$index = str_replace('{lang}', $r->input('lang_file'), $index);
		return $index;
	}
}