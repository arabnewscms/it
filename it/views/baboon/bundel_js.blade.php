@push('baboon_js')
<!-- DarkMode Section Start -->
<script type="text/javascript">
  //
function darkmode() {
   if($('html').hasClass('dark')){
    window.localStorage.removeItem('mode');
    $('html').removeClass('dark');
   }else{
    window.localStorage.setItem('mode', 'dark');
    $('html').addClass('dark');
   }
}
var DarkMode = window.localStorage.getItem('mode');
$('html').addClass(DarkMode);
</script>
<!-- DarkMode Section End -->

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
    if(xhr.responseJSON){
		if(xhr.responseJSON.errors !== 'undefined')
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


function hideOrShowRow(rowname){
  return $('input[value="'+rowname+'"]').is(':checked')?'':'hidden';
}

$(document).ready(function(){

  $(document).on('click','.dt_checkbox',function(){
   var dt_checkbox = $(this).val();
    if($(this).is(':checked')){
      $('.'+dt_checkbox).removeClass('hidden');
    }else{
      $('.'+dt_checkbox).addClass('hidden');
    }
  });



// loadColumns Start//
$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
  $('.datatable_columns').html('<center><i class="fa fa-spinner fa-spin"></i></center>');
 var col_name_datatable = [];
 var col_convention_datatable = [];
 var col_type_datatable = [];

 $('input[name="col_name_convention[]"]').each(function(){
   col_convention_datatable.push($(this).val());
 });

 $('input[name="col_name[]"]').each(function(){
   col_name_datatable.push($(this).val());
 });

  $('select[name="col_type[]"]').each(function(){
   col_type_datatable.push($(this).val());
 });

 $('.dataTables_empty').attr('colspan',col_name_datatable.length+5);

 var table_cols = ' <tr role="row">';
 var table_cols_footer = '<tr>';
 var table_checkbox = ' <tr role="row">';
  // datatable_checkbox //
 table_cols +=`
  <th width="10px" class="datatable_checkbox `+hideOrShowRow('datatable_checkbox')+`" style="width: 37px;" >
        <input type="checkbox" class="select-all" id="select-all">
    </th>
 `;
 table_cols_footer += `<th class="datatable_checkbox `+hideOrShowRow('datatable_checkbox')+`"></th>`;
  // datatable_checkbox //

 // datatable_record_id //
 table_cols +=`
  <th title="Record id" width="10px" class="datatable_record_id `+hideOrShowRow('datatable_record_id')+`" style="width: 24px;" >Record id</th>
 `;
 table_cols_footer += `<th class="datatable_record_id `+hideOrShowRow('datatable_record_id')+`">
                    <input style="width: 100%" class="form-control">
                </th>`;
 // datatable_record_id //

// This for to put checkboxes to scan if checked or not //
 for(i=0;i < col_name_datatable.length;i++){
    var conv_col_checkbox = col_convention_datatable[i].split('|');
    if(col_type_datatable[i] != 'dropzone'){
     table_checkbox += `
        <th>
        <label>
        `+col_name_datatable[i]+`
         <input type="checkbox" {{ !empty(request('module'))?'':'checked' }} class="dt_checkbox" name="dt_show_column[]" value="`+conv_col_checkbox[0]+`" />
        </label>
    </th>
    `;
    }
 }
 $('.datatable_columns_checkboxes').html(table_checkbox);
 @if(!empty(request('module')) && !empty(app('module_data')->datatable) && !empty(app('module_data')->datatable->dt_show_column))
 @php
 $dt_show_columns = app('module_data')->datatable->dt_show_column;
 @endphp
  @foreach($dt_show_columns as $dt_show_column)
   $('input[value="{{ $dt_show_column }}"]').prop('checked', true);
  @endforeach
 @endif

setTimeout(function(){

 for(i=0;i < col_name_datatable.length;i++){
  var conv_col = col_convention_datatable[i].split('|');
  if(col_type_datatable[i] != 'dropzone'){
   table_cols += `<th class="`+conv_col[0]+` `+hideOrShowRow(conv_col[0])+`">`+col_name_datatable[i]+`</th>`;
   }

    if(conv_col[1] !== '' && conv_col[1] !== undefined){
    table_cols_footer += `<th class="`+conv_col[0]+` `+hideOrShowRow(conv_col[0])+`">
                    <select class="form-control">
                      <option>.........</option>
                    </select>
                </th>`;
    }else if(col_type_datatable[i] != 'dropzone'){
    table_cols_footer += `<th class="`+conv_col[0]+` `+hideOrShowRow(conv_col[0])+`">
                    <input style="width: 100%" class="form-control">
                </th>`;
    }

 }

 // datatable_created_at //
  table_cols +=`
    <th class="datatable_created_at `+hideOrShowRow('datatable_created_at')+`" >
    created at
    </th>
 `;
  table_cols_footer+=`<th class="datatable_created_at `+hideOrShowRow('datatable_created_at')+`"></th>`;
 // datatable_created_at //

 // datatable_updated_at //
   table_cols +=`
    <th class="datatable_updated_at `+hideOrShowRow('datatable_updated_at')+`" >
    Updated at
    </th>
 `;
  table_cols_footer+=`<th class="datatable_updated_at `+hideOrShowRow('datatable_updated_at')+`"></th>`;
 // datatable_updated_at //


  // datatable_action //
   table_cols +=`
    <th class="datatable_action `+hideOrShowRow('datatable_action')+`" >
    Action
    </th>
 `;
  table_cols_footer+=`<th class="datatable_action `+hideOrShowRow('datatable_action')+`"></th>`;
  // datatable_action //

 table_cols_footer+=`</tr>`;


 $('.datatable_columns').html(table_cols);
 $('.datatable_footer_rows').html(table_cols_footer);
 },10);

/////////////////////////////////////////////////////////////////////////////
// Api Section Start
 var col_name_api = [];
 var col_convention_api = [];
 var col_type_api = [];

 $('input[name="col_name_convention[]"]').each(function(){
   col_convention_api.push($(this).val());
 });

 $('input[name="col_name[]"]').each(function(){
   col_name_api.push($(this).val());
 });

 $('select[name="col_type[]"]').each(function(){
   col_type_api.push($(this).val());
 });

var api_columns = '';
   for(i=0;i < col_name_api.length;i++){
    var conv_col_checkbox = col_convention_api[i].split('|');
    if(col_type_api[i] != 'dropzone'){
     api_columns += `
        <li>
        <label>
         <input type="checkbox" {{ !empty(request('module'))?'':'checked' }}  name="api_show_column[]" value="`+conv_col_checkbox[0]+`" />
        `+col_name_api[i]+`
        </label>
        </li>
    `;
    }
 }

  $('.api_columns_list').html(api_columns);
   @if(!empty(request('module')) && !empty(app('module_data')->api) && !empty(app('module_data')->api->api_show_column))
 @php
 $api_show_columns = app('module_data')->api->api_show_column;
 @endphp
  @foreach($api_show_columns as $api_show_column)
   $('input[value="{{ $api_show_column }}"]').prop('checked', true);
  @endforeach
 @endif
// Api Section End


 });

// loadColumns End//

});
</script>
<!-- datatable Tab Section End -->
@endpush