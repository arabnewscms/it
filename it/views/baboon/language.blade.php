<div class="col-md-5">
  @include('baboon.installed_packages')
</div>
<div class="col-md-7 well">
  <div class="col-md-12">
    <div class="form-group lang_file">
      <label for="lang_file" class="col-md-12">{{it_trans('it.lang_file')}}</label>
      <input type="text" name="lang_file" dir="ltr"
      @if(!empty($module_data))
      value="{{ $module_data->lang_file }}"
      @else
      value="{{ old('lang_file')?old('lang_file'):'admin' }}"
      @endif
      class="form-control lang_file" placeholder="{{it_trans('it.lang_file')}}"  />
      <i class="fa fa-spinner fa-spin lang_file_loading hidden"></i>
      <span class="lang_file_list"></span>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="mt-checkbox mt-checkbox-outline">
        <input type="checkbox" value="yes" {{ !empty($module_data)?$module_data->use_collective:'checked' }} name="use_collective" />
        {{it_trans('it.use_collective')}}
      </label>
      <p style="color:#c33"><i class="fa fa-info"></i> - Generate HTML LaravelCollective Code</p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="mt-checkbox mt-checkbox-outline">
        <input type="checkbox" value="yes"
        {{ !empty($module_data) && !empty($module_data->ajax_request)?$module_data->ajax_request:'' }} name="ajax_request" />
        {{it_trans('it.ajax_request')}}
      </label>
      <p style="color:#c33"><i class="fa fa-info"></i> - Send Request Form By Ajax </p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="mt-checkbox mt-checkbox-outline">
        <input type="checkbox" value="1" {{ !empty($module_data)?$module_data->auto_migrate:'' }} name="auto_migrate" />
        {{it_trans('it.auto_migrate')}}
      </label>
      <p style="color:#c33"><i class="fa fa-info"></i> - Auto Migrate This CRUD </p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="mt-checkbox mt-checkbox-outline">
        <input type="checkbox" name="make_model" value="yes" {{ !empty($module_data)?$module_data->make_model:'checked' }} >
        Make Model File
      </label>
      <p style="color:#c33"><i class="fa fa-info"></i>  can disable making model file if uncheck this checkbox <br> </p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="mt-checkbox mt-checkbox-outline">
        <input type="checkbox" name="make_migration" value="yes" {{ !empty($module_data)?$module_data->make_migration:'checked' }}>
        Make Migration Schema File
      </label>
      <p style="color:#c33"><i class="fa fa-info"></i>  can disable making migration schema file if uncheck this checkbox <br> </p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="mt-checkbox mt-checkbox-outline">
        <input type="checkbox" name="make_controller" value="yes"  {{ !empty($module_data)?$module_data->make_controller:'checked' }}>
        Make Controller File
      </label>
      <p style="color:#c33"><i class="fa fa-info"></i>  can disable making controller file if uncheck this checkbox <br> </p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="mt-checkbox mt-checkbox-outline">
        <input type="checkbox" name="make_datatable" value="yes"  {{ !empty($module_data)?$module_data->make_datatable:'checked' }}>
        Make Datatable File
      </label>
      <p style="color:#c33"><i class="fa fa-info"></i>  can disable making Datatable file if uncheck this checkbox <br> </p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="mt-checkbox mt-checkbox-outline">
        <input type="checkbox" name="make_views" value="yes"  {{ !empty($module_data)?$module_data->make_views:'checked' }}>
        Make View Files
      </label>
      <p style="color:#c33"><i class="fa fa-info"></i>  can disable making View files if uncheck this checkbox <br> </p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="mt-checkbox mt-checkbox-outline">
        <input type="checkbox" {{ !empty($module_data)?$module_data->has_user_id:'' }}  value="1" name="has_user_id" />
        {{it_trans('it.has_user_id')}}
      </label>
      <p style="color:#c33"><i class="fa fa-info"></i> - Auto Append Admin Id Column &   Auto foregin key with Admins table</p>
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <label class="mt-checkbox mt-checkbox-outline">
        <input type="checkbox" value="1"  {{ !empty($module_data)?$module_data->enable_soft_delete:'' }}  name="enable_soft_delete" />
        {{it_trans('it.enable_soft_delete')}}
      </label>

      <p style="color:#c33"><i class="fa fa-info"></i> - Enable SoftDeletes In This Model & Auto Enable Soft delete in model </p>
    </div>
  </div>
  <div class="clearfix"></div>
  <hr />
  <div class="col-md-12">
    <div class="col-md-6">
    <div class="form-group">
      <label class="mt-checkbox mt-checkbox-outline">
        <input type="checkbox" value="1"  {{ !empty($module_data) && !empty($module_data->generate_faker)?$module_data->generate_faker:'' }}  name="generate_faker" />
        {{it_trans('it.generate_faker')}}
      </label>
      <p style="color:#c33"><i class="fa fa-info"></i> - Generate Fake Data to testing this module (string , numeric , integer , enum , lorem ipsum , CKEDITOR HTML Data , mobile ,phone,etc..) </p>
    </div>
    </div>
@php
$faker_locals = ['ar_SA','ar_JO','at_AT','bg_BG','bn_BD','cs_CZ','da_DK','de_AT','de_CH','de_DE','el_CY','el_GR','en_AU','en_CA','en_GB','en_HK','en_IN','en_NG','en_NZ','en_PH','en_SG','en_UG','en_US','en_ZA','es_AR','es_ES','es_PE','es_VE','et_EE','fa_IR','fi_FI','fr_BE','fr_CA','fr_CH','fr_FR','he_IL','hr_HR','hu_HU','hy_AM','id_ID','is_IS','it_CH','it_IT','ja_JP','ka_GE','kk_KZ','ko_KR','lt_LT','lv_LV','me_ME','mn_MN','ms_MY','nb_NO','ne_NP','nl_BE','nl_NL','pl_PL','pt_BR','pt_PT','ro_MD','ro_RO','ru_RU','sk_SK','sl_SI','sr_Cyrl_RS','sr_Latn_RS','sr_RS','sv_SE','th_TH','tr_TR','uk_UA','vi_VN','zh_CN','zh_TW',
];
@endphp

    <div class="col-md-6">
     <div class="form-group">
      <label for="faker_local">Faker Language</label>
      <select name="faker_local" class="form-control">
        @foreach($faker_locals as $faker_locale)
        <option value="{{ $faker_locale }}" {{ faker_locale($faker_locale,$module_data)?'selected':'' }}>{{ $faker_locale }}</option>
        @endforeach
      </select>
     </div>
    </div>


  </div>
</div>
<div class="clearfix"></div>