<?php
namespace Phpanonymous\It\Controllers\Baboon;
use App\Http\Controllers\Controller;

class BaboonShowPage extends Controller {

	public static function show($r) {
		$show = '@extends(\'{path}.index\')
@section(\'content\')
<div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
              <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl(\'{route}/create\')}}"
                           data-toggle="tooltip" title="{{trans(\'{lang}.{route}\')}}">
                            <i class="fa fa-plus"></i>
                        </a>


                        <span data-toggle="tooltip" title="{{trans(\'{lang}.delete\')}}  {{trans(\'{lang}.{route}\')}}">

                        <a data-toggle="modal" data-target="#myModal{{${route}->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
                        <i class="fa fa-trash"></i>
                        </a>
                        </span>


<div class="modal fade" id="myModal{{${route}->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title">{{trans(\'{lang}.delete\')}}؟</h4>
            </div>
            <div class="modal-body">
                                {{trans(\'{lang}.ask_del\')}} {{trans(\'{lang}.id\')}} {{${route}->id}} ؟

            </div>
            <div class="modal-footer">
                {!! Form::open([
               \'method\' => \'DELETE\',
               \'route\' => [\'{route}.destroy\', ${route}->id]
               ]) !!}
                {!! Form::submit(trans(\'{lang}.approval\'), [\'class\' => \'btn btn-danger\']) !!}
                <a class="btn btn-default" data-dismiss="modal">{{trans(\'{lang}.cancel\')}}</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

                        <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl(\'/{route}\')}}"
                           data-toggle="tooltip" title="{{trans(\'{lang}.show_all\')}}   {{trans(\'{lang}.{route}\')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans(\'{lang}.fullscreen\')}}"
                           title="{{trans(\'{lang}.fullscreen\')}}">
                        </a>
                    </div>
                </div>
            <div class="portlet-body form">
				<div class="col-md-12">';

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
<div class="col-md-4 col-lg-4 col-xs-4">
<b>{{trans(\'{lang}.' . $n . '\')}} :</b>
 {{ ${route}->' . $n . '()->first()->name }}
</div>
@endif
';
				} else {

					$show .= '
<div class="col-md-4 col-lg-4 col-xs-4">
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
<div class="col-md-4 col-lg-4 col-xs-4">
<b>{{trans(\'{lang}.' . $conv . '\')}} :</b>
 @include("admin.show_image",["image"=>${route}->' . $conv . '])
</div>
';
			} elseif ($r->input('col_type')[$x] == 'file' && !$r->has('image' . $x)) {
				$show .= '
<div class="col-md-4 col-lg-4 col-xs-4">
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
<div class="col-md-4 col-lg-4 col-xs-4">
<b>{{trans(\'{lang}.' . $pre_name[0] . '\')}} :</b>
@if(!empty(${route}->' . $pre_name[0] . '()->first()))
   {{ ${route}->' . $pre_name[0] . '()->first()->' . $final_pluckName . ' }}
@endif
</div>
';

				} else {
					$show .= '
<div class="col-md-4 col-lg-4 col-xs-4">
<b>{{trans(\'{lang}.' . $pre_name[0] . '\')}} :</b>
   {{ trans("{lang}.".${route}->' . $pre_name[0] . ') }}
</div>
';
				}
				$x++;
			}
		}
		$show .= '			</div>
			<div class="clearfix"></div>
           </div>
         </div>
       </div>
   </div>
@stop';

		$folder = str_replace('controller', '', strtolower($r->input('controller_name')));
		$show = str_replace('{route}', $folder, $show);
		$show = str_replace('{path}', str_replace('resources/views/', '', $r->input('admin_folder_path')), $show);
		$show = str_replace('{lang}', $r->input('lang_file'), $show);
		return $show;
	}

	public static function get_cols($r) {
		$cols = '';

		if ($r->has('has_user_id')) {
			//$cols .= 'admin_id,';
		}

		if ($r->has('schema_name')) {
			$i = 0;
			$schema_null = $r->input('schema_null');
			foreach ($r->input('schema_name') as $schema_name) {
				if (!$r->has('forginkeyto' . $i)) {
					$cols .= $schema_name . ',';
				}
				$i++;
			}
		}
		$i = 0;

		foreach ($r->input('col_name_convention') as $conv) {
			if ($r->has('image' . $i)) {
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