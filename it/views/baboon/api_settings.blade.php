
@push('baboon_js')
<script type="text/javascript">
function showLink(checkbox_val,type,method,controller_name,url=''){
	var url_data = "{{url('api/v1')}}/"+controller_name+url;
   	if(checkbox_val == type){
    if($('.api_url_list').find('li.'+checkbox_val).length !== 0){
     $('.'+checkbox_val).remove();
    }else{
     if(method == 'GET'){
     	var color = '#28a745';
     }else if(method == 'POST'){
     	var color = '#c5b11f';
     }else if(method == 'PUT'){
     	var color = '#007bff';
     }else if(method == 'DELETE'){
     	var color = '#b6313e';
     }else{
     	var color = '';
     }
     var method = '<b style="color:'+color+'">'+method+'</b>';
   	 $('.api_url_list').append('<li style="margin-top:8px" class="'+checkbox_val+'"> '+method+' : '+url_data+'</li>');
    }
   	}
}
$(document).on('click','.api_url',function(){
    var checkbox_val = $(this).val();
    var controller_name = $('input[name="controller_name"]').val().toLowerCase();

    showLink(checkbox_val,'api_index','GET',controller_name);
    showLink(checkbox_val,'api_show','GET',controller_name,'/{PUT_YOUR_ID}');
    showLink(checkbox_val,'api_create','POST',controller_name);
    showLink(checkbox_val,'api_update','PUT',controller_name,'/{PUT_YOUR_ID}');
    showLink(checkbox_val,'api_delete','DELETE',controller_name,'/{PUT_YOUR_ID}');
    showLink(checkbox_val,'api_multi_delete','POST',controller_name,'/multi_delete');
});

var controller_name = $('input[name="controller_name"]').val().toLowerCase();
@if(api_check('api_index') == 'checked')
    showLink('api_index','api_index','GET',controller_name);
@endif

@if(api_check('api_show') == 'checked')
    showLink('api_show','api_show','GET',controller_name,'/{PUT_YOUR_ID}');
@endif

@if(api_check('api_create') == 'checked')
    showLink('api_create','api_create','POST',controller_name);
@endif

@if(api_check('api_update') == 'checked')
    showLink('api_update','api_update','PUT',controller_name,'/{PUT_YOUR_ID}');
@endif

@if(api_check('api_delete') == 'checked')
    showLink('api_delete','api_delete','DELETE',controller_name,'/{PUT_YOUR_ID}');
@endif

@if(api_check('api_multi_delete') == 'checked')
    showLink('api_multi_delete','api_multi_delete','POST',controller_name,'/multi_delete');
@endif

</script>
@endpush
<div class="col-md-12 col-lg-12 col-xs-12">
	<center><h1>{{ it_trans('it.api_settings') }}</h1></center>
	<div class="col-md-4">
		<h4>Show Columns</h4>
		<div style="overflow: auto;height:150px">
			<ol class="api_columns_list"></ol>
		</div>
	</div>
	<div class="col-md-6">
		<h4>API URL show in postman json</h4>
		<ol class="api_url_list"></ol>
	</div>
	<div class="col-md-2">
		<h4>Choose API URL</h4>
		<ol>
		  <li>
		  	<label>
		  		<input type="checkbox" class="api_url" {{ api_check('api_index') }} name="api_url[]" value="api_index">
		  		Index
		  	</label>
		  </li>
		  <li>
		  	<label>
		  		<input type="checkbox" class="api_url" {{ api_check('api_show') }} name="api_url[]"  value="api_show">
		  		Show
		  	</label>
		  </li>
		  <li>
		  	<label>
		  		<input type="checkbox" class="api_url"  {{ api_check('api_create') }} name="api_url[]" value="api_create">
		  		Create
		  	</label>
		  </li>
		  <li>
		  	<label>
		  		<input type="checkbox" class="api_url" {{ api_check('api_update') }} name="api_url[]" value="api_update">
		  		Update
		  	</label>
		  </li>
		  <li>
		  	<label>
		  		<input type="checkbox" class="api_url" {{ api_check('api_delete') }} name="api_url[]" value="api_delete">
		  		Delete
		  	</label>
		  </li>
		  <li>
		  	<label>
		  		<input type="checkbox" class="api_url" {{ api_check('api_multi_delete') }} name="api_url[]" value="api_multi_delete">
		  		Multi Delete
		  	</label>
		  </li>
		</ol>
	</div>
</div>