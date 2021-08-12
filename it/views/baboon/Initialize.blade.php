<div class="col-md-9">
<div class="col-md-12">
@if(!empty($getAllModule) && count($getAllModule) > 0)
<script type="text/javascript">
$(document).ready(function(){
  $(document).on('change','.select_module',function(){
    var select_module = $('.select_module option:selected').val();
    if(select_module != ''){
      window.location.href = '{{ url('it/baboon-sd') }}?module='+select_module;
    }
  });
});
</script>
<div class="form-group modules alert alert-info">
  <label for="modules" class="col-md-12">Edit Module From List</label>
    <div class="col-md-8">
  <select name="module" class="form-control select_module">
    <option>......Choose Module.......</option>
      @foreach($getAllModule as $module)
      <option value="{{ $module['file'] }}" {{ request('module') == $module['file']?'selected':'' }}>{{ $module['module_name'] }}</option>
      @endforeach
    </select>
    @if(!empty(request('module')) && !empty($module_last_modified))
    <p>
      <b>Last Modified: {{ $module_last_modified }}</b> <br>
    <a href="{{ url('it/baboon-sd') }}" class="btn btn-danger">Cancel to edit this module</a>
    </p>
    @endif
  </div>
  <div class="clearfix"></div>
</div>
@endif

  <div class="form-group project_title">
      <label for="project_title" class="col-md-12">{{it_trans('it.project_title')}}</label>
      <div class="col-md-8">
        <input type="text" name="project_title"  class="form-control project_title_input"
        value="{{ !empty($module_data)? $module_data->module_name:old('project_title') }}" placeholder="{{it_trans('it.project_title')}}"  />
      </div>
      <div class="col-md-4">

        <a href="#" data-toggle="modal" data-target="#falist"><i class="fa fa-brush fa-2x"></i></a>

      </div>

  </div>
  <div class="form-group">
      <label for="admin_folder_path" class="col-md-12">{{it_trans('it.admin_folder_path')}}</label>
      <select name="admin_folder_path" size="5" class="form-control admin_folder_path">

        <option value="resources/views"
{{ !empty($module_data) && $module_data->admin_folder_path == 'resources/views' ?'selected':''}}
        >resources/views</option>
        @foreach( array_filter(glob(base_path('resources/views').'/*'), 'is_dir') as $admin_pathes)
<?php
$admin_path = 'resources' . explode('resources', $admin_pathes)[1];
?>

<option value="{{$admin_path}}"
@if(!empty($module_data) )
{{ $module_data->admin_folder_path == $admin_path ?'selected':''}}
@else
{{ preg_match('/admin/i',$admin_path)?'selected':'' }}
@endif
>{{$admin_path}}</option>
        @endforeach
    </select>
  </div>
</div>

<div class="col-md-6 form-group model_name">
  <label for="model_name" class="col-md-12">{{it_trans('it.model_name')}}</label>
  <input type="text" name="model_name" dir="ltr" value="{{ !empty($module_data)?$module_data->model_name: old('model_name')}}" class="form-control" placeholder="{{it_trans('it.model_name')}}"  />
  <label for="model_namespace" class="col-md-12">{{it_trans('it.model_namespace')}}</label>

  <select name="model_namespace" size="5" class="form-control model_namespace">
    <option value="App" selected>App</option>
    @foreach(array_filter(glob(app_path().'/*'), 'is_dir') as $namespaces)

<?php
// Check if Duplicate name to explode it
$namespace_ex_model = explode('app', $namespaces);
// check if offset 2 not empty and exisist
if (isset($namespace_ex_model[2]) && !empty($namespace_ex_model[2])) {
	$model_prefix = str_replace('/', '\\', 'App\\' . $namespace_ex_model[2]);
} else {
	$model_prefix = str_replace('/', '\\', 'App\\' . $namespace_ex_model[1]);
}
$model_prefix = str_replace('\\\\', '\\', $model_prefix);
?>
@if(!preg_match('/Exceptions|Console|DataTables|it|ItHelpers|Mail|Http|Handlers|Providers/i',$model_prefix))
    <option value="{{$model_prefix}}"
    {{ !empty($module_data) && $module_data->model_namespace == $model_prefix?'selected':'' }}
    >{{$model_prefix}}</option>
    @endif
    @endforeach
  </select>


</div>

  <div class="col-md-6">
<div class="form-group controller_name">
    <label for="controller_name" class="col-md-12">{{it_trans('it.controller_name')}}</label>
    <input type="text" name="controller_name" dir="ltr" value="{{!empty($module_data)?$module_data->controller_name:old('controller_name')}}" class="form-control" placeholder="{{it_trans('it.controller_name')}}"  />

  <label for="controller_namespace" class="col-md-12">{{it_trans('it.controller_namespace')}}</label>

<select name="controller_namespace" size="5" class="form-control controller_namespace">
      <option value="App\Http\Controllers"
       {{ !empty($module_data) && $module_data->controller_namespace == 'App\Http\Controllers'?'selected':'' }}
       selected="selected">App\Http\Controllers</option>
      @foreach(array_filter(glob(app_path('Http/Controllers').'/*'), 'is_dir') as $namespaces)
<?php
// Check if Duplicate name to explode it
$ex_controller_path = explode('app', $namespaces);
// check if offset 2 not empty and exisist
if (isset($ex_controller_path[2]) && !empty($ex_controller_path[2])) {
	$controller_namespace_prefix = str_replace('/', '\\', 'App\\' . $ex_controller_path[2]);
} else {
	$controller_namespace_prefix = str_replace('/', '\\', 'App\\' . $ex_controller_path[1]);
}
$controller_namespace_prefix = str_replace('\\\\', '\\', $controller_namespace_prefix);
?>

      @if(!empty($controller_namespace_prefix))
      <option value="{{$controller_namespace_prefix}}"
      {{ !empty($module_data) && $module_data->controller_namespace == $controller_namespace_prefix?'selected':'' }}
      >{{$controller_namespace_prefix}}</option>
      {!! getnamespace($controller_namespace_prefix) !!}
      @endif
      @endforeach
    </select>

    <input type="text" placeholder="Add New Namespace Controller" name="c_namespace"
                class="form-control c_namespace" />
    <a href="#" class="btn btn-primary addcnamespace"><i class="fa fa-plus"></i> Add New Namespace Controllers</a>
    <p class="preview_c_namespace"></p>
    <div class="clearfix"></div>
  </div>
</div>
</div>
<div class="col-md-3">
  <center><h3>Simulator Menu</h3></center>

<ul dir="rtl">
  <li><span class="fa_menulist">
    <i class="{{ !empty($module_data)? $module_data->fa_icon:'' }}"></i>
  </span> <span class="project_title_final">{{ !empty($module_data)? $module_data->module_name:'None Name' }}</span> </li>
  <li>
    <ul>
      <li>
        <span class="fa_menulist">
        <i class="{{ !empty($module_data)? $module_data->fa_icon:'' }}"></i>
        </span> <span class="project_title_final">{{ !empty($module_data)? $module_data->module_name:'None Name' }}</span> </li>
      <li><i class="fa fa-plus"></i> {{ trans('admin.create') }} </li>
    </ul>
  </li>
</ul>
<input type="hidden" name="fa_icon" value="{{ !empty($module_data)? $module_data->fa_icon:old('fa_icon') }}" class="fa_icon">
</div>



<div class="clearfix"></div>



<script type="text/javascript">
$(document).ready(function(){

  $(document).on('click','.getfa',function(){
    var getfa = $(this).attr('fa');
    $('.fa_menulist').html('<i class="'+getfa+' fa-2x"></i>');
    $('.fa_icon').val(getfa);
    return false;
  });

    var fa_lists = {!! json_encode(fa()) !!};

    var icons_list = '';
    $.each(fa_lists, function(k,v){
      icons_list += '<div class="col-md-2" style="margin-bottom:5px"><center><a href="#" class="getfa" title="'+v+'" fa="'+v+'" ><i class="'+v+' fa-2x" aria-hidden="true"></i></a><p>'+v+'</p></center></div>';
    });
      $('.bodyfalist').append(icons_list);




});
$(document).on('keyup','.search_list',function(){

 var search_list = $('.search_list').val();
 var p_title = $('.project_title_input').val();
  var fa_lists = {!! json_encode(fa()) !!};
 if(search_list != '')
 {
 $('.bodyfalist').html('');
    var icons_list = '';
    for (var i=0; i<fa_lists.length; i++) {
      if (fa_lists[i].match(search_list))
        {
            icons_list += '<div class="col-md-2" style="margin-bottom:5px"><center><a href="#" class="getfa" fa="'+fa_lists[i]+'" ><i class="'+fa_lists[i]+' fa-2x" title="'+fa_lists[i]+'" aria-hidden="true"></i></a><p>'+fa_lists[i]+'</p></center></div>';
        }
    }
    $('.bodyfalist').append(icons_list);

 }else{
$('.bodyfalist').html('');
   for (i= 0; i < fa_lists.length;i++) {
     $('.bodyfalist').append('<div class="col-md-2" style="margin-bottom:5px"><center><a href="#" class="getfa" fa="'+fa_lists[i]+'" ><i class="'+fa_lists[i]+' fa-2x"></i></a><p>'+fa_lists[i]+'</p></center></div>');
    }
 }
 if(p_title != '')
 {
  $('.project_title_final').text(p_title);
 }


 var c_namespace =  $('.c_namespace').val();
 var controller_namespace =  $('.controller_namespace option');
 controller_namespace.removeAttr('selected');
 var newnamespace = 'App\\Http\\Controllers\\'+c_namespace;
  $('.preview_c_namespace').removeClass('has-error');
    $('.addcnamespace').removeClass('hidden');

 $.each(controller_namespace,function(k,v){

 if(newnamespace == v.value)
 {
  $('.preview_c_namespace').addClass('has-error');
  $('.addcnamespace').addClass('hidden');
 }

  $('.preview_c_namespace').text(newnamespace);
 });

 if(c_namespace == '')
 {
  $('.preview_c_namespace').text('');
 }

});

///// Append New Namespace Controller Folder ////////

$(document).on('click','a.addcnamespace',function(e){
  var namespace = $('.c_namespace').val();
   $('.controller_namespace').append('<option value="App\\Http\\Controllers\\'+namespace+'" selected>App\\Http\\Controllers\\'+namespace+'</option>');
   $('.preview_c_namespace').text('');
   $('.c_namespace').val('');
 $.ajax({
   url:'{{ url('it/create/namespace/controller') }}',
   dataType:'json',
   type:'post',
   data:{_token:'{{ csrf_token() }}',namespace:namespace}
 });
///// Append New Namespace Controller Folder ////////

return false;
});

</script>

<!-- Modal -->
<div id="falist" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="width:95%;margin-top: 65px;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Font Awesome Icons</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-6">
          <div class="form-group">
         <label>Search From List</label>
        <input type="text" name="search_list" class="search_list form-control">
        </div>
        </div>
        <div class="col-md-6">
          <br />
          <p>Icon Selected: <span class="fa_menulist"></span></p>

        </div>
        <div class="bodyfalist"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div>

  </div>
</div>