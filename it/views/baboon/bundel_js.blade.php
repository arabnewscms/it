@push('baboon_js')
<!-- Home Section Start -->
<script type="text/javascript">
$(document).ready(function() {


// Linked With Ajax Code //
$(document).on('click','.link_ajax',function(){
var to = $(this).attr('to');

if($(this).is(':checked')){
var select_list_to_ajax = '<select name="select_ajax_link'+to+'" class="form-control">';
  $('input[name="col_name_convention[]"]').each(function(){
  var vselect = $(this).val();
   select_list_to_ajax += '<option value="'+vselect+'">'+vselect+'</option>';
  });
   select_list_to_ajax += '</select>';
  $('.each_ajax_cols'+to).html(select_list_to_ajax);
 }else{
  $('.each_ajax_cols'+to).html('');
 }
});

// Linked With Ajax Code End //



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


var i      = 999; //maximum input boxes allowed
var wrapper         = $(".input_fields_wrap"); //Fields wrapper
var add_button      = $(".add_field_button"); //Add button ID
var x = {{ !empty($module_data) && $module_data->count_inputs > 0?
($module_data->count_inputs-1):0 }}; //initlal text box count
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
var x2 = {{ !empty($module_data) && $module_data->relation_count > 0?
($module_data->relation_count-1):0 }}; //initlal text box count
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
    $('.fa_menulist').html('<i class="'+getfa+' fa-1x"></i>');
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
<!-- columns & inputs Tab Section start -->
 <script type="text/javascript">
      $(document).on('keyup','.col_name_convention',function(){
         var to = $(this).attr('to');
         var col_name_convention = $(this).val();
         $('.col_name_'+to).text(col_name_convention.split("|")[0]);

      });

      $(document).on('keyup','.references',function(){
         var to = $(this).attr('to');
         var references = $(this).val();
         $('.references'+to).text(references);

      });

      $(document).on('keyup','.forgin_table_name',function(){
         var to = $(this).attr('to');
         var forgin_table_name = $(this).val();
         $('.forgin_table_name'+to).text(forgin_table_name);

      });

      $(document).on('change','.func_nullable',function(){
        var to = $(this).attr('to');
          if ($(this).is(':checked')) {
            $('.func_nullable'+to).removeClass('hidden');
          }else{
            $('.func_nullable'+to).addClass('hidden');
          }
      });


      $(document).on('change','.before_after_tomorrow',function(){
        var to = $(this).attr('to');
        var val = $(this).val();
        if(val == 'other_col')
        {
         $('.each_other_carbon'+to).addClass('hidden');
         $('.each_other_col'+to).removeClass('hidden');
         var select_list = '<select name="other_cal_before_after'+to+'" class="form-control">';
         $('input[name="col_name_convention[]"]').each(function(){
          var vselect = $(this).val();
           select_list += '<option value="'+vselect+'">'+vselect+'</option>';
         });
         select_list += '</select>';
         $('.each_col_name_other_col'+to).html(select_list);
        }else if(val == 'other_carbon')
        {
         $('.each_col_name_other_col'+to).html('');
         $('.each_other_col'+to).addClass('hidden');
         $('.each_other_carbon'+to).removeClass('hidden');
        }else{
            $('.each_col_name_other_col'+to).html('');
            $('.each_other_col'+to).addClass('hidden');
            $('.each_other_carbon'+to).addClass('hidden');
        }
      });

  $(document).on('change','.date_data',function(){

        var to  = $(this).attr('to');

          if ($(this).is(':checked')) {
            $('.date_list'+to).removeClass('hidden');
          }else{
            $('.date_list'+to).addClass('hidden');
          }
      });

      $(document).on('change','input:radio.after_before',function(){
        var to = $(this).attr('to');

            $('.each_other_carbon'+to).addClass('hidden');
            $('.each_other_col'+to).addClass('hidden');
            $('.each_col_name_other_col'+to).html('');
            $('.after_before_list'+to).removeClass('hidden');
            $('input[name=before_after_tomorrow'+to+'][value="today"]').prop('checked', true);
      });

      $(document).on('change','.onDelete',function(){
        var to = $(this).attr('to');
          if ($(this).is(':checked')) {
            $('.schema_onDelete'+to).removeClass('hidden');
          }else{
            $('.schema_onDelete'+to).addClass('hidden');
          }
      });
      $(document).on('change','.onUpdate',function(){
        var to = $(this).attr('to');
          if ($(this).is(':checked')) {
            $('.schema_onUpdate'+to).removeClass('hidden');
          }else{
            $('.schema_onUpdate'+to).addClass('hidden');
          }
      });
      $(document).on('change','.forginkeyto',function(){
        var to = $(this).attr('to');
          if ($(this).is(':checked')) {
            $('.forginkeyto'+to).removeClass('hidden');
          }else{
            $('.forginkeyto'+to).addClass('hidden');
          }
      });
      </script>
<script type="text/javascript">
$(document).ready(function(){
 $(document).on('click','.additional_input',function(){
    var additional_input = $(this);
    var input_name = additional_input.attr('input_name');
    var num = additional_input.attr('num');
   if(additional_input.is(':checked')){
     $('input[name="'+input_name+num+'"]').removeClass('hidden');
     console.log(input_name+num);
   }else if(!additional_input.is(':checked')){
     $('input[name="'+input_name+num+'"]').addClass('hidden');
   }
 });
});
</script>
<!-- columns & inputs Tab Section End -->
<!-- datatable Tab Section start -->
<script type="text/javascript">
function show_hide_datatable(name){
$(document).on('click','input[name="'+name+'"]',function(){
		if($(this).is(':checked')){
			$('.'+name).removeClass('hidden');
		}else{
			$('.'+name).addClass('hidden');
		}
	});
}

$(document).ready(function(){

show_hide_datatable('datatable_pdf');
show_hide_datatable('datatable_csv');
show_hide_datatable('datatable_xlxs');
show_hide_datatable('datatable_print');
show_hide_datatable('datatable_reload');
show_hide_datatable('datatable_delete');
show_hide_datatable('datatable_add');
show_hide_datatable('datatable_action');
show_hide_datatable('datatable_created_at');
show_hide_datatable('datatable_updated_at');
show_hide_datatable('datatable_filter');
show_hide_datatable('datatable_checkbox');
show_hide_datatable('datatable_record_id');
show_hide_datatable('datatable_lengthmenu');
show_hide_datatable('datatable_searching');
show_hide_datatable('datatable_paging');

});
</script>
<!-- datatable Tab Section End -->
@endpush