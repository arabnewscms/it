<?php
namespace Phpanonymous\It\Controllers\Baboon;

use App\Http\Controllers\Controller;

class BaboonDataTable extends Controller {
	//
	public static $copyright = '[It V 1.0 | https://it.phpanonymous.com]';

	public static function dbclass($r) {
		$datatable = '<?php
namespace App\DataTables;
use {Model};
//use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;
// Auto DataTable By Baboon Script
// Baboon Maker has been Created And Developed By ' . self::$copyright . '
// Copyright Reserved ' . self::$copyright . '
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
	     * Auto getColumns Method By Baboon Script ' . self::$copyright . '
	     * @return array
	     */

	    protected function getColumns()
	    {
	        return [
	        [
                \'name\' => \'checkbox\',
                \'data\' => \'checkbox\',
                \'title\' => \'<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                  <input type="checkbox" class="select-all" onclick="select_all()" >
                  <span></span></label>\',
                \'orderable\'      => false,
                \'searchable\'     => false,
                \'exportable\'     => false,
                \'printable\'      => false,
                \'width\'          => \'10px\',
                \'aaSorting\'      => \'none\'
            ],


	        ' . "\n";
		foreach ($r->input('col_name_convention') as $conv) {
			$cols .= '				[' . "\n";
			if (preg_match('/(\d+)\+(\d+)|,/i', $conv)) {
				$pre_conv = explode('|', $conv);

				$cols .= '                 \'name\'=>\'' . $pre_conv[0] . '\',' . "\n";
				$cols .= '                 \'data\'=>\'' . $pre_conv[0] . '\',' . "\n";
				$cols .= '                 \'title\'=>trans(\'{lang}.' . $pre_conv[0] . '\'),' . "\n";
			} elseif (preg_match('/#/i', $conv)) {
				$pre_conv = explode('#', $conv);
				if (!preg_match('/' . $pre_conv[0] . '/', $cols)) {
					$cols .= '                 \'name\'=>\'' . $pre_conv[0] . '\',' . "\n";
					$cols .= '                 \'data\'=>\'' . $pre_conv[0] . '\',' . "\n";
					$cols .= '                 \'title\'=>trans(\'{lang}.' . $pre_conv[0] . '\'),' . "\n";
				}
			} else {
				$cols .= '                 \'name\'=>\'' . $conv . '\',' . "\n";
				$cols .= '                 \'data\'=>\'' . $conv . '\',' . "\n";
				$cols .= '                 \'title\'=>trans(\'{lang}.' . $conv . '\'),' . "\n";
			}
			$cols .= '		    ],' . "\n";
		}

		$cols .= ' [
	                \'name\' => \'actions\',
	                \'data\' => \'actions\',
	                \'title\' => trans(\'admin.actions\'),
	                \'exportable\' => false,
	                \'printable\'  => false,
	                \'searchable\' => false,
	                \'orderable\'  => false,
	            ]
	        ];
	    }
    	';
		$cols = str_replace('{lang}', $r->input('lang_file'), $cols);
		return $cols;
	}

	public static function htmlMethod($r) {
		$stud = '';
		for ($i = 0; $i < count(request('col_name')); $i++) {
			$stud .= ($i + 1) . ',';
		}
		$html = '
    	 /**
	     * Optional method if you want to use html builder.
	     *' . self::$copyright . '
	     * @return \Yajra\Datatables\Html\Builder
	     */
    	public function html()
	    {
	      $html =  $this->builder()
            ->columns($this->getColumns())
            //->ajax(\'\')
            ->parameters([
               \'responsive\'   => true,
                \'dom\' => \'Blfrtip\',
                "lengthMenu" => [[10, 25, 50,100, -1], [10, 25, 50,100, trans(\'admin.all_records\')]],
                \'buttons\' => [
                    [\'extend\' => \'print\', \'className\' => \'btn dark btn-outline\', \'text\' => \'<i class="fa fa-print"></i> \'.trans(\'admin.print\')],
                    [\'extend\' => \'excel\', \'className\' => \'btn green btn-outline\', \'text\' => \'<i class="fa fa-file-excel-o"> </i> \'.trans(\'admin.export_excel\')],
                    /*[\'extend\' => \'pdf\', \'className\' => \'btn red btn-outline\', \'text\' => \'<i class="fa fa-file-pdf-o"> </i> \'.trans(\'admin.export_pdf\')],*/
                    [\'extend\' => \'csv\', \'className\' => \'btn purple btn-outline\', \'text\' => \'<i class="fa fa-file-excel-o"> </i> \'.trans(\'admin.export_csv\')],
                    [\'extend\' => \'reload\', \'className\' => \'btn blue btn-outline\', \'text\' => \'<i class="fa fa fa-refresh"></i> \'.trans(\'admin.reload\')],
                    [
                        \'text\' => \'<i class="fa fa-trash"></i> \'.trans(\'admin.delete\'),
                        \'className\'    => \'btn red btn-outline deleteBtn\',
                    ], [
                        \'text\' => \'<i class="fa fa-plus"></i> \'.trans(\'admin.add\'),
                        \'className\'    => \'btn btn-primary\',
                        \'action\'    => \'function(){
                        	window.location.href =  "\'.\URL::current().\'/create";
                        }\',
                    ],
                ],
                \'initComplete\' => "function () {
                this.api().columns([' . substr($stud, 0, -1) . ']).every(function () {
                var column = this;
                var input = document.createElement(\"input\");
                $(input).attr( \'style\', \'width: 100%\');
                $(input).attr( \'class\', \'form-control\');
                $(input).appendTo($(column.footer()).empty())
                .on(\'keyup\', function () {
                    column.search($(this).val()).draw();
                });
            });
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

	public static function queryMethod($r) {
		$query = '
     /**
     * Get the query object to be processed by dataTables.
     * Auto Ajax Method By Baboon Script ' . self::$copyright . '
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
	public function query()
    {
        return {Model}::query();

    }
    	';

		$query = str_replace('{Model}', $r->input('model_name'), $query);
		return $query;
	}

	public static function ajaxMethod($r) {
		$ajax = '
     /**
     * Display a listing of the resource.
     * Auto Ajax Method By Baboon Script ' . self::$copyright . '
     * @return \Illuminate\Http\Response
     */

     /**
     * Display ajax response.
     * Auto Ajax Method By Baboon Script ' . self::$copyright . '
     * @return \Illuminate\Http\JsonResponse
     */
    public function dataTable(DataTables $dataTables, $query)
    {
        return datatables($query)
            ->addColumn(\'actions\', \'{path}.{name}.buttons.actions\')
			->addColumn(\'checkbox\', \'<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
			<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}"> <span></span></label>\')
            ->rawColumns([\'checkbox\',\'show_action\',\'actions\',\'user\',\'date\']);
    }
  ';

		$nameclass = str_replace('controller', '', strtolower($r->input('controller_name')));
		$ajax = str_replace('{name}', $nameclass, $ajax);
		$blade_path = str_replace('resources.views.', '', str_replace('/', '.', $r->input('admin_folder_path')));
		$ajax = str_replace('{path}', $blade_path, $ajax);
		return $ajax;
	}
}
