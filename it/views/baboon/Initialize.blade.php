<div class="col-md-9">
<div class="col-md-12">
  <div class="form-group project_title">
      <label for="project_title" class="col-md-12">{{it_trans('it.project_title')}}</label>
      <div class="col-md-8">
        <input type="text" name="project_title" value="{{old('project_title')}}" class="form-control project_title_input" placeholder="{{it_trans('it.project_title')}}"  />
      </div>
      <div class="col-md-4">

        <a href="#" data-toggle="modal" data-target="#falist"><i class="fa fa-paint-brush"></i></a>

      </div>

  </div>
  <div class="form-group">
      <label for="admin_folder_path" class="col-md-12">{{it_trans('it.admin_folder_path')}}</label>
      <select name="admin_folder_path" size="5" class="form-control admin_folder_path">
        <option value="resources/views">resources/views</option>
        @foreach( array_filter(glob(base_path('resources/views').'/*'), 'is_dir') as $admin_pathes)
<?php
$admin_path = 'resources'.explode('resources', $admin_pathes)[1];
?>
<option value="{{$admin_path}}" {{ preg_match('/admin/i',$admin_path)?'selected':'' }}>{{$admin_path}}</option>
        @endforeach
    </select>
  </div>
</div>

<div class="col-md-6 form-group model_name">
  <label for="model_name" class="col-md-12">{{it_trans('it.model_name')}}</label>
  <input type="text" name="model_name" dir="ltr" value="{{old('model_name')}}" class="form-control" placeholder="{{it_trans('it.model_name')}}"  />
  <label for="model_namespace" class="col-md-12">{{it_trans('it.model_namespace')}}</label>
  <select name="model_namespace" size="5" class="form-control model_namespace">
    <option value="App" selected>App</option>
    @foreach( array_filter(glob(app_path().'/*'), 'is_dir') as $namespaces)
    }
<?php
$model_prefix = str_replace('/', '\\', 'App\\'.explode('app', $namespaces)[1]);
$model_prefix = str_replace('\\\\', '\\', $model_prefix);
?>
@if(!preg_match('/Exceptions|Console|it|ItHelpers|Mail|Http|Providers/i',$model_prefix))
    <option value="{{$model_prefix}}">{{$model_prefix}}</option>
    @endif
    @endforeach
  </select>
</div>

  <div class="col-md-6">
<div class="form-group controller_name">
    <label for="controller_name" class="col-md-12">{{it_trans('it.controller_name')}}</label>
    <input type="text" name="controller_name" dir="ltr" value="{{old('controller_name')}}" class="form-control" placeholder="{{it_trans('it.controller_name')}}"  />

  <label for="controller_namespace" class="col-md-12">{{it_trans('it.controller_namespace')}}</label>

<select name="controller_namespace" size="5" class="form-control controller_namespace">
      <option value="App\Http\Controllers" selected="selected">App\Http\Controllers</option>
      @foreach( array_filter(glob(app_path('Http/Controllers').'/*'), 'is_dir') as $namespaces)
<?php
$controller_namespace_prefix = str_replace('/', '\\', 'App\\'.explode('app', $namespaces)[1]);
$controller_namespace_prefix = str_replace('\\\\', '\\', $controller_namespace_prefix);
?>
      @if(!empty($controller_namespace_prefix))
      <option value="{{$controller_namespace_prefix}}">{{$controller_namespace_prefix}}</option>
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
<ul>
  <li> <span class="project_title_final">None Name</span> <span class="fa_menulist"><i class="fa fa-list"></i></span></li>
  <li>
    <ul>
      <li> <span class="project_title_final">None Name</span> <span class="fa_menulist"><i class="fa fa-list"></i></span></li>
      <li>{{ trans('admin.create') }} <i class="fa fa-plus"></i></li>
    </ul>
  </li>
</ul>
<input type="hidden" name="fa_icon" class="fa_icon">
</div>



<div class="clearfix"></div>



<script type="text/javascript">
$(document).ready(function(){

  $(document).on('click','.getfa',function(){
    var getfa = $(this).attr('fa');
    $('.fa_menulist').html('<i class="fa '+getfa+'"></i>');
    $('.fa_icon').val(getfa);
    return false;
  });

    var fa_lists = {!! json_encode(fa()) !!};

    var icons_list = '';
    $.each(fa_lists, function(k,v){
      icons_list += '<a href="#" class="getfa" fa="'+v+'" ><i class="fa '+v+' fa-2x"></i></a>';
    });
      $('.bodyfalist').append(icons_list);




});
$(document).on('keyup',function(){

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
            icons_list += '<a href="#" class="getfa" fa="'+fa_lists[i]+'" ><i class="fa '+fa_lists[i]+' fa-2x"></i></a>';
        }
    }
    $('.bodyfalist').append(icons_list);

 }else{
$('.bodyfalist').html('');
   for (i= 0; i < fa_lists.length;i++) {
     $('.bodyfalist').append('<a href="#" class="getfa" fa="'+fa_lists[i]+'" ><i class="fa '+fa_lists[i]+' fa-2x"></i></a>');
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
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Font Awesome Icons</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
         <label>Search From List</label>
        <input type="text" name="search_list" class="search_list form-control">
        </div>
        <div class="bodyfalist">


        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>