<?php
namespace Phpanonymous\It\Controllers\Baboon;

use App\Http\Controllers\Controller;
use Phpanonymous\It\Controllers\Baboon\MasterBaboon as Baboon;

class BaboonDataTable extends Controller {

	public static function dbclass($r) {
		$datatable = '<?php
namespace App\DataTables;
use {Model};
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;
// Auto DataTable By Baboon Script
// Baboon Maker has been Created And Developed By ' . it_version_message() . '
// Copyright Reserved ' . it_version_message() . '
class {ClassName}DataTable extends DataTable
{
    	' . "\n";
		$datatable .= self::ajaxMethod($r) . "\n";
		$datatable .= self::queryMethod($r) . "\n";
		$datatable .= self::htmlMethod($r) . "\n";
		$datatable .= self::getcolsMethod($r) . "\n";
		$datatable .= self::filenameMethod($r) . "\n";

		$datatable .= '}';

		$nameclass = str_replace('Controller', '', $r->input('controller_name'));
		$datatable = str_replace('{ClassName}', $nameclass, $datatable);
		$datatable = str_replace('{lang}', $r->input('lang_file'), $datatable);

		$datatable = str_replace('{Model}',
			$r->input('model_namespace') . '\\' . $r->input('model_name'), $datatable);

		return $datatable;
	}

	public static function filenameMethod($r) {
		$filename = '
	    /**
	     * Get filename for export.
	     * Auto filename Method By Baboon Script
	     * @return string
	     */
	    protected function filename()
	    {
	        return \'{name}_\' . time();
	    }
    	';
		$name = str_replace('Controller', '', $r->input('controller_name'));
		$filename = str_replace('{name}', strtolower($name), $filename);
		return $filename;
	}

	public static function getcolsMethod($r) {
		$cols = '
    	/**
	     * Get columns.
	     * Auto getColumns Method By Baboon Script ' . it_version_message() . '
	     * @return array
	     */

	    protected function getColumns()
	    {
	        return [
	       	' . "\n";

		if (!empty(request('datatable_checkbox'))) {
			$cols .= ' [
                \'name\' => \'checkbox\',
                \'data\' => \'checkbox\',
                \'title\' => \'<div  class="icheck-danger">
                  <input type="checkbox" class="select-all" id="select-all"  onclick="select_all()" >
                  <label for="select-all"></label>
                </div>\',
                \'orderable\'      => false,
                \'searchable\'     => false,
                \'exportable\'     => false,
                \'printable\'      => false,
                \'width\'          => \'10px\',
                \'aaSorting\'      => \'none\'
            ],' . "\n";
		}

		if (!empty(request('datatable_record_id'))) {
			$cols .= '[
                \'name\' => \'id\',
                \'data\' => \'id\',
                \'title\' => trans(\'{lang}.record_id\'),
                \'width\'          => \'10px\',
                \'aaSorting\'      => \'none\'
            ],' . "\n";
		}
		$i2 = 0;
		foreach ($r->input('col_name_convention') as $conv) {

			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {

				$pre_conv = explode('|', $conv);
				if (request()->has('forginkeyto' . $i2)) {
					$pluck_name = explode('pluck(', $pre_conv[1]);
					$pluck_name = !empty($pluck_name) && count($pluck_name) > 0 ? explode(',', $pluck_name[1]) : [];
					$final_pluckName = str_replace("'", "", $pluck_name[0]);
				} else {
					$final_pluckName = '';
				}

				if (!empty($final_pluckName) && request()->has('forginkeyto' . $i2) && !empty(request('dt_show_column')) && in_array($pre_conv[0], request('dt_show_column'))) {
					$cols .= '				[' . "\n";

					$cols .= '                 \'name\'=>\'' . $pre_conv[0] . '.' . $final_pluckName . '' . '\',' . "\n";
					$cols .= '                 \'data\'=>\'' . $pre_conv[0] . '.' . $final_pluckName . '\',' . "\n";
					$cols .= '                 \'title\'=>trans(\'{lang}.' . $pre_conv[0] . '\'),' . "\n";
					$cols .= '		    ],' . "\n";
				} elseif (!request()->has('forginkeyto' . $i2) && !empty(request('dt_show_column')) && in_array($pre_conv[0], request('dt_show_column'))) {
					$cols .= '				[' . "\n";
					$cols .= '                 \'name\'=>\'' . self::convention_name(request('model_name')) . '.' . $pre_conv[0] . '\',' . "\n";
					$cols .= '                 \'data\'=>\'' . $pre_conv[0] . '\',' . "\n";
					// $cols .= '                 \'exportable\' => false,' . "\n";
					// $cols .= '                 \'printable\'  => false,' . "\n";
					// $cols .= '                 \'searchable\' => false,' . "\n";
					// $cols .= '                 \'orderable\'  => false,' . "\n";

					$cols .= '                 \'title\'=>trans(\'{lang}.' . $pre_conv[0] . '\'),' . "\n";
					$cols .= '		    ],' . "\n";
				} elseif (!empty(request('dt_show_column')) && in_array($conv, request('dt_show_column'))) {
					$cols .= '				[' . "\n";
					$cols .= '                 \'name\'=>\'' . $pre_conv[0] . '\',' . "\n";
					$cols .= '                 \'data\'=>\'' . $pre_conv[0] . '\',' . "\n";
					$cols .= '                 \'title\'=>trans(\'{lang}.' . $pre_conv[0] . '\'),' . "\n";
					$cols .= '		    ],' . "\n";
				}

			} elseif (preg_match('/#/i', $conv)) {
				$pre_conv = explode('#', $conv);

				if (!preg_match('/' . $pre_conv[0] . '/', $cols) && !empty(request('dt_show_column')) && in_array($pre_conv[0], request('dt_show_column'))) {
					$cols .= '				[' . "\n";
					$cols .= '                 \'name\'=>\'' . $pre_conv[0] . '\',' . "\n";
					$cols .= '                 \'data\'=>\'' . $pre_conv[0] . '\',' . "\n";
					$cols .= '                 \'title\'=>trans(\'{lang}.' . $pre_conv[0] . '\'),' . "\n";
					$cols .= '		    ],' . "\n";
				}
			} elseif (!empty(request('dt_show_column')) && in_array($conv, request('dt_show_column'))) {
				$cols .= '				[' . "\n";
				$cols .= '                 \'name\'=>\'' . $conv . '\',' . "\n";
				$cols .= '                 \'data\'=>\'' . $conv . '\',' . "\n";
				$cols .= '                 \'title\'=>trans(\'{lang}.' . $conv . '\'),' . "\n";
				$cols .= '		    ],' . "\n";
			}

			$i2++;
		}

		if (!empty(request('datatable_created_at'))) {
			$cols .= '            [
	                \'name\' => \'created_at\',
	                \'data\' => \'created_at\',
	                \'title\' => trans(\'admin.created_at\'),
	                \'exportable\' => false,
	                \'printable\'  => false,
	                \'searchable\' => false,
	                \'orderable\'  => false,
	            ],
	        ';
		}
		if (!empty(request('datatable_updated_at'))) {
			$cols .= '            [
	                \'name\' => \'updated_at\',
	                \'data\' => \'updated_at\',
	                \'title\' => trans(\'admin.updated_at\'),
	                \'exportable\' => false,
	                \'printable\'  => false,
	                \'searchable\' => false,
	                \'orderable\'  => false,
	            ],
	        ';
		}
		if (!empty(request('datatable_action'))) {
			$cols .= '            [
	                \'name\' => \'actions\',
	                \'data\' => \'actions\',
	                \'title\' => trans(\'admin.actions\'),
	                \'exportable\' => false,
	                \'printable\'  => false,
	                \'searchable\' => false,
	                \'orderable\'  => false,
	            ],
    	';
		}

		$cols .= ' ];
			}';
		$cols = str_replace('{lang}', $r->input('lang_file'), $cols);
		return $cols;
	}

	public static function htmlMethod($r) {
		$stud = '';
		// for ($i = 0; $i < count(request('col_name')); $i++) {
		// 	$stud .= ($i + 1) . ',';
		// }

		$x = 0;
		$finaldropdown = '';
		$finalinputs = '';
		$finalInputsCount = '';
		foreach ($r->input('col_name_convention') as $conv) {

			// select or dropdown static (enum) In Rules Start
			if ($r->input('col_type')[$x] == 'select') {
				$dropdown = '';
				$ex_select = explode('|', $conv);
				if (!preg_match('/App/i', $ex_select[1])) {
					if (!empty($ex_select[1])) {
						$lang = $r->input('lang_file');
						$options = explode('/', $ex_select[1]);
						$dropdown .= "[" . "\n";
						foreach ($options as $op) {
							$kv = explode(',', $op);
							$dropdown .= "            '" . $kv[0] . "'=>trans('" . $lang . "." . $kv[0] . "')," . "\n";
						}
						$dropdown .= "            ]";
					}
				} elseif (preg_match('/App/i', $ex_select[1]) && $r->has('forginkeyto' . $x)) {
					// If Pluck Model Do Some Change To get first column to end column
					// Pakets Model
					$pluck_ex = str_replace('(', '', explode('pluck', $ex_select[1])[1]);
					$pluck_ex = str_replace(')', '', $pluck_ex);
					$pluck_ex = str_replace("'", "", $pluck_ex);
					$pluck_ex = explode(',', $pluck_ex);

					// Final Pluck Model
					$new_pluck = explode('::', $ex_select[1])[0] . '::pluck("' . $pluck_ex[0] . '","' . $pluck_ex[0] . '")';

					$dropdown .= "{pluck}";
					// Append New Pluck
					$dropdown = str_replace('{pluck}', '\\' . $new_pluck, $dropdown);
				}

				if (!empty(request('dt_show_column')) && in_array($ex_select[0], request('dt_show_column'))) {
					$select_sort = 0;
					if (!empty(request('datatable_checkbox')) && !empty(request('datatable_record_id'))) {
						$select_sort = ($x + 2);
					} elseif (empty(request('datatable_checkbox')) && empty(request('datatable_record_id')) && count(request('dt_show_column')) > 1) {
						$select_sort = ($x - 1);
					} elseif (empty(request('datatable_checkbox')) && empty(request('datatable_record_id')) && count(request('dt_show_column')) == 0) {
						$select_sort = ($x - 2);
					} else {
						$select_sort = ($x + 2);
					}

					$finaldropdown .= '            //' . $ex_select[0] . implode(',', request('dt_show_column')) . $select_sort . "\n";
					$finaldropdown .= '            ". filterElement(\'' . $select_sort . '\', \'select\', ' . $dropdown . ') . "' . "\n";
				}

			} elseif ($r->input('col_type')[$x] != 'file' && !empty(request('dt_show_column')) && in_array($conv, request('dt_show_column'))) {
				if ($finalInputsCount != 1) {
					$finalInputsCount .= "1," . ($x + 2) . ",";
				} else {
					$finalInputsCount .= ($x + 2) . ",";
				}
			}
			// select or dropdown static (enum) In Rules End

			$x++;
		}

		if (!empty($finalInputsCount)) {
			$finalinputs .= '' . "\n";
			$finalinputs .= '            ". filterElement(\'' . rtrim($finalInputsCount, ",") . '\', \'input\') . "' . "\n";
		}

		if (empty(request('datatable_filter'))) {
			$finalinputs = '';
			$finaldropdown = '';
		}

		$html = '
    	 /**
	     * Optional method if you want to use html builder.
	     *' . it_version_message() . '
	     * @return \Yajra\Datatables\Html\Builder
	     */
    	public function html()
	    {
	      $html =  $this->builder()
            ->columns($this->getColumns())
            //->ajax(\'\')
            ->parameters([
               \'searching\'   => ' . self::enableOptions('datatable_searching') . ',
               \'paging\'   => ' . self::enableOptions('datatable_paging') . ',
               \'bLengthChange\'   => ' . self::enableOptions('datatable_lengthmenu') . ',
               \'bInfo\'   => ' . self::enableOptions('datatable_lengthmenu') . ',
               \'responsive\'   => true,
                \'dom\' => \'Blfrtip\',
                "lengthMenu" => [[10, 25, 50,100, -1], [10, 25, 50,100, trans(\'admin.all_records\')]],
                \'buttons\' => [
                ' . self::buttons() . '
                ],
                \'initComplete\' => "function () {


            ' . $finalinputs . '
            ' . $finaldropdown . '

	            }",
                \'order\' => [[1, \'desc\']],

                    \'language\' => [
                       \'sProcessing\' => trans(\'admin.sProcessing\'),
							\'sLengthMenu\'        => trans(\'admin.sLengthMenu\'),
							\'sZeroRecords\'       => trans(\'admin.sZeroRecords\'),
							\'sEmptyTable\'        => trans(\'admin.sEmptyTable\'),
							\'sInfo\'              => trans(\'admin.sInfo\'),
							\'sInfoEmpty\'         => trans(\'admin.sInfoEmpty\'),
							\'sInfoFiltered\'      => trans(\'admin.sInfoFiltered\'),
							\'sInfoPostFix\'       => trans(\'admin.sInfoPostFix\'),
							\'sSearch\'            => trans(\'admin.sSearch\'),
							\'sUrl\'               => trans(\'admin.sUrl\'),
							\'sInfoThousands\'     => trans(\'admin.sInfoThousands\'),
							\'sLoadingRecords\'    => trans(\'admin.sLoadingRecords\'),
							\'oPaginate\'          => [
								\'sFirst\'            => trans(\'admin.sFirst\'),
								\'sLast\'             => trans(\'admin.sLast\'),
								\'sNext\'             => trans(\'admin.sNext\'),
								\'sPrevious\'         => trans(\'admin.sPrevious\'),
							],
							\'oAria\'            => [
								\'sSortAscending\'  => trans(\'admin.sSortAscending\'),
								\'sSortDescending\' => trans(\'admin.sSortDescending\'),
							],
                    ]
                ]);

        return $html;

	    }

    	';
		return $html;
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

	public static function queryMethod($r) {
		$query = '
     /**
     * Get the query object to be processed by dataTables.
     * Auto Ajax Method By Baboon Script ' . it_version_message() . '
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
	public function query()
    {
        return {Model}::query(){WithRelation}->select("' . self::convention_name(request('model_name')) . '.*");

    }
    	';

		$WithRelation = '';
		$i2 = 0;
		foreach ($r->input('col_name_convention') as $conv) {
			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$pre_conv = explode('|', $conv);
				if ($r->has('forginkeyto' . $i2)) {
					$WithRelation .= "'$pre_conv[0]',";
				}
			}
			$i2++;
		}

		if (!empty($WithRelation)) {
			$query = str_replace('{WithRelation}', '->with([' . $WithRelation . '])', $query);
		} else {
			$query = str_replace('{WithRelation}', '', $query);
		}

		$query = str_replace('{Model}', $r->input('model_name'), $query);
		return $query;
	}

	public static function ajaxMethod($r) {
		$ajax = '
     /**
     * dataTable to render Columns.
     * Auto Ajax Method By Baboon Script ' . it_version_message() . '
     * @return \Illuminate\Http\JsonResponse
     */
    public function dataTable(DataTables $dataTables, $query)
    {
        return datatables($query)
            ->addColumn(\'actions\', \'{path}.{name}.buttons.actions\')' . "\n\r";
		$i = 0;
		$rowColumnsHtml = '';
		foreach ($r->input('col_name_convention') as $conv) {

			if ($r->input('col_type')[$i] != 'dropzone') {

				if (
					$r->has('video' . $i) ||
					$r->has('mp4' . $i) ||
					$r->has('mpeg' . $i) ||
					$r->has('mov' . $i) ||
					$r->has('3gp' . $i) ||
					$r->has('webm' . $i) ||
					$r->has('mkv' . $i) ||
					$r->has('wmv' . $i) ||
					$r->has('avi' . $i) ||
					$r->has('vob' . $i)) {
					$ajax .= '            ->addColumn(\'' . $conv . '\', \'{!! view("admin.show_video",["video"=>$' . $conv . '])->render() !!}\')' . "\n\r";
					$rowColumnsHtml .= '"' . $conv . '"' . ',';
				} elseif ($r->has('mp3' . $i)) {
					$ajax .= '            ->addColumn(\'' . $conv . '\', \'{!! view("admin.show_audio",["audio"=>$' . $conv . '])->render() !!}\')' . "\n\r";
					$rowColumnsHtml .= '"' . $conv . '"' . ',';
				} elseif ($r->has('image' . $i)) {
					$ajax .= '            ->addColumn(\'' . $conv . '\', \'{!! view("admin.show_image",["image"=>$' . $conv . '])->render() !!}\')' . "\n\r";
					$rowColumnsHtml .= '"' . $conv . '"' . ',';
				} elseif ($r->input('col_type')[$i] == 'file' && !$r->has('image' . $i)) {
					$ajax .= '            ->addColumn(\'' . $conv . '\', \'<a href="{{ it()->url($' . $conv . ') }}" target="_blank"><i class="fa fa-download fa-2x"></i></a>\')' . "\n\r";
					$rowColumnsHtml .= '"' . $conv . '"' . ',';
				}
			}
			// Here Add Column To Enum Values Start //
			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$pre_conv = explode('|', $conv);
				if (!request()->has('forginkeyto' . $i)) {
					$ajax .= '            ->addColumn(\'' . $pre_conv[0] . '\', \'{{ trans("admin.".$' . $pre_conv[0] . ') }}\')' . "\n\r";
				}
			}
			// Here Add Column To Enum Values Start //

			$i++;
		}

		$ajax .= '   		->addColumn(\'created_at\', \'{{ date("Y-m-d H:i:s",strtotime($created_at)) }}\')';
		$ajax .= '   		->addColumn(\'updated_at\', \'{{ date("Y-m-d H:i:s",strtotime($updated_at)) }}\')';

		$ajax .= '            ->addColumn(\'checkbox\', \'<div  class="icheck-danger">
                  <input type="checkbox" class="selected_data" name="selected_data[]" id="selectdata{{ $id }}" value="{{ $id }}" >
                  <label for="selectdata{{ $id }}"></label>
                </div>\')
            ->rawColumns([\'checkbox\',\'actions\',' . $rowColumnsHtml . ']);
    }
  ';

		$nameclass = str_replace('controller', '', strtolower($r->input('controller_name')));

		$ajax = str_replace('{name}', $nameclass, $ajax);
		$blade_path = str_replace('resources.views.', '', str_replace('/', '.', $r->input('admin_folder_path')));
		$ajax = str_replace('{path}', $blade_path, $ajax);

		return $ajax;
	}

	public static function buttons() {
		$buttons = '';
		if (!empty(request('datatable_print'))) {
			$buttons .= '	[
					  \'extend\' => \'print\',
					  \'className\' => \'btn btn-outline\',
					  \'text\' => \'<i class="fa fa-print"></i> \'.trans(\'admin.print\')
					 ],';
		}
		if (!empty(request('datatable_xlxs'))) {
			$buttons .= '	[
					\'extend\' => \'excel\',
					\'className\' => \'btn btn-outline\',
					\'text\' => \'<i class="fa fa-file-excel"> </i> \'.trans(\'admin.export_excel\')
					],';
		}
		if (!empty(request('datatable_csv'))) {
			$buttons .= '	[
					\'extend\' => \'csv\',
					\'className\' => \'btn btn-outline\',
					\'text\' => \'<i class="fa fa-file-excel"> </i> \'.trans(\'admin.export_csv\')
					],';
		}
		if (!empty(request('datatable_pdf'))) {
			$buttons .= '	[
					 \'extend\' => \'pdf\',
					 \'className\' => \'btn btn-outline\',
					 \'text\' => \'<i class="fa fa-file-pdf"> </i> \'.trans(\'admin.export_pdf\')
					],';
		}
		if (!empty(request('datatable_reload'))) {
			$buttons .= '	[
					\'extend\' => \'reload\',
					\'className\' => \'btn btn-outline\',
					\'text\' => \'<i class="fa fa-sync-alt"></i> \'.trans(\'admin.reload\')
					],';
		}
		if (!empty(request('datatable_delete'))) {
			$buttons .= '	[
						\'text\' => \'<i class="fa fa-trash"></i> \'.trans(\'admin.delete\'),
						\'className\'    => \'btn btn-outline deleteBtn\',
                    ], ';
		}
		if (!empty(request('datatable_add'))) {
			$buttons .= '	[
                        \'text\' => \'<i class="fa fa-plus"></i> \'.trans(\'admin.add\'),
                        \'className\'    => \'btn btn-primary\',
                        \'action\'    => \'function(){
                        	window.location.href =  "\'.\URL::current().\'/create";
                        }\',
                    ],';
		}
		return $buttons;
	}

	public static function enableOptions($name) {
		return !empty(request($name)) ? 'true' : 'false';
	}
}
