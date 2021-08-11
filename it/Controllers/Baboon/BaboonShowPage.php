<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;

class BaboonShowPage extends Controller {
	public static function show($r) {
		$show = '@extends(\'{path}.index\')
@section(\'content\')
<div class="card card-default">
	<div class="card-header">
		<h3 class="card-title">
		<div class="btn-group">
			<button type="button" class="btn btn-default">{{!empty($title)?$title:\'\'}}</button>
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
			<span class="sr-only"></span>
			</button>
			<div class="dropdown-menu" role="menu">
				<a href="{{aurl(\'{route}\')}}" class="dropdown-item">
				<i class="fas fa-list"></i> {{trans(\'{lang}.show_all\')}}</a>
				<a class="dropdown-item" href="{{aurl(\'{route}/\'.${route}->id.\'/edit\')}}">
					<i class="fas fa-edit"></i> {{trans(\'{lang}.edit\')}}
				</a>
				<a class="dropdown-item" href="{{aurl(\'{route}/create\')}}">
					<i class="fas fa-plus"></i> {{trans(\'{lang}.create\')}}
				</a>
				<div class="dropdown-divider"></div>
				<a data-toggle="modal" data-target="#deleteRecord{{${route}->id}}" class="dropdown-item" href="">
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
			<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
		</div>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="row">';

		$show .= '
<div class="col-md-12 col-lg-12 col-xs-12">
<b>{{trans(\'{lang}.id\')}} :</b> {{${route}->id}}
</div>
<div class="clearfix"></div>
<hr />
';

		foreach (explode(',', self::get_cols($r)) as $n) {
			if (!empty($n)) {
				if ($n == 'admin_id') {

					$show .= '
@if(!empty(${route}->' . $n . '()->first()))
<div class="col-md-6 col-lg-6 col-xs-6">
<b>{{trans(\'{lang}.' . $n . '\')}} :</b>
 {{ ${route}->' . $n . '()->first()->name }}
</div>
@endif
';
				} else {

					$show .= '
<div class="col-md-6 col-lg-6 col-xs-6">
<b>{{trans(\'{lang}.' . $n . '\')}} :</b>
 {!! ${route}->' . $n . ' !!}
</div>

';

				}
			}
		}

		$x = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if ($r->has('image' . $x)) {
				$show .= '
<div class="col-md-6 col-lg-6 col-xs-6">
<b>{{trans(\'{lang}.' . $conv . '\')}} :</b>
 @include("admin.show_image",["image"=>${route}->' . $conv . '])
</div>
';
			} elseif ($r->input('col_type')[$x] == 'file' && !$r->has('image' . $x)) {
				$show .= '
<div class="col-md-6 col-lg-6 col-xs-6">
<b>{{trans(\'{lang}.' . $conv . '\')}} :</b>
  <a href="{{ it()->url(${route}->' . $conv . ') }}" target="_blank"><i class="fa fa-download fa-2x"></i></a>
</div>
';
			} elseif (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {

				$pre_name = explode('|', $conv);

				if (request()->has('forginkeyto' . $x)) {

					$pre_name = explode('|', $conv);
					$pluck_name = explode('pluck(', $pre_name[1]);
					$pluck_name = !empty($pluck_name) && count($pluck_name) > 0 ? explode(',', $pluck_name[1]) : [];
					$final_pluckName = str_replace("'", "", $pluck_name[0]);

					$show .= '
<div class="col-md-6 col-lg-6 col-xs-6">
<b>{{trans(\'{lang}.' . $pre_name[0] . '\')}} :</b>
@if(!empty(${route}->' . $pre_name[0] . '()->first()))
   {{ ${route}->' . $pre_name[0] . '()->first()->' . $final_pluckName . ' }}
@endif
</div>
';

				} else {
					$show .= '
<div class="col-md-6 col-lg-6 col-xs-6">
<b>{{trans(\'{lang}.' . $pre_name[0] . '\')}} :</b>
   {{ trans("{lang}.".${route}->' . $pre_name[0] . ') }}
</div>
';
				}
			}
			$x++;
		}
		$show .= '			  <!-- /.row -->
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

		// if ($r->has('schema_name')) {
		// 	$i = 0;
		// 	$schema_null = $r->input('schema_null');
		// 	foreach ($r->input('schema_name') as $schema_name) {
		// 		if (!$r->has('forginkeyto' . $i)) {
		// 			$cols .= $schema_name . ',';
		// 		}
		// 		$i++;
		// 	}
		// }
		$i = 0;

		if ($r->has('has_user_id')) {
			// Disable Any Image Here
			$cols .= 'admin_id,';
		}

		foreach ($r->input('col_name_convention') as $conv) {
			if (request()->has('forginkeyto' . $i)) {
				// Disable Forginkey
			} elseif ($r->has('image' . $i)) {
				// Disable Any Image Here
				$cols .= '';
			} elseif (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				// disable dropdown
				// $pre_name = explode('|', $conv);
				// $cols .= $pre_name[0] . ',';
				$cols .= '';
			} elseif (preg_match('/#/i', $conv)) {
				$pre_conv = explode('#', $conv);
				if (!preg_match('/' . $pre_conv[0] . '/i', $cols)) {

					$name = explode('#', $conv);
					$cols .= $name[0] . ',';
				}
			} elseif ($r->input('col_type')[$i] == 'file' && !$r->has('image' . $i)) {
				// Disable Column File
				$cols .= '';
			} else {

				$cols .= $conv . ',';
			}
			$i++;
		}

		return $cols;
	}

}