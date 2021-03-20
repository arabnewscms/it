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
	public static $copyright = '[It V 1.5.0 | https://it.phpanonymous.com]';
	public static function makeController($r, $namespace, $model, $classname) {
		$controller = '<?php
namespace {Space};
use App\Http\Controllers\Controller;
use App\DataTables\{ClassName2}DataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use {Model};
use Validator;
use Set;
use Up;
use Form;
use App\Http\Controllers\Validations\{ClassName}Request;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  ' . self::$copyright . '
// Copyright Reserved  ' . self::$copyright . '
class {ClassName} extends Controller
{' . "\n";
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
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use {Model};
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  ' . self::$copyright . '
// Copyright Reserved  ' . self::$copyright . '
class {ClassName}Api extends Controller
{' . "\n";
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
					$cols .= "        '" . $schema_name . "'," . "\n";
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
			} else {
				$cols .= self::str_num($conv, $i, $r) . "\n";
			}
			$i++;
		}
		return $cols;
	}

	public static function check_radio($name, $i, $r) {
		$name = explode('#', $name);
		return "'" . $name[0] . "',";
	}

	public static function str_num($name, $i, $r) {
		return "'" . $name . "',";
	}

	public static function enum($name, $i, $r) {
		$pre_name = explode('|', $name);
		$pre_name2 = explode('/', $pre_name[1]);
		$cols = "'" . $pre_name[0] . "'," . "\n";
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
// Baboon Maker has been Created And Developed By  ' . self::$copyright . '
// Copyright Reserved  ' . self::$copyright . '
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
		$model .= "		      " . self::get_cols(request());
		$model .= "		'created_at'," . "\n";
		$model .= "		'updated_at'," . "\n";
		if (request()->has('enable_soft_delete')) {
			$model .= "		'deleted_at'," . "\n";
		}
		$model .= '	];' . "\n";
		$model = str_replace('{Space}', $namespace, $model);
		$model = str_replace('{ClassName}', $classname, $model);
		$model = str_replace('{TBLNAME}', self::convention_name($classname), $model);
		if (request()->has('linkatmodel')) {
			$i = 0;
			foreach (request('linkatmodel') as $linkat) {
				$linkat_final = !preg_match('/::class/i', $linkat) ? '\'\\' . $linkat . '\'' : $linkat;
				$model .= '
   public function ' . request('schema_name')[$i] . '(){
      return $this->' . request('relation_type')[$i] . '(\\' . $linkat_final . ',\'id\',\'' . request('schema_name')[$i] . '\');
   }
';
				$i++;
			}
		}
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
		//'baboon/'.request('project_title');
		$checkpath = '';
		//'baboon';
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
				//return dd(base_path($full_path));
				mkdir(base_path($full_path), 0755);
			}
		}
		return true;
	}

	/*public static function convention_name($string) {
		return strtolower(ltrim(preg_replace('/(?<!\ )[A-Z]/', '_$0', $string), '_'));
	*/
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

	public static function inputsCreate($r) {
		$blade_path = str_replace('resources.views.', '', str_replace('/', '.', $r->input('admin_folder_path')));
		$route = strtolower($r->input('controller_name'));
		$route = str_replace('controller', '', $route);
		$input = '@extends(\'' . $blade_path . '.index\')
@section(\'content\')
<div class="row">
	<div class="col-md-12">
		<div class="widget-extra body-req portlet light bordered">
				<div class="portlet-title">
						<div class="caption">
								<span class="caption-subject bold uppercase font-dark">{{$title}}</span>
						</div>
						<div class="actions">
								<a  href="{{aurl(\'{route2}\')}}"
										class="btn btn-circle btn-icon-only btn-default"
										tooltip="{{trans(\'{lang}.show_all\')}}"
										title="{{trans(\'{lang}.show_all\')}}">
										<i class="fa fa-list"></i>
								</a>
								<a class="btn btn-circle btn-icon-only btn-default fullscreen"
										href="#"
										data-original-title="{{trans(\'{lang}.fullscreen\')}}"
										title="{{trans(\'{lang}.fullscreen\')}}">
								</a>
						</div>
				</div>
				<div class="portlet-body form">
								<div class="col-md-12">
								' . "\n";
		$input = str_replace('{route2}', $route, $input);
		$input = str_replace('{lang}', $r->input('lang_file'), $input);
		if ($r->input('use_collective') == 'yes') {
			$input .= '{!! Form::open([\'url\'=>aurl(\'/{route}\'),\'id\'=>\'' . $route . '\',\'files\'=>true,\'class\'=>\'form-horizontal form-row-seperated\']) !!}';
			$input = str_replace('{route}', $route, $input);
		} else {
			$input .= '<form action="{route}" enctype="multipart/form-data" class="form-horizontal form-row-seperated" method="post" id="' . $route . '">';
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
				$data = [
					'use_collective' => $r->input('use_collective'),
					'lang_file' => $r->input('lang_file'),
					'col_name_convention' => $r->input('col_name_convention')[$i],
					'name' => $col_name,
					'forginkeyto' => $r->input('forginkeyto' . $i) ? 'yes' : 'no',
					'i' => $i,
				];
				if (!empty($r->input('col_type')[$i]) and 'text' == $r->input('col_type')[$i]) {
					$input .= BaboonCreate::text($data);
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
			$input .= BaboonCreate::addbutton($data);
			$input .= '
										</div>
										<div class="clearfix"></div>
						</div>
				</div>
		</div>
	</div>
	@endsection
	' . "\n";
			return $input;
		}
	}

	public static function inputsUpdate($r) {
		$blade_path = str_replace('resources.views.', '', str_replace('/', '.', $r->input('admin_folder_path')));
		$route = strtolower($r->input('controller_name'));
		$route = str_replace('controller', '', $route);
		$input = '@extends(\'' . $blade_path . '.index\')
@section(\'content\')
<div class="row">
<div class="col-md-12">
<div class="widget-extra body-req portlet light bordered">
<div class="portlet-title">
<div class="caption">
		<span class="caption-subject bold uppercase font-dark">{{$title}}</span>
</div>
<div class="actions">
		<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl(\'{route2}/create\')}}"
				data-toggle="tooltip" title="{{trans(\'{lang}.add\')}}  {{trans(\'{lang}.{route2}\')}}">
				<i class="fa fa-plus"></i>
		</a>
		<span data-toggle="tooltip" title="{{trans(\'{lang}.delete\')}}  {{trans(\'{lang}.{route2}\')}}">
				<a data-toggle="modal" data-target="#myModal{{${route2}->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
						<i class="fa fa-trash"></i>
				</a>
		</span>
		<div class="modal fade" id="myModal{{${route2}->id}}">
				<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<button class="close" data-dismiss="modal">x</button>
								<h4 class="modal-title">{{trans(\'{lang}.delete\')}}؟</h4>
						</div>
						<div class="modal-body">
								<i class="fa fa-exclamation-triangle"></i>   {{trans(\'{lang}.ask_del\')}} {{trans(\'{lang}.id\')}} ({{${route2}->id}}) ؟
						</div>
						<div class="modal-footer">
								{!! Form::open([
								\'method\' => \'DELETE\',
								\'route\' => [\'{route2}.destroy\', ${route2}->id]
								]) !!}
								{!! Form::submit(trans(\'{lang}.approval\'), [\'class\' => \'btn btn-danger\']) !!}
								<a class="btn btn-default" data-dismiss="modal">{{trans(\'{lang}.cancel\')}}</a>
								{!! Form::close() !!}
						</div>
				</div>
				</div>
		</div>
		<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl(\'{route2}\')}}"
				data-toggle="tooltip" title="{{trans(\'{lang}.show_all\')}}   {{trans(\'{lang}.{route2}\')}}">
				<i class="fa fa-list"></i>
		</a>
		<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
				data-original-title="{{trans(\'{lang}.fullscreen\')}}"
				title="{{trans(\'{lang}.fullscreen\')}}">
		</a>
</div>
</div>
<div class="portlet-body form">
<div class="col-md-12">
										' . "\n";
		$input = str_replace('{route2}', $route, $input);
		if ($r->input('use_collective') == 'yes') {
			$input .= '{!! Form::open([\'url\'=>aurl(\'/{route}/\'.${editid}->id),\'method\'=>\'put\',\'id\'=>\'' . $route . '\',\'files\'=>true,\'class\'=>\'form-horizontal form-row-seperated\']) !!}';
			$input = str_replace('{route}', $route, $input);
			$input = str_replace('{editid}', $route, $input);
		} else {
			$input .= '<form action="{route}"  class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" id="' . $route . '">';
			$input .= "\n";
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
				$data = [
					'use_collective' => $r->input('use_collective'),
					'lang_file' => $r->input('lang_file'),
					'col_name_convention' => $r->input('col_name_convention')[$i],
					'col_name_convention2' => '$' . $route . '->' . @explode('#', $r->input('col_name_convention')[$i])[0],
					'selectvar' => '$' . $route . '->',
					'name' => $col_name,
					'forginkeyto' => $r->input('forginkeyto' . $i) ? 'yes' : 'no',
					'i' => $i,
				];
				if (!empty($r->input('col_type')[$i]) and 'text' == $r->input('col_type')[$i]) {
					$input .= BaboonUpdate::text($data);
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
			$input .= BaboonUpdate::updatebutton($data);
			$input .= '
												</div>
												<div class="clearfix"></div>
								</div>
						</div>
				</div>
		</div>
		@endsection
		' . "\n";
			$input = str_replace('{lang}', $r->input('lang_file'), $input);

			return $input;
		}
	}

	public static function Makelang($r, $folder = 'ar') {
		$checklang = base_path('resources/lang/' . $folder . '/' . $r->input('lang_file') . '.php');
		if (file_exists($checklang)) {
			$baboonLang = include $checklang;
		}
		$the_master_lang = [];
		$lang = '<?php
		return [' . "\n";
		if (!empty($baboonLang)) {
			foreach ($baboonLang as $k => $v) {
				$the_master_lang += [$k => $v];
			}
		}
		$mastername = str_replace('controller', '', strtolower($r->input('controller_name')));
		/*$the_master_lang += ['create'  => 'إضافة جديدة'];
			$the_master_lang += ['add'     => 'إضافة'];
			$the_master_lang += ['edit'    => 'تعديل'];
			$the_master_lang += ['delete'  => 'حذف'];
			$the_master_lang += ['show'    => 'عرض'];
			$the_master_lang += ['added'   => 'تمت الإضافة بنجاح'];
			$the_master_lang += ['updated' => 'تم التحديث بنجاح'];
		*/
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
				$the_master_lang += [$pre_name[0] => $r->input('col_name')[$i]];
			} else {
				$the_master_lang += [$name => $r->input('col_name')[$i]];
			}
			$i++;
		}

		foreach ($the_master_lang as $k => $v) {
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
<div class="actions">
<div class="btn-group">
	<a class="btn btn-default btn-outlines btn-circle" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
			<i class="fa fa-wrench"></i>
	{{ trans(\'{file_lang}.actions\') }}
			<i class="fa fa-angle-down"></i>
	</a>
	<ul class="dropdown-menu pull-right">
			<li>
					<a href="{{ aurl(\'/{route}/\'.$id.\'/edit\')}}"><i class="fa fa-pencil-square-o"></i> {{trans(\'{file_lang}.edit\')}}</a>
			</li>
			<li class="divider"> </li>
			<li>
					<a href="{{ aurl(\'/{route}/\'.$id)}}"><i class="fa fa-eye"></i> {{trans(\'{file_lang}.show\')}}</a>
			</li>
			<li>
					<a data-toggle="modal" data-target="#delete_record{{$id}}" href="#">
	<i class="fa fa-trash"></i> {{trans(\'{file_lang}.delete\')}}</a>
			</li>
	</ul>
</div>
</div>
<div class="modal fade" id="delete_record{{$id}}">
<div class="modal-dialog">
	<div class="modal-content">
			<div class="modal-header">
					<button class="close" data-dismiss="modal">x</button>
					<h4 class="modal-title">{{trans(\'{file_lang}.delete\')}}؟</h4>
			</div>
			<div class="modal-body">
					<i class="fa fa-exclamation-triangle"></i> {{trans(\'{file_lang}.ask_del\')}} {{trans(\'{file_lang}.id\')}} ({{$id}}) ؟
			</div>
			<div class="modal-footer">
					{!! Form::open([
					\'method\' => \'DELETE\',
					\'route\' => [\'{route}.destroy\', $id]
					]) !!}
					{!! Form::submit(trans(\'{file_lang}.approval\'), [\'class\' => \'btn btn-danger\']) !!}
					<a class="btn btn-default" data-dismiss="modal">{{trans(\'{file_lang}.cancel\')}}</a>
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
		$index = '@extends(\'' . $blade_path . '.index\')';
		$index .= '
		@section(\'content\')';
		$index .= '
<div class="row">
<div class="col-md-12">
		<div class="portlet light bordered">
				<div class="portlet-title">
						<div class="caption">
								<span class="caption-subject bold uppercase font-dark">{{$title}}</span>
						</div>
				</div>
				<div class="portlet-body">
                    <div class="table-responsive">
						{!! Form::open([
						"method" => "post",
						"url" => [aurl(\'/{route}/multi_delete\')]
						]) !!}
						{!! $dataTable->table(["class"=> "table table-striped table-bordered table-hover table-checkable dataTable no-footer"],true) !!}
						<div class="clearfix"></div>
                    </div>
				</div>
		</div>
</div>
<div class="modal fade" id="multi_delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
					<button class="close" data-dismiss="modal">x</button>
					<h4 class="modal-title">{{trans("{lang}.delete")}} </h4>
			</div>
			<div class="modal-body">
					<div class="delete_done"><i class="fa fa-exclamation-triangle"></i> {{trans("{lang}.ask-delete")}} <span id="count"></span> {{trans("{lang}.record")}} ! </div>
					<div class="check_delete">{{trans("{lang}.check-delete")}}</div>
			</div>
			<div class="modal-footer">
					{!! Form::submit(trans("{lang}.approval"), ["class" => "btn btn-danger delete_done"]) !!}
					<a class="btn btn-default" data-dismiss="modal">{{trans("{lang}.cancel")}}</a>
			</div>
		</div>
	</div>
</div>
</div>
@push(\'js\')
{!! $dataTable->scripts() !!}
@endpush
{!! Form::close() !!}
		';
		$index .= '@endsection
		';
		$index = str_replace('{route}', $route, $index);
		$index = str_replace('{lang}', $r->input('lang_file'), $index);
		return $index;
	}
}
