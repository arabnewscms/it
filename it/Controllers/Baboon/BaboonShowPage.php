<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;

class BaboonShowPage extends Controller {
	public static function show($r) {
		$show = '@extends(\'{path}.index\')
@section(\'content\')
<div class="card card-dark">
	<div class="card-header">
		<h3 class="card-title">
		<div class="">
			<a>{{!empty($title)?$title:\'\'}}</a>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
				<span class="sr-only"></span>
			</a>
			<div class="dropdown-menu" role="menu">
				<a href="{{aurl(\'{route}\')}}" class="dropdown-item"  style="color:#343a40">
				<i class="fas fa-list"></i> {{trans(\'{lang}.show_all\')}}</a>
				<a class="dropdown-item"  style="color:#343a40" href="{{aurl(\'{route}/\'.${route}->id.\'/edit\')}}">
					<i class="fas fa-edit"></i> {{trans(\'{lang}.edit\')}}
				</a>
				<a class="dropdown-item"  style="color:#343a40" href="{{aurl(\'{route}/create\')}}">
					<i class="fas fa-plus"></i> {{trans(\'{lang}.create\')}}
				</a>
				<div class="dropdown-divider"></div>
				<a data-toggle="modal" data-target="#deleteRecord{{${route}->id}}" class="dropdown-item"  style="color:#343a40" href="#">
					<i class="fas fa-trash"></i> {{trans(\'{lang}.delete\')}}
				</a>
			</div>
		</div>
		</h3>
		@push(\'js\')
		<div class="modal fade" id="deleteRecord{{${route}->id}}">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">{{trans(\'{lang}.delete\')}}</h4>
						<button class="close" data-dismiss="modal">x</button>
					</div>
					<div class="modal-body">
						<i class="fa fa-exclamation-triangle"></i>  {{trans(\'{lang}.ask_del\')}} {{trans(\'{lang}.id\')}} ({{${route}->id}})
					</div>
					<div class="modal-footer">
						{!! Form::open([
               \'method\' => \'DELETE\',
               \'route\' => [\'{route}.destroy\', ${route}->id]
               ]) !!}
                {!! Form::submit(trans(\'{lang}.approval\'), [\'class\' => \'btn btn-danger btn-flat\']) !!}
						 <a class="btn btn-default" data-dismiss="modal">{{trans(\'{lang}.cancel\')}}</a>
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
		<div class="row">' . "\n";

		$show .= '			<div class="col-md-12 col-lg-12 col-xs-12">
				<b>{{trans(\'{lang}.id\')}} :</b> {{${route}->id}}
			</div>
			<div class="clearfix"></div>
			<hr />' . "\n\r";

		foreach (explode(',', self::get_cols($r)) as $n) {
			$n_explode = explode('/', $n);
			$n = $n_explode[0];
			$x = isset($n_explode[1]) ? $n_explode[1] : 0;
			if (!empty($n)) {
				if ($n == 'admin_id') {

					$show .= '			@if(!empty(${route}->' . $n . '()->first()))
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<b>{{trans(\'{lang}.' . $n . '\')}} :</b>
				{{ ${route}->' . $n . '()->first()->name }}
			</div>
			@endif' . "\n\r";
				} else {

					$show .= '			<div class="' . self::colWidth($x) . '">
				<b>{{trans(\'{lang}.' . $n . '\')}} :</b>
				{!! ${route}->' . $n . ' !!}
			</div>' . "\n\r";

				}
			}
		}

		$x = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if ($r->has('image' . $x) && $r->input('col_type')[$x] == 'file') {
				$show .= '			<div class="' . self::colWidth($x) . '">
				<b>{{trans(\'{lang}.' . $conv . '\')}} :</b>
				@include("admin.show_image",["image"=>${route}->' . $conv . '])
			</div>' . "\n\r";
			} elseif ($r->input('col_type')[$x] == 'file' && !$r->has('image' . $x)) {
				$audio_video = '';
				if ($r->has('video' . $x) ||
					$r->has('mp4' . $x) ||
					$r->has('mpeg' . $x) ||
					$r->has('mov' . $x) ||
					$r->has('3gp' . $x) ||
					$r->has('webm' . $x) ||
					$r->has('mkv' . $x) ||
					$r->has('wmv' . $x) ||
					$r->has('avi' . $x) ||
					$r->has('vob' . $x)) {
					$audio_video = '@include("admin.show_video",["video"=>${route}->' . $conv . '])';
				} elseif ($r->has('mp3' . $x)) {
					$audio_video = '@include("admin.show_audio",["audio"=>${route}->' . $conv . '])';
				}
				$show .= '			<div class="' . self::colWidth($x) . '">
				<div class="row">
					<div class="col-md-8 col-lg-4 col-xs-12">
					  <b>{{trans(\'{lang}.' . $conv . '\')}} :</b>
					</div>
					<div class="col-md-2 col-lg-2 col-xs-12">
						' . $audio_video . '
					</div>
					<div class="col-md-2 col-lg-2 col-xs-12">
						<a href="{{ it()->url(${route}->' . $conv . ') }}" target="_blank"><i class="fa fa-download fa-2x"></i></a>
					</div>
				</div>
			</div>' . "\n\r";
			} elseif (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {

				$pre_name = explode('|', $conv);

				if (request()->has('forginkeyto' . $x)) {

					$pre_name = explode('|', $conv);
					$pluck_name = explode('pluck(', $pre_name[1]);
					$pluck_name = !empty($pluck_name) && count($pluck_name) > 0 ? explode(',', $pluck_name[1]) : [];
					$final_pluckName = str_replace("'", "", $pluck_name[0]);

					$show .= '			<div class="' . self::colWidth($x) . '">
				<b>{{trans(\'{lang}.' . $pre_name[0] . '\')}} :</b>
				@if(!empty(${route}->' . $pre_name[0] . '()->first()))
			{{ ${route}->' . $pre_name[0] . '()->first()->' . $final_pluckName . ' }}
			@endif
			</div>' . "\n\r";

				} else {
					$show .= '			<div class="' . self::colWidth($x) . '">
				<b>{{trans(\'{lang}.' . $pre_name[0] . '\')}} :</b>
				{{ trans("{lang}.".${route}->' . $pre_name[0] . ') }}
			</div>' . "\n\r";
				}
			}
			$x++;
		}
		$show .= '			<!-- /.row -->
		</div>
	</div>
	<!-- /.card-body -->
	<div class="card-footer">
	</div>
</div>
@endsection';

		$folder = str_replace('controller', '', strtolower($r->input('controller_name')));
		$show = str_replace('{route}', $folder, $show);
		$show = str_replace('{path}', str_replace('resources/views/', '', $r->input('admin_folder_path')), $show);
		$show = str_replace('{lang}', $r->input('lang_file'), $show);
		return $show;
	}

	public static function get_cols($r) {
		$cols = '';
		$i = 0;
		if ($r->has('has_user_id')) {
			// Disable Any Image Here
			$cols .= 'admin_id/0,';
		}
		foreach ($r->input('col_name_convention') as $conv) {
			if (request()->has('forginkeyto' . $i)) {
				// Disable Forginkey
			} elseif ($r->has('image' . $i)) {
				// Disable Any Image Here
			} elseif ($r->input('col_type')[$i] == 'password') {
				// Disable Any password Here
			} elseif ($r->input('col_type')[$i] == 'dropzone') {
				// Disable Any dropzone Here
			} elseif (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				// disable dropdown
				// $pre_name = explode('|', $conv);
				// $cols .= $pre_name[0] . ',';
			} elseif (preg_match('/#/i', $conv)) {
				$pre_conv = explode('#', $conv);
				if (!preg_match('/' . $pre_conv[0] . '/i', $cols)) {
					$name = explode('#', $conv);
					$cols .= $name[0] . '/' . $i . ',';
				}
			} elseif ($r->input('col_type')[$i] == 'file' && !$r->has('image' . $i)) {
				// Disable Column File
			} else {
				$cols .= $conv . '/' . $i . ',';
			}
			$i++;
		}

		return $cols;
	}

	public static function colWidth($i) {
		//col-md-6 col-lg-6 col-xs-6
		return 'col-lg-' . request('col_width_lg')[$i] . ' col-md-' . request('col_width_md')[$i] . ' col-sm-' . request('col_width_sm')[$i] . ' col-xs-' . request('col_width_xs')[$i];
	}

}