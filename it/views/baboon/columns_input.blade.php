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

/*
each_col_name_other_col
          each_other_col
          before_after_tomorrow

          each_other_carbon0

*/
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
@if(!empty($module_data))
{!! it_views('baboon.new_input_edit') !!}
@else
{!! it_views('baboon.new_input_add') !!}
@endif