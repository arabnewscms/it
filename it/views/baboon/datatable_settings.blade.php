@php
function datatable_check($name){
$module_data = app('module_data');
if(!empty($module_data->datatable)){
if(!empty($module_data->datatable->$name) && $module_data->datatable->$name == 'yes'){
return ['checked',''];
}else{
return ['none','hidden'];
}
}else{
return ['checked',''];
}
}
@endphp
<div class="col-md-12">
  <div class="col-md-6"><h3>Datatable Settings</h3></div>
  <div class="col-md-6"><h3>Buttons & columns & element</h3></div>
  <div class="clearfix"></div>
  {{-- <hr />
  <div class="col-md-12">
    <center>Show Columns</center>
    <table class="table table-bordered table-striped table-hover">
      <thead class="datatable_columns">
      </thead>
    </table>
  </div> --}}
  <div class="clearfix"></div>
  <hr />
  <div class="col-md-12">
    <center>Show Buttons & elements</center>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_pdf" {{ datatable_check('datatable_pdf')[0] }} value="yes">
      <i class="fa fa-file-pdf"></i> Export PDF
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_csv" {{ datatable_check('datatable_csv')[0] }} value="yes">
      <i class="fa fa-file-excel"></i> Export CSV
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_xlxs"  {{ datatable_check('datatable_xlxs')[0] }} value="yes">
      <i class="fa fa-file-excel"></i> Export xlxs
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_print" {{ datatable_check('datatable_print')[0] }} value="yes">
      <i class="fa fa-print"></i> Print
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_reload" {{ datatable_check('datatable_reload')[0] }} value="yes">
      <i class="fa fa-sync-alt"></i> Reload
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_add" {{ datatable_check('datatable_add')[0] }} value="yes">
      <i class="fa fa-plus"></i> Add button
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_delete" {{ datatable_check('datatable_delete')[0] }} value="yes">
      <i class="fa fa-trash"></i> Delete
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_action" {{ datatable_check('datatable_action')[0] }} value="yes">
      <i class="fa fa-wrench"></i> Actions
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_created_at" {{ datatable_check('datatable_created_at')[0] }} value="yes">
      <i class="fa fa-calendar"></i> created at
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_updated_at" {{ datatable_check('datatable_updated_at')[0] }} value="yes">
      <i class="fa fa-calendar"></i> updated at
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_filter" {{ datatable_check('datatable_filter')[0] }} value="yes">
      <i class="fa fa-filter"></i> filter in footer
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_checkbox" {{ datatable_check('datatable_checkbox')[0] }} value="yes">
      <i class="fa fa-check-square"></i> checkbox
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_record_id" {{ datatable_check('datatable_record_id')[0] }} value="yes">
      <i class="fa fa-list-ol"></i> Record id
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_lengthmenu" {{ datatable_check('datatable_lengthmenu')[0] }} value="yes">
      <i class="fa fa-caret-down"></i> Menu lengh
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_searching"  {{ datatable_check('datatable_searching')[0] }} value="yes">
      <i class="fa fa-search"></i> Searching
    </label>
  </div>
  <div class="col-md-2">
    <label>
      <input type="checkbox" name="datatable_paging" {{ datatable_check('datatable_paging')[0] }} value="yes">
      <i class="fa fa-step-backward"></i> <i class="fa fa-step-forward"></i>  pagination
    </label>
  </div>
</div>
<hr />
<div class="col-md-12">
  <div class="container-fluid">
    <div class="card card-dark">
      <div class="card-header">
        <h3 class="card-title">Example CRUD</h3>
        <div class="card-tools"></div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="table-responsive"  dir="rtl">
            <div id="dataTableBuilder_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="dt-buttons btn-group flex-wrap">
              <button class="btn btn-secondary buttons-print {{ datatable_check('datatable_print')[1] }} datatable_print" type="button"><span><i class="fa fa-print"></i> Print</span>
              </button>
              <button class="btn btn-secondary datatable_xlxs {{ datatable_check('datatable_xlxs')[1] }} buttons-excel " type="button"><span><i class="fa fa-file-excel"></i> Export Excel</span>
              </button>
              <button class="btn btn-secondary datatable_pdf {{ datatable_check('datatable_pdf')[1] }} buttons-pdf" type="button"><span><i class="fa fa-file-pdf"></i> Export  PDF</span>
              </button>
              <button class="btn btn-secondary buttons-csv {{ datatable_check('datatable_csv')[1] }} datatable_csv" type="button"><span><i class="fa fa-file-excel"></i> Export CSV</span>
              </button>
              <button class="btn btn-secondary buttons-reload {{ datatable_check('datatable_reload')[1] }} datatable_reload" type="button"><span><i class="fa fa-sync-alt"></i> Reload</span>
              </button>
              <button class="btn btn-secondary  {{ datatable_check('datatable_delete')[1] }} datatable_delete deleteBtn" type="button"><span><i class="fa fa-trash"></i> Delete</span>
              </button>
              <button class="btn btn-secondary {{ datatable_check('datatable_add')[1] }} datatable_add btn-primary" type="button"><span><i class="fa fa-plus"></i> Create</span>
              </button>
            </div>
            <div class="clearfix"></div>
            <div class="dataTables_length {{ datatable_check('datatable_lengthmenu')[1] }} datatable_lengthmenu col-md-2" id="dataTableBuilder_length">
              <label>show
                <select name="dataTableBuilder_length" class="custom-select custom-select-sm form-control pull-left  form-control-sm">
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="-1">All records</option>
                </select>
                Record
              </label>
            </div>
            <div class="col-md-10 datatable_searching {{ datatable_check('datatable_searching')[1] }}">
              <label>search<input type="search" class="form-control form-control-sm" ></label>
            </div>
            <table class="table table-striped table-bordered table-hover table-checkable dataTable no-footer" id="dataTableBuilder">
              <thead>
                <tr role="row" class="">
                  <th width="10px" class="datatable_checkbox {{ datatable_check('datatable_checkbox')[1] }}" rowspan="1" colspan="1" style="width: 37px;" >
                    <div class="icheck-danger">
                      <input type="checkbox" class="select-all" id="select-all">
                      <label for="select-all"></label>
                    </div>
                  </th>
                  <th title="Record id" width="10px" class="datatable_record_id {{ datatable_check('datatable_record_id')[1] }}" rowspan="1" colspan="1" style="width: 24px;" >Record id</th>
                  <th title="created at" class="datatable_created_at {{ datatable_check('datatable_created_at')[1] }}" rowspan="1" colspan="1" style="width: 234px;">
                    created at
                  </th>
                  <th title="Updated at" class="datatable_updated_at {{ datatable_check('datatable_updated_at')[1] }}" rowspan="1" colspan="1" style="width: 201px;">
                    Updated at
                  </th>
                  <th title="Action" class="datatable_action {{ datatable_check('datatable_action')[1] }}" rowspan="1" colspan="1" style="width: 113px;">
                    Action
                  </th>
                </tr>
              </thead>
              <tfoot class="datatable_filter {{ datatable_check('datatable_filter')[1] }}">
              <tr>
                <th rowspan="1" colspan="1" class="datatable_checkbox {{ datatable_check('datatable_checkbox')[1] }}"></th>
                <th rowspan="1" colspan="1">
                  <input style="width: 100%" class="form-control">
                </th>
                <th rowspan="1" colspan="1" class="datatable_created_at {{ datatable_check('datatable_created_at')[1] }}"></th>
                <th rowspan="1" colspan="1" class="datatable_updated_at {{ datatable_check('datatable_updated_at')[1] }}"></th>
                <th rowspan="1" colspan="1" class="datatable_action {{ datatable_check('datatable_action')[1] }}"></th>
              </tr>
              </tfoot>
              <tbody>
                <tr class="odd">
                  <td valign="top" colspan="6" class="dataTables_empty">
                    <center>Empty Table</center>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="dataTables_info">Empty Table</div>
            <div class="datatable_paging {{ datatable_check('datatable_paging')[1] }}">
              <ul class="pagination">
                <li class="paginate_button page-item previous disabled">
                  <a href="#" class="page-link">Previous</a>
                </li>
                <li class="paginate_button page-item next disabled">
                  <a href="#"  class="page-link">Next</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    </div>
  </div>
</div>
</div>