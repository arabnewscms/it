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
          if ($('input.func_nullable').is(':checked')) {
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

          if ($('input.date_data').is(':checked')) {
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
          if ($('input.onDelete').is(':checked')) {
            $('.schema_onDelete'+to).removeClass('hidden');
          }else{
            $('.schema_onDelete'+to).addClass('hidden');
          }
      });
      $(document).on('change','.forginkeyto',function(){
        var to = $(this).attr('to');
          if ($('input.forginkeyto').is(':checked')) {
            $('.forginkeyto'+to).removeClass('hidden');
          }else{
            $('.forginkeyto'+to).addClass('hidden');
          }
      });
      </script>
<div class="col-md-12">
  <div class="col-md-4">
    <div class="form-group">
      <label for="col_name" class="col-md-12">{{it_trans('it.col_name')}}</label>
      <div class="col-md-12">
        <input type="text" name="col_name[]" dir="ltr" value="{{old('col_name')}}" class="form-control col_name" placeholder="{{it_trans('it.col_name')}}"  />
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="col_type" class="col-md-12">{{it_trans('it.col_type')}}</label>
      <div class="col-md-12">
        <select name="col_type[]" class="form-control">
          <option value="text">{{it_trans('it.text')}}</option>
          <option value="number">{{it_trans('it.number')}}</option>
          <option value="email">{{it_trans('it.email')}}</option>
          <option value="url">{{it_trans('it.url')}}</option>
          <option value="textarea">{{it_trans('it.textarea')}}</option>
          <option value="select">{{it_trans('it.select')}}</option>
          <option value="file">{{it_trans('it.file')}}</option>
          <option value="password">{{it_trans('it.password')}}</option>
          <option value="checkbox">{{it_trans('it.checkbox')}}</option>
          <option value="radio">{{it_trans('it.radio')}}</option>
          <option value="date">{{it_trans('it.date')}}</option>
          <option value="date_time">{{it_trans('it.date_time')}}</option>
          <option value="time">{{it_trans('it.time')}}</option>
          <option value="timestamp">{{it_trans('it.timestamp')}}</option>
          <option value="color">{{it_trans('it.color')}}</option>
        </select>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <div class="col-md-12">
        <label for="col_name_convention" class="col-md-12">{{it_trans('it.col_name_convention')}}</label>
        <input type="text" name="col_name_convention[]"  to="0" dir="ltr" value="{{old('col_name_convention')}}" class="form-control col_name_convention" placeholder="{{it_trans('it.col_name_convention')}}"  />
        <small style="color:#c33">Select - active|1,yes/0,no</small><br>
        <small style="color:#c33">Select - user_id|App\User::pluck('name','id')</small><br>
        <small style="color:#c33">checkbox or radio - active#1</small><br>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <hr />
  <div class="col-md-12 alert alert-default">
    <div class="col-md-12">
      <label class="mt-radio">
        <input type="radio" name="col_name_null0" class="col_name_null" list="0" id="col_name_null" value="null" checked>
        {{it_trans('it.col_name_null')}}
        <span></span>
      </label>
      -
      <label class="mt-radio">
        <input type="radio" name="col_name_null0" class="col_name_null" list="0" id="col_name_null" value="has">
        {{it_trans('it.not_null')}}
        <span></span>
      </label>
    </div>
    <div class="clearfix"></div>
    <hr />
    <div class="col-md-12 list_validation0 hidden">
      <div class="col-md-3">
        <label class="mt-checkbox" dir="rtl">
          {{it_trans('it.url')}}
          <input type="checkbox" value="1" name="url0" />
        </label>
      </div>
      <div class="col-md-3">
        <label class="mt-checkbox" dir="rtl"> {{it_trans('it.image')}}
          <input type="checkbox" value="1" name="image0" />
        </label>
      </div>
      <div class="col-md-3">
        <label class="mt-checkbox" dir="rtl"> {{it_trans('it.required')}}
          <input type="checkbox" value="1" name="required0" />
        </label>
      </div>
      <div class="col-md-3">
        <label class="mt-checkbox" dir="rtl"> {{it_trans('it.numeric')}}
          <input type="checkbox" value="1" name="numeric0" />
        </label>
      </div>
      <div class="col-md-3">
        <label class="mt-checkbox" dir="rtl"> {{it_trans('it.sometimes')}}
          <input type="checkbox" value="1" name="sometimes0" />
        </label>
      </div>
      <div class="col-md-3">
        <label class="mt-checkbox" dir="rtl"> {{it_trans('it.nullable')}}
          <input type="checkbox" value="1" name="nullable0" />
        </label>
      </div>
      <div class="col-md-3">
        <label class="mt-checkbox" dir="rtl"> {{it_trans('it.confirmed')}}
          <input type="checkbox" value="1" name="confirmed0" />
        </label>
      </div>
      <div class="col-md-3">
        <label class="mt-checkbox" dir="rtl"> {{it_trans('it.string')}}
          <input type="checkbox" value="1" name="string0" />
        </label>
      </div>
      <div class="col-md-3">
        <label class="mt-checkbox" dir="rtl"> {{it_trans('it.alpha-dash')}}
          <input type="checkbox" value="1" name="alpha-dash0" />
        </label>
      </div>
      <div class="clearfix"></div>
      <br>
      <div class="col-md-12">
        <label class="mt-checkbox" dir="rtl"> {{it_trans('it.date')}}
          <input type="checkbox" value="1" class="date_data" to="0" name="date0" />
        </label>
        <div class="date_list0 hidden">
          <div class="col-md-3">
            <label class="" dir="rtl"> {{it_trans('it.date_format')}}</label>
            <select name="date_format0" class="form-control">
              <option  selected>NULL</option>
              <optgroup label="Date">
                <option value="date_format:Y-m-d">date_format:Y-m-d</option>
                <option value="date_format:Y-M-D">date_format:Y-M-D</option>
                <option value="date_format:y-M-D">date_format:y-M-D</option>
                <option value="date_format:y-m-D">date_format:y-m-D</option>
                <option value="date_format:y-m-d">date_format:y-m-d</option>
                <option value="date_format:d-m-Y">date_format:d-m-Y</option>
                <option value="date_format:d-M-Y">date_format:d-M-Y</option>
                <option value="date_format:D-M-Y">date_format:D-M-Y</option>
              </optgroup>
              <optgroup label="Date & Time">
                <option value="date_format:Y-m-d h:i:s">date_format:Y-m-d h:i:s</option>
                <option value="date_format:Y-M-D h:i:s">date_format:Y-M-D h:i:s</option>
                <option value="date_format:y-M-D h:i:s">date_format:y-M-D h:i:s</option>
                <option value="date_format:y-m-D h:i:s">date_format:y-m-D h:i:s</option>
                <option value="date_format:y-m-d h:i:s">date_format:y-m-d h:i:s</option>
                <option value="date_format:d-m-Y h:i:s">date_format:d-m-Y h:i:s</option>
                <option value="date_format:d-M-Y h:i:s">date_format:d-M-Y h:i:s</option>
                <option value="date_format:D-M-Y h:i:s">date_format:D-M-Y h:i:s</option>
              </optgroup>
            </select>
          </div>

          <div class="col-md-3">
            <label class="mt-checkbox" dir="rtl"> {{it_trans('it.after')}}
              <input type="radio" value="after" class="after_before" to="0" name="after_before0" />
            </label>
             -
            <label class="mt-checkbox" dir="rtl"> {{it_trans('it.before')}}
              <input type="radio" value="before" class="after_before" to="0" name="after_before0" />
            </label>
            <div class="after_before_list0 hidden">
              <ol>
              <li>
                 <label class="mt-radio" dir="rtl"> {{it_trans('it.today')}}
                  <input type="radio" value="today" class="before_after_tomorrow" to="0" name="before_after_tomorrow0" />
                 </label>
              </li>
              <li>
                <label class="mt-radio" dir="rtl"> {{it_trans('it.tomorrow')}}
                  <input type="radio" value="tomorrow"  class="before_after_tomorrow" to="0" name="before_after_tomorrow0" />
                </label>
              </li>
              <li>
                <label class="mt-radio" dir="rtl"> {{it_trans('it.other_col')}}
                  <input type="radio" value="other_col"  class="before_after_tomorrow" to="0" name="before_after_tomorrow0" />
                </label>
              </li>
              <li>
                <label class="mt-radio" dir="rtl"> {{it_trans('it.other_carbon')}}
                  <input type="radio" value="other_carbon" class="before_after_tomorrow" to="0" name="before_after_tomorrow0" />
                </label>
              </li>
              </ol>
            </div>
          </div>

          <div class="col-md-3 each_other_col0 hidden">
            Select The Column
            <span class="each_col_name_other_col0"></span>
          </div>

          <div class="col-md-3 each_other_carbon0 hidden">
            Write Carbon Days
            <label>
              Days <input type="text" name="other_carbon0" placeholder="Days" class="form-control" >
            </label>
          </div>

        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="col-md-12 well">
      <h4>Schema Relation</h4>
      <div class="form-group">
        <label class="mt-checkbox" dir="rtl"> {{it_trans('it.forginkeyto')}}      </label>
        <input type="checkbox" value="1" name="forginkeyto0" class="forginkeyto" to="0" value="1" />
      </div>
      <div class="forginkeyto0 hidden">
        <div class="form-group col-md-4">
          <label class="mt-checkbox" dir="rtl"> {{it_trans('it.references')}}
            <input type="text" name="references0" placeholder="{{it_trans('it.references')}}" class="form-control references" to="0" />
          </div>
          <div class="form-group col-md-4">
            <label class="mt-checkbox" dir="rtl"> {{it_trans('it.forgin_table_name')}}
              <input type="text" name="forgin_table_name0" placeholder="{{it_trans('it.forgin_table_name')}}" class="form-control forgin_table_name"  to="0" />
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="mt-checkbox" dir="rtl"> {{it_trans('it.nullable')}}
                  <input type="checkbox" name="schema_nullable0" class="func_nullable" to="0" />
                </div>
                <div class="form-group">
                  <label class="mt-checkbox" dir="rtl"> {{it_trans('it.onDelete')}}
                    <input type="checkbox" name="schema_onDelete0" class="onDelete" to="0" />
                  </div>
                </div>
                <div class="clearfix"></div>
                <p>$table->integer('<span class="col_name_0"></span>')->unsigned()<span class="func_nullable0 hidden">->nullable()</span>;</p>
                <p>$table->foreign('<span class="col_name_0"></span>')->references('<span class="references0"></span>')->on('<span class="forgin_table_name0"></span>')<span  class="schema_onDelete0 hidden">->onDelete('cascade')</span>;</p>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
          <div class="input_fields_wrap"></div>
          <button class="add_field_button btn btn-success"><i class="fa fa-plus"></i></button>
        </div>