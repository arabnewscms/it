`
<div class="col-md-12 well">
  <div class="col-md-3">
    <div class="form-group">
      <label for="col_name" class="col-md-12">{{it_trans('it.col_name')}}</label>
      <div class="col-md-12">
        <input type="text" name="col_name[]" value="{{old('col_name')}}" class="form-control col_name" placeholder="{{it_trans('it.col_name')}}"  />
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
          <option value="textarea_ckeditor">{{it_trans('it.textarea_ckeditor')}}</option>
          <option value="select">{{it_trans('it.select')}}</option>
          <option value="file">{{it_trans('it.file')}}</option>
          <option value="dropzone">{{it_trans('it.dropzone')}}</option>
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
    <div class="form-group">
      <label for="col_width" class="col-md-12">{{it_trans('it.col_width')}}</label>
       <div class="col-md-3">
        <p>col-lg-6</p>
        <select name="col_width_lg[]" class="form-control">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6" selected>6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
      </div>
      <div class="col-md-3">
        <p>col-md-6</p>
        <select name="col_width_md[]" class="form-control">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6" selected>6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
      </div>
      <div class="col-md-3">
        <p>col-sm-6</p>
        <select name="col_width_sm[]" class="form-control">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6" selected>6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
      </div>
      <div class="col-md-3">
        <p>col-xs-12</p>
        <select name="col_width_xs[]" class="form-control">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12" selected>12</option>
        </select>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <div class="col-md-12">
        <label for="col_name_convention" class="col-md-12">{{it_trans('it.col_name_convention')}}
            <a href="#" data-toggle="modal" data-target="#column_input_modal_info">
              <i class="fa fa fa-info-circle" style="color:#090"></i>
            </a>
        </label>
        <input type="text" name="col_name_convention[]"  to="`+x+`" value="{{old('col_name_convention')}}" class="form-control col_name_convention" placeholder="{{it_trans('it.col_name_convention')}}"  />
         <div class="clearfix"></div>
          <hr />
        <div class="col-md-3">
          <label>
            {{ it_trans('it.connect_ajax') }}
            <input type="checkbox" class="link_ajax" to="`+x+`" name="link_ajax`+x+`" value="yes">
          </label>
        </div>
        <div class="col-md-9 each_ajax_cols`+x+`"></div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <hr />
  <div class="col-md-12 alert alert-info validation">
    <div class="col-md-12">
      <label class="mt-radio">
        <input type="radio" name="col_name_null`+x+`" class="col_name_null" list="`+x+`" id="col_name_null" value="null" checked>
        {{it_trans('it.col_name_null')}}
        <span></span>
      </label>
      -
      <label class="mt-radio">
        <input type="radio" name="col_name_null`+x+`" class="col_name_null" list="`+x+`" id="col_name_null" value="has">
        {{it_trans('it.not_null')}}
        <span></span>
      </label>
    </div>
    <div class="clearfix"></div>
    <hr />
    <div class="col-md-12 list_validation`+x+` hidden">
      <!--- Start Card Rules  -->
      <div id="rulesCard`+x+`">
        <div class="card">
          <div class="card-header">
            <a class="card-link" data-toggle="collapse" data-parent="#rulesCard`+x+`" href="#basic_rules`+x+`">Basic Rules (<span class="col_name_`+x+`"></span>)</a>
          </div>
          <div id="basic_rules`+x+`" class="collapse">
            <div class="card-body">
              <!-- Start basic Rules -->
              <div class="col-md-12">
                <div class="col-md-2">
                  <label class="form-check-input" dir="rtl">
                    email
                    <input type="checkbox" value="1" name="email`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl">
                    {{it_trans('it.url')}}
                    <input type="checkbox" value="1" name="url`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> {{it_trans('it.required')}}
                    <input type="checkbox" value="1" name="required`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> {{it_trans('it.string')}}
                    <input type="checkbox" value="1" name="string`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> integer
                    <input type="checkbox" value="1" name="integer`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> {{it_trans('it.numeric')}}
                    <input type="checkbox" value="1" name="numeric`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> {{it_trans('it.sometimes')}}
                    <input type="checkbox" value="1" name="sometimes`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> {{it_trans('it.nullable')}}
                    <input type="checkbox" value="1" name="nullable`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> {{it_trans('it.confirmed')}}
                    <input type="checkbox" value="1" name="confirmed`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> filled
                    <input type="checkbox" value="1" name="filled`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> alpha
                    <input type="checkbox" value="1" name="alpha`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> {{it_trans('it.alpha-dash')}}
                    <input type="checkbox" value="1" name="alpha-dash`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> alpha_num
                    <input type="checkbox" value="1" name="alpha_num`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> active_url
                    <input type="checkbox" value="1" name="active_url`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> accepted
                    <input type="checkbox" value="1" name="accepted`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> boolean
                    <input type="checkbox" value="1" name="boolean`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> uuid
                    <input type="checkbox" value="1" name="uuid`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> bail
                    <input type="checkbox" value="1" name="bail`+x+`" />
                  </label>
                </div>

                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> present
                    <input type="checkbox" value="1" name="present`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> timezone
                    <input type="checkbox" value="1" name="timezone`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> json
                    <input type="checkbox" value="1" name="json`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> array
                    <input type="checkbox" value="1" name="array`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> ip
                    <input type="checkbox" value="1" name="ip`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> ipv4
                    <input type="checkbox" value="1" name="ipv4`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> ipv6
                    <input type="checkbox" value="1" name="ipv6`+x+`" />
                  </label>
                </div>
                <div class="clearfix"></div>
                <hr />
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> file
                    <input type="checkbox" value="1" name="file`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> {{it_trans('it.image')}}
                    <input type="checkbox" value="1" name="image`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> pdf
                    <input type="checkbox" value="1" name="pdf`+x+`" />
                  </label>
                </div>
                 <div class="clearfix"></div>
                <hr />
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> office
                    <input type="checkbox" value="1" name="office`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> docx
                    <input type="checkbox" value="1" name="docx`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> xlsx
                    <input type="checkbox" value="1" name="xlsx`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> xls
                    <input type="checkbox" value="1" name="xls`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> xltx
                    <input type="checkbox" value="1" name="xltx`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> ppt
                    <input type="checkbox" value="1" name="ppt`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> ppam
                    <input type="checkbox" value="1" name="ppam`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> pptm
                    <input type="checkbox" value="1" name="pptm`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> ppsm
                    <input type="checkbox" value="1" name="ppsm`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> potm
                    <input type="checkbox" value="1" name="potm`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> sldm
                    <input type="checkbox" value="1" name="sldm`+x+`" />
                  </label>
                </div>
                 <div class="clearfix"></div>
                <hr />

                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> audio
                    <input type="checkbox" value="1" name="audio`+x+`" />
                  </label>
                </div>

                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> mp3
                    <input type="checkbox" value="1" name="mp3`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> wav
                    <input type="checkbox" value="1" name="wav`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> xm
                    <input type="checkbox" value="1" name="xm`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> ogg
                    <input type="checkbox" value="1" name="ogg`+x+`" />
                  </label>
                </div>
                 <div class="clearfix"></div>
                <hr />
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> video
                    <input type="checkbox" value="1" name="video`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> mp4
                    <input type="checkbox" value="1" name="mp4`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> mpeg
                    <input type="checkbox" value="1" name="mpeg`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> mov
                    <input type="checkbox" value="1" name="mov`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> 3gp
                    <input type="checkbox" value="1" name="3gp`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> webm
                    <input type="checkbox" value="1" name="webm`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> mkv
                    <input type="checkbox" value="1" name="mkv`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> wmv
                    <input type="checkbox" value="1" name="wmv`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> avi
                    <input type="checkbox" value="1" name="avi`+x+`" />
                  </label>
                </div>
                <div class="col-md-2" >
                  <label class="form-check-input" dir="rtl"> vob
                    <input type="checkbox" value="1" name="vob`+x+`" />
                  </label>
                </div>
              </div>
              <!-- End basic Rules -->
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <a class="collapsed card-link" data-toggle="collapse" data-parent="#rulesCard`+x+`" href="#advanced_rules`+x+`">Advanced Rules (<span class="col_name_`+x+`"></span>)</a>
          </div>
          <div id="advanced_rules`+x+`" class="collapse">
            <div class="card-body">
              <!-- Start Advanced Rules -->
              <div class="col-md-12">
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> required_if
                    <input type="checkbox" class="additional_input" input_name="required_if_text" num="`+x+`" value="1" name="required_if`+x+`" />
                    <input type="text" class="form-control hidden" value="request_name,=,value"  name="required_if_text`+x+`" />
                    <p>(example: required_if:payment_type,cc or request_name,=,value or request_name,>,value or request_name,<,value or request_name,!=,value)</p>
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> required_unless:anotherfield,value,...
                    <input type="checkbox" class="additional_input" input_name="required_unless_text" num="`+x+`" value="1" name="required_unless`+x+`" />
                    <input type="text" class="form-control hidden" value="anotherfield,value"  name="required_unless_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> required_with:foo,bar,...
                    <input type="checkbox" class="additional_input" input_name="required_with_text" num="`+x+`" value="1" name="required_with`+x+`" />
                    <input type="text" class="form-control hidden" value="foo,bar"  name="required_with_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> required_with_all:foo,bar,...
                    <input type="checkbox" class="additional_input" input_name="required_with_all_text" num="`+x+`" value="1" name="required_with_all`+x+`" />
                    <input type="text" class="form-control hidden" value="foo,bar"  name="required_with_all_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> required_without:foo,bar,...
                    <input type="checkbox" class="additional_input" input_name="required_without_text" num="`+x+`" value="1" name="required_without`+x+`" />
                    <input type="text" class="form-control hidden" value="foo,bar"  name="required_without_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> required_without_all:foo,bar,...
                    <input type="checkbox" class="additional_input" input_name="required_without_all_text" num="`+x+`" value="1" name="required_without_all`+x+`" />
                    <input type="text" class="form-control hidden" value="foo,bar"  name="required_without_all_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> same:field
                    <input type="checkbox" class="additional_input" input_name="same_text" num="`+x+`" value="1" name="same`+x+`" />
                    <input type="text" class="form-control hidden" value="field"  name="same_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> size:value
                    <input type="checkbox" class="additional_input" input_name="size_text" num="`+x+`" value="1" name="size`+x+`" />
                    <input type="text" class="form-control hidden" value="value"  name="size_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> starts_with:foo,bar,...
                    <input type="checkbox" class="additional_input" input_name="starts_with_text" num="`+x+`" value="1" name="starts_with`+x+`" />
                    <input type="text" class="form-control hidden" value="foo,bar"  name="starts_with_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> between:min,max
                    <input type="checkbox" class="additional_input" input_name="between_text" num="`+x+`" value="1" name="between`+x+`" />
                    <input type="text" class="form-control hidden" value="min,max"  name="between_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> digits_between:min,max
                    <input type="checkbox" class="additional_input" input_name="digits_between_text" num="`+x+`" value="1" name="digits_between`+x+`" />
                    <input type="text" class="form-control hidden" value="min,max"  name="digits_between_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> different:field
                    <input type="checkbox" class="additional_input" input_name="different_text" num="`+x+`" value="1" name="different`+x+`" />
                    <input type="text" class="form-control hidden" value="field_name_here"  name="different_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> dimensions:min_width=100,min_height=200
                    <input type="checkbox" class="additional_input" input_name="dimensions_text" num="`+x+`" value="1" name="dimensions`+x+`" />
                    <input type="text" class="form-control hidden" value="min_width=100,min_height=200"  name="dimensions_text`+x+`" />
                    <p>(min_width=100,min_height=200 or ratio=3/2)</p>
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> digits:value
                    <input type="checkbox" class="additional_input" input_name="digits_text" num="`+x+`" value="1" name="digits`+x+`" />
                    <input type="text" class="form-control hidden" value="value"  name="digits_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> ends_with:foo,bar,...
                    <input type="checkbox" class="additional_input" input_name="ends_with_text" num="`+x+`" value="1" name="ends_with`+x+`" />
                    <input type="text" class="form-control hidden" value="foo,bar,..."  name="ends_with_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> exclude_if:anotherfield,value
                    <input type="checkbox" class="additional_input" input_name="exclude_if_text" num="`+x+`" value="1" name="exclude_if`+x+`" />
                    <input type="text" class="form-control hidden" value="anotherfield,value"  name="exclude_if_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> exclude_unless:anotherfield,value
                    <input type="checkbox" class="additional_input" input_name="exclude_unless_text" num="`+x+`" value="1" name="exclude_unless`+x+`" />
                    <input type="text" class="form-control hidden" value="anotherfield,value"  name="exclude_unless_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> gt:field
                    <input type="checkbox" class="additional_input"  input_name="gt_text" num="`+x+`" value="1" name="gt`+x+`" />
                    <input type="text" class="form-control hidden" value="`+x+`"  name="gt_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> gte:field
                    <input type="checkbox" class="additional_input" input_name="gte_text" num="`+x+`" value="1" name="gte`+x+`" />
                    <input type="text" class="form-control hidden" value="field"  name="gte_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> lt:field
                    <input type="checkbox" class="additional_input"  input_name="lt_text" num="`+x+`" value="1" name="lt`+x+`" />
                    <input type="text" class="form-control hidden" value="field"  name="lt_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> lte:field
                    <input type="checkbox" class="additional_input" input_name="lte_text" num="`+x+`" value="1" name="lte`+x+`" />
                    <input type="text" class="form-control hidden" value="field"  name="lte_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> max:value
                    <input type="checkbox" class="additional_input" input_name="max_text" num="`+x+`" value="1" name="max`+x+`" />
                    <input type="text" class="form-control hidden" value="`+x+`"  name="max_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> min:value
                    <input type="checkbox" class="additional_input" input_name="min_text" num="`+x+`" value="1" name="min`+x+`" />
                    <input type="text" class="form-control hidden" value="1`+x+`"  name="min_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> multiple_of:value
                    <input type="checkbox" class="additional_input" input_name="multiple_of_text" num="`+x+`" value="1" name="multiple_of`+x+`" />
                    <input type="text" class="form-control hidden" value="value"  name="multiple_of_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> not_in:foo,bar,...
                    <input type="checkbox" class="additional_input" input_name="not_in_text" num="`+x+`" value="1" name="not_in`+x+`" />
                    <input type="text" class="form-control hidden" value="foo,bar"  name="not_in_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> not_regex:pattern
                    <input type="checkbox" class="additional_input" input_name="not_regex_text" num="`+x+`" value="1" name="not_regex`+x+`" />
                    <input type="text" class="form-control hidden" value="/^([0-9\s\-\+\(\)]*)$/"  name="not_regex_text`+x+`" />
                    <p>
                      (Default regex checking for numbers digits)
                    </p>
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> regex:pattern
                    <input type="checkbox" class="additional_input" input_name="regex_text" num="`+x+`" value="1" name="regex`+x+`" />
                    <input type="text" class="form-control hidden" value="/^([0-9\s\-\+\(\)]*)$/"  name="regex_text`+x+`" />
                    <p>
                      <small>(Default regex checking for numbers digits)</small><br>
                      ('email' => 'regex:/^.+@.+$/i'.)
                    </p>
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> mimetypes:text/plain,...
                    <input type="checkbox" class="additional_input" input_name="mimetypes_text" num="`+x+`" value="1" name="mimetypes`+x+`" />
                    <input type="text" class="form-control hidden" value="text/plain"  name="mimetypes_text`+x+`" />
                    <p>
                      (example: 'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime')
                    </p>
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> mimes:foo,bar,...
                    <input type="checkbox" class="additional_input" input_name="mimes_text" num="`+x+`" value="1" name="mimes`+x+`" />
                    <input type="text" class="form-control hidden" value="jpg,bmp,png"  name="mimes_text`+x+`" />
                    <p>
                      (example: 'mimes:jpg,bmp,png')
                    </p>
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> in_array:anotherfield.*
                    <input type="checkbox" class="additional_input" input_name="in_array_text" num="`+x+`" value="1" name="in_array`+x+`" />
                    <input type="text" class="form-control hidden" value="anotherfield.*"  name="in_array_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> prohibited_if:anotherfield,value,...
                    <input type="checkbox" class="additional_input" input_name="prohibited_if_text" num="`+x+`" value="1" name="prohibited_if`+x+`" />
                    <input type="text" class="form-control hidden" value="anotherfield,value"  name="prohibited_if_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> prohibited_unless:anotherfield,value,...
                    <input type="checkbox" class="additional_input" input_name="prohibited_unless_text" num="`+x+`" value="1" name="prohibited_unless`+x+`" />
                    <input type="text" class="form-control hidden" value="anotherfield,value"  name="prohibited_unless_text`+x+`" />
                  </label>
                </div>
                <div class="col-md-6" style="text-align:right;">
                  <label class="form-check-input" dir="ltr"> unique:table,column,except,idColumn
                    <input type="checkbox" class="additional_input" input_name="unique_text" num="`+x+`" value="1" name="unique`+x+`" />
                    <input type="text" class="form-control hidden" value="table,column,except,idColumn"  name="unique_text`+x+`" />
                    <p>
                      (or with Model Like 'email' => 'unique:App\Models\User,email_address') <br>
                      (or like 'email' => 'unique:users,email_address')
                    </p>
                  </label>
                </div>
                <div class="col-md-4">
                  <label class="form-check-input" dir="rtl"> {{it_trans('it.exists_table')}}
                    <select name="exists_table`+x+`" class="form-control exists_table" linkmod="`+x+`">
                      <option value="">without check Exist</option>
                      <optgroup label="App">
                        @foreach(array_filter(glob(app_path().'/*'), 'is_file') as $app_model_file)
<?php
$app_model_file = explode('app', $app_model_file);
$app_model_file = str_replace('.php', '', $app_model_file[1]);
$app_model_file = str_replace('/', '\\\\', $app_model_file);
?>
<option value="App{{ $app_model_file }}">App{{ $app_model_file }}</option>
                        @endforeach
                      </optgroup>
                      @foreach(array_filter(glob(app_path().'/*'), 'is_dir') as $model_list)
<?php
$data_ = explode('/', $model_list);
$explode_last = $data_[count($data_) - 1];
?>
@if(!in_array($explode_last,['Console','Http','Handlers','DataTables','Exceptions','Mail','Providers']))
                      <optgroup label="{{ $explode_last }}">
                        @foreach(array_filter(glob($model_list.'/*'), 'is_file') as $app_model_file)
<?php
$app_model_file = explode('app', $app_model_file);
$app_model_file = str_replace('.php', '', $app_model_file[1]);
$app_model_file = str_replace('/', '\\\\', $app_model_file);
?>
                        <option value="App{{ $app_model_file }}">App{{ $app_model_file }}</option>
                        @endforeach
                      </optgroup>
                      @endif
                      @endforeach
                    </select>
                  </label>
                </div>
                <div class="col-md-8">
                  <label class="form-check-input" dir="rtl"> {{it_trans('it.date')}}
                    <input type="checkbox" value="1" class="date_data" to="`+x+`" name="date`+x+`" />
                  </label>
                  <div class="date_list`+x+` hidden">
                    <div class="col-md-3" >
                      <label class="" dir="rtl"> {{it_trans('it.date_format')}}</label>
                      <select name="date_format`+x+`" class="form-control">
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
                    <div class="col-md-3" >
                      <label class="form-check-input" dir="rtl"> {{it_trans('it.after')}}
                        <input type="radio" value="after" class="after_before" to="`+x+`" name="after_before`+x+`" />
                      </label>
                      -
                      <label class="form-check-input" dir="rtl"> {{it_trans('it.before')}}
                        <input type="radio" value="before" class="after_before" to="`+x+`" name="after_before`+x+`" />
                      </label>
                      <div class="after_before_list`+x+` hidden">
                        <ol>
                          <li>
                            <label class="mt-radio" dir="rtl"> {{it_trans('it.today')}}
                              <input type="radio" value="today" class="before_after_tomorrow" to="`+x+`" name="before_after_tomorrow`+x+`" />
                            </label>
                          </li>
                          <li>
                            <label class="mt-radio" dir="rtl"> {{it_trans('it.tomorrow')}}
                              <input type="radio" value="tomorrow"  class="before_after_tomorrow" to="`+x+`" name="before_after_tomorrow`+x+`" />
                            </label>
                          </li>
                          <li>
                            <label class="mt-radio" dir="rtl"> {{it_trans('it.other_col')}}
                              <input type="radio" value="other_col"  class="before_after_tomorrow" to="`+x+`" name="before_after_tomorrow`+x+`" />
                            </label>
                          </li>
                          <li>
                            <label class="mt-radio" dir="rtl"> {{it_trans('it.other_carbon')}}
                              <input type="radio" value="other_carbon" class="before_after_tomorrow" to="`+x+`" name="before_after_tomorrow`+x+`" />
                            </label>
                          </li>
                        </ol>
                      </div>
                    </div>
                    <div class="col-md-3 each_other_col`+x+` hidden">
                      Select The Column
                      <span class="each_col_name_other_col`+x+`"></span>
                    </div>
                    <div class="col-md-3 each_other_carbon`+x+` hidden">
                      Write Carbon Days
                      <label>
                        Days <input type="text" name="other_carbon`+x+`" placeholder="Days" class="form-control" >
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Advanced Rules -->
            </div>
          </div>
        </div>
      </div>
      <!--- End Card Rules  -->
      <div class="clearfix"></div>
      <br />
    </div>
    <div class="col-md-12 well">
      <h4>Schema Relation</h4>
      <div class="form-group">
        <label class="form-check-input" dir="rtl"> {{it_trans('it.forginkeyto')}}      </label>
        <input type="checkbox" value="1" name="forginkeyto`+x+`" class="forginkeyto" to="`+x+`" value="1" />
      </div>
      <div class="forginkeyto`+x+` hidden">
        <div class="form-group col-md-4">
          <label class="form-check-input" dir="rtl"> {{it_trans('it.references')}}
            <input type="text" name="references`+x+`" placeholder="{{it_trans('it.references')}}" class="form-control references" to="`+x+`" />
          </div>
          <div class="form-group col-md-4">
            <label class="form-check-input" dir="rtl"> {{it_trans('it.forgin_table_name')}}
              <input type="text" name="forgin_table_name`+x+`" placeholder="{{it_trans('it.forgin_table_name')}}" class="form-control forgin_table_name"  to="`+x+`" />
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-check-input" dir="rtl"> {{it_trans('it.nullable')}}
                  <input type="checkbox" name="schema_nullable`+x+`"  value="1"  class="func_nullable" to="`+x+`" />
                </div>
                <div class="form-group">
                  <label class="form-check-input" dir="rtl"> {{it_trans('it.onDelete')}}
                    <input type="checkbox" name="schema_onDelete`+x+`"  value="1"   class="onDelete" to="`+x+`" />
                  </div>
                  <div class="form-group">
                    <label class="form-check-input" dir="rtl"> {{it_trans('it.onUpdate')}}
                      <input type="checkbox" name="schema_onUpdate`+x+`"  value="1"   class="onUpdate" to="`+x+`" />
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <p>$table->foreignId('<span class="col_name_`+x+`"></span>')->constrained('<span class="forgin_table_name`+x+`"></span>')->references('<span class="references`+x+`"></span>')<span  class="schema_onDelete`+x+` hidden">->onDelete('cascade')</span><span  class="schema_onUpdate`+x+` hidden">->onUpdate('cascade')</span><span class="func_nullable`+x+` hidden">->nullable()</span>;</p>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <a href="#" class="remove_field btn btn-danger pull-right"><i class="fa fa-trash"></i></a>
          </div>
          `