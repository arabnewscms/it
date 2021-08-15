@push('baboon_js')
<!-- Home Section Start -->
<script type="text/javascript">
$(document).ready(function() {
$(document).on('click','.col_name_null',function(){
var list  = $(this).attr('list');
var check = $(this).val();
	if(check == 'has')
	{
		$('.list_validation'+list).removeClass('hidden');
	}else{
		$('.list_validation'+list).addClass('hidden');
	}
});

$(document).on('change','.relation_type',function(){
 var val = $("option:selected", this).val();
 var linkmods = $(this).attr('linkmods');
 $('.typedata_relation'+linkmods).text(val);

});

$(document).on('change','.linkatmodel',function(){
 var val = $("option:selected", this).val();
 var linkmod = $(this).attr('linkmod');
 $('.classSpace'+linkmod).text(val);
});

$(document).on('keyup','.schema_name',function(){
 var schema_name = $(this).val();
 var number = $(this).attr('number');
 $('.funcname'+number).text(schema_name);
 $('.forginkey'+number).text(schema_name);
});

<?php
$data = [];
$baboonModule = (new \Phpanonymous\It\Controllers\Baboon\CurrentModuleMaker\BaboonModule);
// Load all Modules
$getAllModule = $baboonModule->getAllModules();

$data['getAllModule'] = $getAllModule;
if (!empty(request('module')) && !is_null(request('module'))) {
	$Modulefile = 'baboon/' . request('module');
	// Edit Modules
	$readmodule = $baboonModule->read($Modulefile);
	if ($readmodule === false) {
		// redirect if fails load Files
		header('Location: ' . url('it/baboon-sd'));
		exit;
	} else {
		$data['module_data'] = $readmodule;
	}
} else {
	$data['module_data'] = null;
	$data['module_last_modified'] = null;
}
?>

var i      = 999; //maximum input boxes allowed
var wrapper         = $(".input_fields_wrap"); //Fields wrapper
var add_button      = $(".add_field_button"); //Add button ID
var x = {{ !empty($data['module_data']) && $data['module_data']->count_inputs > 0?
($data['module_data']->count_inputs-1):0 }}; //initlal text box count
$(add_button).click(function(e){ //on add input button click
e.preventDefault();
if(x < i){ //max input box allowed
	x++; //text box increment
	$(wrapper).append(@include('baboon.new_input')); //add input box
}
});

$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	e.preventDefault();
$(this).parent('div').remove();
	x--;
});
var i2      = 999; //maximum input boxes allowed
var wrapper2         = $(".input_fields_wrap2"); //Fields wrapper
var add_button2      = $(".add_field_button2"); //Add button ID
var x2 = {{ !empty($data['module_data']) && $data['module_data']->relation_count > 0?
($data['module_data']->relation_count-1):0 }}; //initlal text box count
$(add_button2).click(function(e){ //on add input button click
	e.preventDefault();
if(x2 < i2){ //max input box allowed
	x2++; //text box increment
	$(wrapper2).append(@include('baboon.relation_input')); //add input box
}
});
$(wrapper2).on("click",".remove_field2", function(e){ //user click on remove text
	e.preventDefault();
	$(this).parent('div').remove();
	x2--;
});

$(document).on('click','.controller_namespace_get',function(){
	var val = $(this).attr('list');
	$('.controller_namespace').val(val);
	$('.controller_namespace_list').html('');
});

// Generate New CRUD Ajax Code Start //
$(document).on('click','.generate',function(){
    var form = $('#baboon').serialize();
	$.ajax({
		url:'{{ URL::current() }}',
		dataType:'json',
		type:'post',
		timeout: 0,
		data:form,
	beforeSend: function()
	{
	  $('.success_message').addClass('hidden');
	  $('.success_message').html('');
	  $('.generate').addClass('hidden');
	  $('.messages_baboon').addClass('hidden');
	  $('.messages_baboon').html('');
	  $('.form-group').removeClass('has-error');
	  $('.loading_genereate').removeClass('hidden');
	},success: function(data)
	{
		if(data.status == true)
		{
		  $('.success_message').removeClass('hidden');
		  $('.success_message').html('<h1>'+data.message+'</h1>');
		  $('html,body').animate({ scrollTop: 0 }, 1000);
		}
		$('.generate').removeClass('hidden');
		$('.loading_genereate').addClass('hidden');
	},error: function(xhr)
	{
		if(xhr.responseJSON.errors)
		{
		  var errors = '<ul>';
		  $.each(xhr.responseJSON.errors,function(k,v){
		  $('.'+k).addClass('has-error');
		 	 errors +='<li>'+v+'</li>';
		  });
		errors += '</ul>';
		}else{
			var  errors = xhr.responseJSON.message;
		}
	  $('.messages_baboon').html(errors);
	  $('.messages_baboon').removeClass('hidden');
	  $('.generate').removeClass('hidden');
	  $('.loading_genereate').addClass('hidden');
	  $('html,body').animate({ scrollTop: 0 }, 1000);
	}
  });
});
// Generate New CRUD Ajax Code End //

});
</script>
<!-- Home Section End -->



<!-- initialize Tab Section Start -->
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
$(document).on('keyup','.project_title_input',function(){
  var p_title = $('.project_title_input').val();
  $('.project_title_final').text(p_title);
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
<!-- initialize Tab Section End -->
@endpush