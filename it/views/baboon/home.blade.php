@extends('index')
@section('it')
<link href="{{it_des('it/css/baboon.css')}}" rel="stylesheet" id="bootstrap-css">
<script>
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
$(document).ready(function() {
var i      = 999; //maximum input boxes allowed
var wrapper         = $(".input_fields_wrap"); //Fields wrapper
var add_button      = $(".add_field_button"); //Add button ID
var x = 0; //initlal text box count
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
var x2 = 0; //initlal text box count
$(add_button2).click(function(e){ //on add input button click
e.preventDefault();
if(x2 < i2){ //max input box allowed
x2++; //text box increment
$(wrapper2).append(@include('baboon.new_input2')); //add input box
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
});
</script>
@if(session()->has('code'))
{!! session()->get('code') !!}
@endif
<div class="alert alert-danger messages_baboon hidden"></div>
<div class="alert alert-success success_message hidden"></div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 baboon-tab-container">
  <form method="post" id="baboon">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 baboon-tab-menu">
      <div class="list-group">
        <center>
        <h1>
        <b>
        <span style="color:#b49150">{{it_trans('it.baboon')}} 🙈</span>
        </b>
        </h1>
        </center>
        <a href="#" class="list-group-item active text-left">
          <h4 class="fa fa-info fa-2x"></h4> Initialize CRUD
        </a>
        <a href="#" class="list-group-item text-left">
          <h4 class="fa fa-language fa-2x"></h4> Language & Other
        </a>
        <a href="#" class="list-group-item text-left">
          <h4 class="fa fa-columns fa-2x"></h4> columns & Inputs
        </a>
        <a href="#" class="list-group-item text-left">
          <h4 class="fa fa-database fa-2x"></h4>  Relations Models
        </a>
        <hr />
        <center>
        <input type="button"  class="btn btn-primary btn-lg generate" value="{{it_trans('it.generate_crud')}} 🙈" />
        <i class="fa fa-spinner fa-2x fa-spin loading_genereate hidden"></i>
        <br>
        <br>
        </center>
      </div>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 baboon-tab">
      <div class="baboon-tab-content active">
        {!! it_views('baboon.Initialize') !!}
      </div>
      <div class="baboon-tab-content">
        {!! it_views('baboon.language') !!}
      </div>
      <div class="baboon-tab-content">
        {!! it_views('baboon.columns_input') !!}
      </div>
      <div class="baboon-tab-content">
        {!! it_views('baboon.relations') !!}
      </div>
    </div>
    <input type="hidden" name="_token" value="{{csrf_token()}}" />
  </form>
</div>
<script type="text/javascript">
$(document).ready(function(){
$(document).on('click','.generate',function(){
var form = $('#baboon').serialize();
$.ajax({
url:'{{ URL::current() }}',
dataType:'json',
type:'post',
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
  //console.log(xhr.responseJSON);
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
});
</script>
@endsection