<div class="col-md-6">
  <div class="form-group lang_file">
    <label for="lang_file" class="col-md-12">{{it_trans('it.lang_file')}}</label>
    <input type="text" name="lang_file" dir="ltr" value="{{old('lang_file')?old('lang_file'):'admin'}}" class="form-control lang_file" placeholder="{{it_trans('it.lang_file')}}"  />
    <i class="fa fa-spinner fa-spin lang_file_loading hidden"></i>
    <span class="lang_file_list"></span>
  </div>
</div>
<div class="clearfix"></div>
<div class="col-md-4">
  <div class="form-group">

    @if(check_package("laravelcollective/html") === null)
    <div class="alert alert-warning">
      <h4> <i class="fa fa-info"></i> LaravelCollective Package Is Not Installed</h4>
      <br>
      Run this command In Your Terminal / CMD <br>
      php artisan it:install laravelcollective
    </div>
    @else
    <div class="alert alert-success">
      <h5><i class="fa fa-check"></i> LaravelCollective Is Installed</h5>
      LaravelCollective {{ check_package("laravelcollective/html") }}<hr>
      To Remove This  Package <br> Run this command In Your Terminal / CMD <br>
      php artisan it:uninstall laravelcollective
    </div>
    @endif

     @if(check_package("yajra/laravel-datatables-oracle") === null)
    <div class="alert alert-warning">
      <h4> <i class="fa fa-info"></i> Yajra DataTables Package Is Not Installed</h4>
      <br>
      Run this command In Your Terminal / CMD <br>
      php artisan it:install yajra
    </div>
    @else
    <div class="alert alert-success">
      <h5><i class="fa fa-check"></i> Yajra Is Installed</h5>
      Yajra {{ check_package("yajra/laravel-datatables-oracle") }}<hr>
      To Remove This  Package <br> Run this command In Your Terminal / CMD <br>
      php artisan it:uninstall yajra
    </div>
    @endif


    @if(check_package("intervention/image") === null)
    <div class="alert alert-warning">
      <h4> <i class="fa fa-info"></i> intervention Image Package Is Not Installed</h4>
      <br>
      Run this command In Your Terminal / CMD <br>
      php artisan it:install intervention
    </div>
    @else
    <div class="alert alert-success">
      <h5><i class="fa fa-check"></i> intervention Is Installed</h5>
      intervention Image {{ check_package("intervention/image") }}<hr>
      To Remove This  Package <br> Run this command In Your Terminal / CMD <br>
      php artisan it:uninstall intervention
    </div>
    @endif


  </div>
</div>
<div class="col-md-4">
  <div class="form-group">
    <label class="mt-checkbox mt-checkbox-outline">
      <input type="checkbox" value="yes" name="use_collective" />
      {{it_trans('it.use_collective')}}
    </label>
    <p style="color:#c33"><i class="fa fa-info"></i> - Generate HTML Code to LaravelCollective Package</p>

  </div>
</div>


<div class="col-md-4">
  <div class="form-group">
    <label class="mt-checkbox mt-checkbox-outline">
      <input type="checkbox" value="1" name="enable_soft_delete" />
      {{it_trans('it.enable_soft_delete')}}
    </label>
    <p style="color:#c33"><i class="fa fa-info"></i> - Enable SoftDeletes In This Model & <br>Auto Enable Soft delete in model </p>
  </div>
</div>
<div class="col-md-4">
  <div class="form-group">
    <label class="mt-checkbox mt-checkbox-outline">
      <input type="checkbox" value="1" name="auto_migrate" />
      {{it_trans('it.auto_migrate')}}
    </label>
    <p style="color:#c33"><i class="fa fa-info"></i> - Auto Migrate This CRUD </p>
  </div>
</div>
<div class="col-md-4">
  <div class="form-group">
    <label class="mt-checkbox mt-checkbox-outline">
      <input type="checkbox" value="1" name="has_user_id" />
      {{it_trans('it.has_user_id')}}
    </label>
    <p style="color:#c33"><i class="fa fa-info"></i> - Auto Append Admin Id Column & <br> Auto foregin key with Admins table</p>
  </div>
</div>

<div class="col-md-4">
  <div class="form-group">
    <label class="mt-checkbox mt-checkbox-outline">
    <input type="checkbox" name="make_model" value="yes" checked>
        Make Model File
    </label>
    <p style="color:#c33"><i class="fa fa-info"></i>  can disable making model file if uncheck this checkbox <br> </p>
  </div>
</div>

<div class="col-md-4">
  <div class="form-group">
    <label class="mt-checkbox mt-checkbox-outline">
    <input type="checkbox" name="make_migration" value="yes" checked>
        Make Migration Schema File
    </label>
    <p style="color:#c33"><i class="fa fa-info"></i>  can disable making migration schema file if uncheck this checkbox <br> </p>
  </div>
</div>

<div class="col-md-4">
  <div class="form-group">
    <label class="mt-checkbox mt-checkbox-outline">
    <input type="checkbox" name="make_controller" value="yes" checked>
        Make Controller File
    </label>
    <p style="color:#c33"><i class="fa fa-info"></i>  can disable making controller file if uncheck this checkbox <br> </p>
  </div>
</div>

<div class="col-md-4">
  <div class="form-group">
    <label class="mt-checkbox mt-checkbox-outline">
    <input type="checkbox" name="make_datatable" value="yes" checked>
        Make Datatable File
    </label>
    <p style="color:#c33"><i class="fa fa-info"></i>  can disable making Datatable file if uncheck this checkbox <br> </p>
  </div>
</div>

<div class="col-md-4">
  <div class="form-group">
    <label class="mt-checkbox mt-checkbox-outline">
    <input type="checkbox" name="make_views" value="yes" checked>
        Make View Files
    </label>
    <p style="color:#c33"><i class="fa fa-info"></i>  can disable making View files if uncheck this checkbox <br> </p>
  </div>
</div>
<div class="clearfix"></div>