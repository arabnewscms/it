<div class="input_fields_wrap">
  @php
  $x = 0;
  @endphp
  @foreach($module_data->inputs_columns as $input)
  @php
  $rules = $input->rules;
  @endphp
  <div class="col-md-12 well">
    <div class="col-md-3">
      <div class="form-group">
        <label for="col_name" class="col-md-12">{{it_trans('it.col_name')}}</label>
        <div class="col-md-12">
          <input type="text" name="col_name[]" value="{{$input->col_name}}" class="form-control col_name" placeholder="{{it_trans('it.col_name')}}"  />
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group" style="margin-top: -16px;">
        <label for="col_type" class="col-md-12">{{it_trans('it.col_type')}}</label>
        <div class="col-md-12">
          <select name="col_type[]" class="form-control">
            <option {{ $input->col_type == 'text'?'selected':'' }} value="text">{{it_trans('it.text')}}</option>
            <option {{ $input->col_type == 'number'?'selected':'' }} value="number">{{it_trans('it.number')}}</option>
            <option {{ $input->col_type == 'email'?'selected':'' }} value="email">{{it_trans('it.email')}}</option>
            <option {{ $input->col_type == 'url'?'selected':'' }} value="url">{{it_trans('it.url')}}</option>
            <option {{ $input->col_type == 'textarea'?'selected':'' }} value="textarea">{{it_trans('it.textarea')}}</option>
            <option {{ $input->col_type == 'textarea_ckeditor'?'selected':'' }} value="textarea_ckeditor">{{it_trans('it.textarea_ckeditor')}}</option>
            <option {{ $input->col_type == 'select'?'selected':'' }} value="select">{{it_trans('it.select')}}</option>
            <option {{ $input->col_type == 'file'?'selected':'' }} value="file">{{it_trans('it.file')}}</option>
            <option {{ $input->col_type == 'dropzone'?'selected':'' }} value="dropzone">{{it_trans('it.dropzone')}}</option>
            <option {{ $input->col_type == 'password'?'selected':'' }} value="password">{{it_trans('it.password')}}</option>
            <option {{ $input->col_type == 'checkbox'?'selected':'' }} value="checkbox">{{it_trans('it.checkbox')}}</option>
            <option {{ $input->col_type == 'radio'?'selected':'' }} value="radio">{{it_trans('it.radio')}}</option>
            <option {{ $input->col_type == 'date'?'selected':'' }} value="date">{{it_trans('it.date')}}</option>
            <option {{ $input->col_type == 'date_time'?'selected':'' }} value="date_time">{{it_trans('it.date_time')}}</option>
            <option {{ $input->col_type == 'time'?'selected':'' }} value="time">{{it_trans('it.time')}}</option>
            <option {{ $input->col_type == 'timestamp'?'selected':'' }} value="timestamp">{{it_trans('it.timestamp')}}</option>
            <option {{ $input->col_type == 'color'?'selected':'' }} value="color">{{it_trans('it.color')}}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="col_width" class="col-md-12">{{it_trans('it.col_width')}}</label>
          <div class="col-md-3">
            <p>col-lg-{{ $input->col_width_lg }}</p>
            <select name="col_width_lg[]" class="form-control">
              <option {{ $input->col_width_lg == 1?'selected':'' }} value="1">1</option>
              <option {{ $input->col_width_lg == 2?'selected':'' }} value="2">2</option>
              <option {{ $input->col_width_lg == 3?'selected':'' }} value="3">3</option>
              <option {{ $input->col_width_lg == 4?'selected':'' }} value="4">4</option>
              <option {{ $input->col_width_lg == 5?'selected':'' }} value="5">5</option>
              <option {{ $input->col_width_lg == 6?'selected':'' }} value="6" selected>6</option>
              <option {{ $input->col_width_lg == 7?'selected':'' }} value="7">7</option>
              <option {{ $input->col_width_lg == 8?'selected':'' }} value="8">8</option>
              <option {{ $input->col_width_lg == 9?'selected':'' }} value="9">9</option>
              <option {{ $input->col_width_lg == 10?'selected':'' }} value="10">10</option>
              <option {{ $input->col_width_lg == 11?'selected':'' }} value="11">11</option>
              <option {{ $input->col_width_lg == 12?'selected':'' }} value="12">12</option>
            </select>
          </div>
          <div class="col-md-3">
            <p>col-md-{{ $input->col_width_md }}</p>
            <select name="col_width_md[]" class="form-control">
              <option {{ $input->col_width_md == 1?'selected':'' }} value="1">1</option>
              <option {{ $input->col_width_md == 2?'selected':'' }} value="2">2</option>
              <option {{ $input->col_width_md == 3?'selected':'' }} value="3">3</option>
              <option {{ $input->col_width_md == 4?'selected':'' }} value="4">4</option>
              <option {{ $input->col_width_md == 5?'selected':'' }} value="5">5</option>
              <option {{ $input->col_width_md == 6?'selected':'' }} value="6" selected>6</option>
              <option {{ $input->col_width_md == 7?'selected':'' }} value="7">7</option>
              <option {{ $input->col_width_md == 8?'selected':'' }} value="8">8</option>
              <option {{ $input->col_width_md == 9?'selected':'' }} value="9">9</option>
              <option {{ $input->col_width_md == 10?'selected':'' }} value="10">10</option>
              <option {{ $input->col_width_md == 11?'selected':'' }} value="11">11</option>
              <option {{ $input->col_width_md == 12?'selected':'' }} value="12">12</option>
            </select>
          </div>
          <div class="col-md-3">
            <p>col-sm-{{ $input->col_width_sm }}</p>
            <select name="col_width_sm[]" class="form-control">
              <option {{ $input->col_width_sm == 1?'selected':'' }} value="1">1</option>
              <option {{ $input->col_width_sm == 2?'selected':'' }} value="2">2</option>
              <option {{ $input->col_width_sm == 3?'selected':'' }} value="3">3</option>
              <option {{ $input->col_width_sm == 4?'selected':'' }} value="4">4</option>
              <option {{ $input->col_width_sm == 5?'selected':'' }} value="5">5</option>
              <option {{ $input->col_width_sm == 6?'selected':'' }} value="6" selected>6</option>
              <option {{ $input->col_width_sm == 7?'selected':'' }} value="7">7</option>
              <option {{ $input->col_width_sm == 8?'selected':'' }} value="8">8</option>
              <option {{ $input->col_width_sm == 9?'selected':'' }} value="9">9</option>
              <option {{ $input->col_width_sm == 10?'selected':'' }} value="10">10</option>
              <option {{ $input->col_width_sm == 11?'selected':'' }} value="11">11</option>
              <option {{ $input->col_width_sm == 12?'selected':'' }} value="12">12</option>
            </select>
          </div>
          <div class="col-md-3">
            <p>col-xs-{{ $input->col_width_xs }}</p>
            <select name="col_width_xs[]" class="form-control">
              <option {{ $input->col_width_xs == 1?'selected':'' }} value="1">1</option>
              <option {{ $input->col_width_xs == 2?'selected':'' }} value="2">2</option>
              <option {{ $input->col_width_xs == 3?'selected':'' }} value="3">3</option>
              <option {{ $input->col_width_xs == 4?'selected':'' }} value="4">4</option>
              <option {{ $input->col_width_xs == 5?'selected':'' }} value="5">5</option>
              <option {{ $input->col_width_xs == 6?'selected':'' }} value="6">6</option>
              <option {{ $input->col_width_xs == 7?'selected':'' }} value="7">7</option>
              <option {{ $input->col_width_xs == 8?'selected':'' }} value="8">8</option>
              <option {{ $input->col_width_xs == 9?'selected':'' }} value="9">9</option>
              <option {{ $input->col_width_xs == 10?'selected':'' }} value="10">10</option>
              <option {{ $input->col_width_xs == 11?'selected':'' }} value="11">11</option>
              <option {{ $input->col_width_xs == 12?'selected':'' }} value="12" selected>12</option>
            </select>
          </div>
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
          <input type="text" name="col_name_convention[]"  to="{{ $x }}" value="{{$input->col_name_convention}}" class="form-control col_name_convention" placeholder="{{it_trans('it.col_name_convention')}}"  />
          <div class="clearfix"></div>
          <hr />
          <div class="col-md-4">
            <label>
              {{ it_trans('it.connect_ajax') }}
              <input type="checkbox" class="link_ajax"  {{ isset($input->link_ajax->{'link_ajax'.$x})?'checked':'' }} to="{{ $x }}" name="link_ajax{{ $x }}" value="yes">
            </label>
          </div>
          <div class="col-md-8 each_ajax_cols{{ $x }}">
            @if(isset($input->link_ajax->{'link_ajax'.$x}))
            <select name="select_ajax_link{{ $x }}" class="form-control">
              @foreach($module_data->inputs_columns as $input_ajax)
              <option value="{{ $input_ajax->col_name_convention }}"
                {{ $input->link_ajax->{'link_ajax'.$x} == $input_ajax->col_name_convention?'selected':'' }}
              >{{ $input_ajax->col_name_convention }}</option>
              @endforeach
            </select>
            @endif
          </div>

        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <hr />
    <div class="col-md-12 alert alert-info validation">
      <div class="col-md-12">
        <label class="mt-radio">
          <input type="radio" name="col_name_null{{ $x }}" class="col_name_null" list="{{ $x }}" id="col_name_null" value="null" {{ $input->{'col_name_null'.$x} !='has'?'checked':'' }}>
          {{it_trans('it.col_name_null')}}
          <span></span>
        </label>
        -
        <label class="mt-radio">
          <input type="radio" name="col_name_null{{ $x }}" class="col_name_null" list="{{ $x }}" id="col_name_null" {{ $input->{'col_name_null'.$x} =='has'?'checked':'' }}  value="has">
          {{it_trans('it.not_null')}}
          <span></span>
        </label>
      </div>
      <div class="clearfix"></div>
      <hr />
      <div class="col-md-12 list_validation{{ $x }} {{ $input->{'col_name_null'.$x} !='has'?'hidden':'' }}">
        <!--- Start Card Rules  -->
@php
$col_name_convention_ex = explode('|', $input->col_name_convention);
$col_name_convention = !empty($col_name_convention_ex) && count($col_name_convention_ex) > 0 ?$col_name_convention_ex[0]:$input->col_name_convention;
@endphp
        <div id="rulesCard{{ $x }}">
          <div class="card">
            <div class="card-header">
              <a class="card-link" data-toggle="collapse" data-parent="#rulesCard{{ $x }}" href="#basic_rules{{ $x }}">Basic Rules (<span class="col_name_{{ $x }}">{{ $col_name_convention }}</span>)</a>
            </div>
            <div id="basic_rules{{ $x }}" class="collapse">
              <div class="card-body">
                <!-- Start basic Rules -->
                <div class="col-md-12">
                  <div class="col-md-2">
                    <label class="form-check-input" dir="rtl">
                      email
                      <input type="checkbox" value="1" {{ $rules->{'email'.$x} }} name="email{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl">
                      {{it_trans('it.url')}}
                      <input type="checkbox" value="1" {{ $rules->{'url'.$x} }} name="url{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> {{it_trans('it.required')}}
                      <input type="checkbox" value="1" {{ $rules->{'required'.$x} }}  name="required{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> {{it_trans('it.string')}}
                      <input type="checkbox" value="1" {{ $rules->{'string'.$x} }} name="string{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> integer
                      <input type="checkbox" value="1" {{ $rules->{'integer'.$x} }} name="integer{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> {{it_trans('it.numeric')}}
                      <input type="checkbox" value="1" {{ $rules->{'numeric'.$x} }}  name="numeric{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> {{it_trans('it.sometimes')}}
                      <input type="checkbox" value="1" {{ $rules->{'sometimes'.$x} }}   name="sometimes{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> {{it_trans('it.nullable')}}
                      <input type="checkbox" value="1" {{ $rules->{'nullable'.$x} }} name="nullable{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> {{it_trans('it.confirmed')}}
                      <input type="checkbox" value="1" {{ $rules->{'confirmed'.$x} }}  name="confirmed{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> filled
                      <input type="checkbox" value="1"  {{ $rules->{'filled'.$x} }} name="filled{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> alpha
                      <input type="checkbox" value="1"  {{ $rules->{'alpha'.$x} }} name="alpha{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> {{it_trans('it.alpha-dash')}}
                      <input type="checkbox" value="1" {{ $rules->{'alpha-dash'.$x} }} name="alpha-dash{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> alpha_num
                      <input type="checkbox" value="1" {{ $rules->{'alpha_num'.$x} }} name="alpha_num{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> active_url
                      <input type="checkbox" value="1" {{ $rules->{'active_url'.$x} }}  name="active_url{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> accepted
                      <input type="checkbox" value="1"  {{ $rules->{'accepted'.$x} }} name="accepted{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> boolean
                      <input type="checkbox" value="1" {{ $rules->{'boolean'.$x} }} name="boolean{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> uuid
                      <input type="checkbox" value="1" {{ $rules->{'uuid'.$x} }}  name="uuid{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> bail
                      <input type="checkbox" value="1" {{ $rules->{'bail'.$x} }}  name="bail{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> present
                      <input type="checkbox" value="1" {{ $rules->{'present'.$x} }}    name="present{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> timezone
                      <input type="checkbox" value="1" {{ $rules->{'timezone'.$x} }} name="timezone{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> json
                      <input type="checkbox" value="1" {{ $rules->{'json'.$x} }}   name="json{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> array
                      <input type="checkbox" value="1" {{ $rules->{'array'.$x} }}   name="array{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> ip
                      <input type="checkbox" value="1" {{ $rules->{'ip'.$x} }}   name="ip{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> ipv4
                      <input type="checkbox" value="1" {{ $rules->{'ipv4'.$x} }}  name="ipv4{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> ipv6
                      <input type="checkbox" value="1" {{ $rules->{'ipv6'.$x} }}   name="ipv6{{ $x }}" />
                    </label>
                  </div>
                  <div class="clearfix"></div>
                  <hr />
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> file
                      <input type="checkbox" value="1" {{ $rules->{'file'.$x} }}  name="file{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> {{it_trans('it.image')}}
                      <input type="checkbox" value="1" {{ $rules->{'image'.$x} }} name="image{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> pdf
                      <input type="checkbox" value="1" {{ $rules->{'pdf'.$x} }} name="pdf{{ $x }}" />
                    </label>
                  </div>
                  <div class="clearfix"></div>
                  <hr />
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> office
                      <input type="checkbox" value="1" {{ !empty($rules->{'office'.$x})? $rules->{'office'.$x}:'' }} name="office{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> docx
                      <input type="checkbox" value="1" {{ !empty($rules->{'docx'.$x})? $rules->{'docx'.$x}:'' }} name="docx{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> xlsx
                      <input type="checkbox" value="1" {{ !empty($rules->{'xlsx'.$x})? $rules->{'xlsx'.$x}:'' }} name="xlsx{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> xls
                      <input type="checkbox" value="1" {{ !empty($rules->{'xls'.$x})? $rules->{'xls'.$x}:'' }} name="xls{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> xltx
                      <input type="checkbox" value="1" {{ !empty($rules->{'xltx'.$x})? $rules->{'xltx'.$x}:'' }} name="xltx{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> ppt
                      <input type="checkbox" value="1" {{ !empty($rules->{'ppt'.$x})? $rules->{'ppt'.$x}:'' }} name="ppt{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> ppam
                      <input type="checkbox" value="1" {{ !empty($rules->{'ppam'.$x})? $rules->{'ppam'.$x}:'' }} name="ppam{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> pptm
                      <input type="checkbox" value="1" {{ !empty($rules->{'pptm'.$x})? $rules->{'pptm'.$x}:'' }} name="pptm{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> ppsm
                      <input type="checkbox" value="1" {{ !empty($rules->{'ppsm'.$x})? $rules->{'ppsm'.$x}:'' }} name="ppsm{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> potm
                      <input type="checkbox" value="1" {{ !empty($rules->{'potm'.$x})? $rules->{'potm'.$x}:'' }} name="potm{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> sldm
                      <input type="checkbox" value="1" {{ !empty($rules->{'sldm'.$x})? $rules->{'sldm'.$x}:'' }} name="sldm{{ $x }}" />
                    </label>
                  </div>
                  <div class="clearfix"></div>
                  <hr />
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> audio
                      <input type="checkbox" value="1" {{ !empty($rules->{'audio'.$x})? $rules->{'audio'.$x}:'' }} name="audio{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> mp3
                      <input type="checkbox" value="1" {{ $rules->{'mp3'.$x} }} name="mp3{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> wav
                      <input type="checkbox" value="1" {{ !empty($rules->{'wav'.$x})?$rules->{'wav'.$x}:'' }} name="wav{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> xm
                      <input type="checkbox" value="1" {{ !empty($rules->{'xm'.$x})? $rules->{'xm'.$x}:'' }} name="xm{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> ogg
                      <input type="checkbox" value="1" {{ !empty($rules->{'ogg'.$x})? $rules->{'ogg'.$x}:'' }} name="ogg{{ $x }}" />
                    </label>
                  </div>
                  <div class="clearfix"></div>
                  <hr />
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> video
                      <input type="checkbox" value="1" {{ $rules->{'video'.$x} }} name="video{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> mp4
                      <input type="checkbox" value="1" {{ $rules->{'mp4'.$x} }} name="mp4{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> mpeg
                      <input type="checkbox" value="1" {{ $rules->{'mpeg'.$x} }} name="mpeg{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> mov
                      <input type="checkbox" value="1" {{ $rules->{'mov'.$x} }} name="mov{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> 3gp
                      <input type="checkbox" value="1" {{ $rules->{'3gp'.$x} }} name="3gp{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> webm
                      <input type="checkbox" value="1" {{ $rules->{'webm'.$x} }} name="webm{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> mkv
                      <input type="checkbox" value="1" {{ $rules->{'mkv'.$x} }} name="mkv{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> wmv
                      <input type="checkbox" value="1" {{ $rules->{'wmv'.$x} }} name="wmv{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> avi
                      <input type="checkbox" value="1" {{ $rules->{'avi'.$x} }} name="avi{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-2" >
                    <label class="form-check-input" dir="rtl"> vob
                      <input type="checkbox" value="1" {{ $rules->{'vob'.$x} }} name="vob{{ $x }}" />
                    </label>
                  </div>
                </div>
                <!-- End basic Rules -->
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <a class="collapsed card-link" data-toggle="collapse" data-parent="#rulesCard{{ $x }}" href="#advanced_rules{{ $x }}">Advanced Rules (<span class="col_name_{{ $x }}">{{ $col_name_convention }}</span>)</a>
            </div>
            <div id="advanced_rules{{ $x }}" class="collapse">
              <div class="card-body">
                <!-- Start Advanced Rules -->
                <div class="col-md-12">
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> required_if
                      <input type="checkbox" class="additional_input" input_name="required_if_text" num="{{ $x }}" value="1" {{ !empty($rules->{'required_if'.$x})?'checked':'' }} name="required_if{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'required_if'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'required_if'.$x}))
                      @if(!empty($rules->{'required_if'.$x}[1]))
                      value="{{ $rules->{'required_if'.$x}[1] }}"
                      @endif
                      @else
                      value="request_name,=,value"
                      @endif
                      name="required_if_text{{ $x }}" />
                      <p>(example: required_if:payment_type,cc or request_name,=,value or request_name,>,value or request_name,<,value or request_name,!=,value)</p>
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> required_unless:anotherfield,value,...
                      <input type="checkbox" class="additional_input" input_name="required_unless_text" num="{{ $x }}" value="1" name="required_unless{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'required_unless'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'required_unless'.$x}))
                      @if(!empty($rules->{'required_unless'.$x}[1]))
                      value="{{ $rules->{'required_unless'.$x}[1] }}"
                      @endif
                      @else
                      value="anotherfield,value"
                      @endif
                      name="required_unless_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> required_with:foo,bar,...
                      <input type="checkbox" class="additional_input" input_name="required_with_text" num="{{ $x }}" value="1" name="required_with{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'required_with'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'required_with'.$x}))
                      @if(!empty($rules->{'required_with'.$x}[1]))
                      value="{{ $rules->{'required_with'.$x}[1] }}"
                      @endif
                      @else
                      value="foo,bar"
                      @endif
                      name="required_with_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> required_with_all:foo,bar,...
                      <input type="checkbox" class="additional_input" input_name="required_with_all_text" num="{{ $x }}" value="1" name="required_with_all{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'required_with_all'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'required_with_all'.$x}))
                      @if(!empty($rules->{'required_with_all'.$x}[1]))
                      value="{{ $rules->{'required_with_all'.$x}[1] }}"
                      @endif
                      @else
                      value="foo,bar"
                      @endif
                      name="required_with_all_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> required_without:foo,bar,...
                      <input type="checkbox" class="additional_input" input_name="required_without_text" num="{{ $x }}" value="1" name="required_without{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'required_without'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'required_without'.$x}))
                      @if(!empty($rules->{'required_without'.$x}[1]))
                      value="{{ $rules->{'required_without'.$x}[1] }}"
                      @endif
                      @else
                      value="foo,bar"
                      @endif
                      name="required_without_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> required_without_all:foo,bar,...
                      <input type="checkbox" class="additional_input" input_name="required_without_all_text" num="{{ $x }}" value="1" name="required_without_all{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'required_without_all'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'required_without_all'.$x}))
                      @if(!empty($rules->{'required_without_all'.$x}[1]))
                      value="{{ $rules->{'required_without_all'.$x}[1] }}"
                      @endif
                      @else
                      value="foo,bar"
                      @endif
                      name="required_without_all_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> same:field
                      <input type="checkbox" class="additional_input" input_name="same_text" num="{{ $x }}" value="1" name="same{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'same'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'same'.$x}))
                      @if(!empty($rules->{'same'.$x}[1]))
                      value="{{ $rules->{'same'.$x}[1] }}"
                      @endif
                      @else
                      value="field"
                      @endif
                      name="same_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> size:value
                      <input type="checkbox" class="additional_input" input_name="size_text" num="{{ $x }}" value="1" name="size{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'size'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'size'.$x}))
                      @if(!empty($rules->{'size'.$x}[1]))
                      value="{{ $rules->{'size'.$x}[1] }}"
                      @endif
                      @else
                      value="value"
                      @endif
                      name="size_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> starts_with:foo,bar,...
                      <input type="checkbox" class="additional_input" input_name="starts_with_text" num="{{ $x }}" value="1" name="starts_with{{ $x }}" />
                      <input type="text" class="form-control  {{ empty($rules->{'starts_with'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'starts_with'.$x}))
                      @if(!empty($rules->{'starts_with'.$x}[1]))
                      value="{{ $rules->{'starts_with'.$x}[1] }}"
                      @endif
                      @else
                      value="foo,bar"
                      @endif
                      name="starts_with_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> between:min,max
                      <input type="checkbox" class="additional_input" input_name="between_text" num="{{ $x }}" value="1" name="between{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'between'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'between'.$x}))
                      @if(!empty($rules->{'between'.$x}[1]))
                      value="{{ $rules->{'between'.$x}[1] }}"
                      @endif
                      @else
                      value="min,max"
                      @endif
                      name="between_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> digits_between:min,max
                      <input type="checkbox" class="additional_input" input_name="digits_between_text" num="{{ $x }}" value="1" name="digits_between{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'digits_between'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'digits_between'.$x}))
                      @if(!empty($rules->{'digits_between'.$x}[1]))
                      value="{{ $rules->{'digits_between'.$x}[1] }}"
                      @endif
                      @else
                      value="min,max"
                      @endif
                      name="digits_between_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> different:field
                      <input type="checkbox" class="additional_input" input_name="different_text" num="{{ $x }}" value="1" name="different{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'different'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'different'.$x}))
                      @if(!empty($rules->{'different'.$x}[1]))
                      value="{{ $rules->{'different'.$x}[1] }}"
                      @endif
                      @else
                      value="field_name_here"
                      @endif
                      name="different_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> dimensions:min_width=100,min_height=200
                      <input type="checkbox" class="additional_input" input_name="dimensions_text" num="{{ $x }}" value="1" name="dimensions{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'dimensions'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'different'.$x}))
                      @if(!empty($rules->{'different'.$x}[1]))
                      value="{{ $rules->{'different'.$x}[1] }}"
                      @endif
                      @else
                      value="min_width=100,min_height=200"
                      @endif
                      name="dimensions_text{{ $x }}" />
                      <p>(min_width=100,min_height=200 or ratio=3/2)</p>
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> digits:value
                      <input type="checkbox" class="additional_input" input_name="digits_text" num="{{ $x }}" value="1" name="digits{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'digits'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'digits'.$x}))
                      @if(!empty($rules->{'digits'.$x}[1]))
                      value="{{ $rules->{'digits'.$x}[1] }}"
                      @endif
                      @else
                      value="value"
                      @endif
                      name="digits_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> ends_with:foo,bar,...
                      <input type="checkbox" class="additional_input" input_name="ends_with_text" num="{{ $x }}" value="1" name="ends_with{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'ends_with'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'ends_with'.$x}))
                      @if(!empty($rules->{'ends_with'.$x}[1]))
                      value="{{ $rules->{'ends_with'.$x}[1] }}"
                      @endif
                      @else
                      value="foo,bar,..."
                      @endif
                      name="ends_with_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> exclude_if:anotherfield,value
                      <input type="checkbox" class="additional_input" input_name="exclude_if_text" num="{{ $x }}" value="1" name="exclude_if{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'exclude_if'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'exclude_if'.$x}))
                      @if(!empty($rules->{'exclude_if'.$x}[1]))
                      value="{{ $rules->{'exclude_if'.$x}[1] }}"
                      @endif
                      @else
                      value="anotherfield,value"
                      @endif
                      name="exclude_if_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> exclude_unless:anotherfield,value
                      <input type="checkbox" class="additional_input" input_name="exclude_unless_text" num="{{ $x }}" value="1" name="exclude_unless{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'exclude_unless'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'exclude_unless'.$x}))
                      @if(!empty($rules->{'exclude_unless'.$x}[1]))
                      value="{{ $rules->{'exclude_unless'.$x}[1] }}"
                      @endif
                      @else
                      value="anotherfield,value"
                      @endif
                      name="exclude_unless_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> gt:field
                      <input type="checkbox" class="additional_input"  input_name="gt_text" num="{{ $x }}" value="1" name="gt{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'gt'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'gt'.$x}))
                      @if(!empty($rules->{'gt'.$x}[1]))
                      value="{{ $rules->{'gt'.$x}[1] }}"
                      @endif
                      @else
                      value="field"
                      @endif
                      name="gt_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> gte:field
                      <input type="checkbox" class="additional_input" input_name="gte_text" num="{{ $x }}" value="1" name="gte{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'gte'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'gte'.$x}))
                      @if(!empty($rules->{'gte'.$x}[1]))
                      value="{{ $rules->{'gte'.$x}[1] }}"
                      @endif
                      @else
                      value="field"
                      @endif
                      name="gte_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> lt:field
                      <input type="checkbox" class="additional_input"  input_name="lt_text" num="{{ $x }}" value="1" name="lt{{ $x }}" />
                      <input type="text" class="form-control  {{ empty($rules->{'lt'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'lt'.$x}))
                      @if(!empty($rules->{'lt'.$x}[1]))
                      value="{{ $rules->{'lt'.$x}[1] }}"
                      @endif
                      @else
                      value="field"
                      @endif
                      name="lt_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> lte:field
                      <input type="checkbox" class="additional_input" input_name="lte_text" num="{{ $x }}" value="1" name="lte{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'lte'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'lte'.$x}))
                      @if(!empty($rules->{'lte'.$x}[1]))
                      value="{{ $rules->{'lte'.$x}[1] }}"
                      @endif
                      @else
                      value="field"
                      @endif
                      name="lte_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> max:value
                      <input type="checkbox" class="additional_input" input_name="max_text" num="{{ $x }}" value="1" name="max{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'max'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'max'.$x}))
                      @if(!empty($rules->{'max'.$x}[1]))
                      value="{{ $rules->{'max'.$x}[1] }}"
                      @endif
                      @else
                      value="value"
                      @endif
                      name="max_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> min:value
                      <input type="checkbox" class="additional_input" input_name="min_text" num="{{ $x }}" value="1" name="min{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'min'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'min'.$x}))
                      @if(!empty($rules->{'min'.$x}[1]))
                      value="{{ $rules->{'min'.$x}[1] }}"
                      @endif
                      @else
                      value="value"
                      @endif
                      name="min_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> multiple_of:value
                      <input type="checkbox" class="additional_input" input_name="multiple_of_text" num="{{ $x }}" value="1" name="multiple_of{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'multiple_of'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'multiple_of'.$x}))
                      @if(!empty($rules->{'multiple_of'.$x}[1]))
                      value="{{ $rules->{'multiple_of'.$x}[1] }}"
                      @endif
                      @else
                      value="value"
                      @endif
                      name="multiple_of_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> not_in:foo,bar,...
                      <input type="checkbox" class="additional_input" input_name="not_in_text" num="{{ $x }}" value="1" name="not_in{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'not_in'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'not_in'.$x}))
                      @if(!empty($rules->{'not_in'.$x}[1]))
                      value="{{ $rules->{'not_in'.$x}[1] }}"
                      @endif
                      @else
                      value="foo,bar"
                      @endif
                      name="not_in_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> not_regex:pattern
                      <input type="checkbox" class="additional_input" input_name="not_regex_text" num="{{ $x }}" value="1" name="not_regex{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'not_regex'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'not_regex'.$x}))
                      @if(!empty($rules->{'not_regex'.$x}[1]))
                      value="{{ $rules->{'not_regex'.$x}[1] }}"
                      @endif
                      @else
                      value="/^([0-9\s\-\+\(\)]*)$/"
                      @endif
                      name="not_regex_text{{ $x }}" />
                      <p>
                        (Default regex checking for numbers digits)
                      </p>
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> regex:pattern
                      <input type="checkbox" class="additional_input" input_name="regex_text" num="{{ $x }}" value="1" name="regex{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'regex'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'regex'.$x}))
                      @if(!empty($rules->{'regex'.$x}[1]))
                      value="{{ $rules->{'regex'.$x}[1] }}"
                      @endif
                      @else
                      value="/^([0-9\s\-\+\(\)]*)$/"
                      @endif
                      name="regex_text{{ $x }}" />
                      <p>
                        <small>(Default regex checking for numbers digits)</small><br>
                        ('email' => 'regex:/^.+@.+$/i'.)
                      </p>
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> mimetypes:text/plain,...
                      <input type="checkbox" class="additional_input" input_name="mimetypes_text" num="{{ $x }}" value="1" name="mimetypes{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'mimetypes'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'mimetypes'.$x}))
                      @if(!empty($rules->{'mimetypes'.$x}[1]))
                      value="{{ $rules->{'mimetypes'.$x}[1] }}"
                      @endif
                      @else
                      value="text/plain"
                      @endif
                      name="mimetypes_text{{ $x }}" />
                      <p>
                        (example: 'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime')
                      </p>
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> mimes:foo,bar,...
                      <input type="checkbox" class="additional_input" input_name="mimes_text" num="{{ $x }}" value="1" name="mimes{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'mimes'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'mimes'.$x}))
                      @if(!empty($rules->{'mimes'.$x}[1]))
                      value="{{ $rules->{'mimes'.$x}[1] }}"
                      @endif
                      @else
                      value="jpg,bmp,png"
                      @endif
                      name="mimes_text{{ $x }}" />
                      <p>
                        (example: 'mimes:jpg,bmp,png')
                      </p>
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> in_array:anotherfield.*
                      <input type="checkbox" class="additional_input" input_name="in_array_text" num="{{ $x }}" value="1" name="in_array{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'in_array'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'in_array'.$x}))
                      @if(!empty($rules->{'in_array'.$x}[1]))
                      value="{{ $rules->{'in_array'.$x}[1] }}"
                      @endif
                      @else
                      value="anotherfield.*"
                      @endif
                      name="in_array_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> prohibited_if:anotherfield,value,...
                      <input type="checkbox" class="additional_input" input_name="prohibited_if_text" num="{{ $x }}" value="1" name="prohibited_if{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'prohibited_if'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'prohibited_if'.$x}))
                      @if(!empty($rules->{'prohibited_if'.$x}[1]))
                      value="{{ $rules->{'prohibited_if'.$x}[1] }}"
                      @endif
                      @else
                      value="anotherfield,value"
                      @endif
                      name="prohibited_if_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> prohibited_unless:anotherfield,value,...
                      <input type="checkbox" class="additional_input" input_name="prohibited_unless_text" num="{{ $x }}" value="1" name="prohibited_unless{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'prohibited_unless'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'prohibited_unless'.$x}))
                      @if(!empty($rules->{'prohibited_unless'.$x}[1]))
                      value="{{ $rules->{'prohibited_unless'.$x}[1] }}"
                      @endif
                      @else
                      value="anotherfield,value"
                      @endif
                      name="prohibited_unless_text{{ $x }}" />
                    </label>
                  </div>
                  <div class="col-md-6" style="text-align:right;">
                    <label class="form-check-input" dir="ltr"> unique:table,column,except,idColumn
                      <input type="checkbox" class="additional_input" input_name="unique_text" num="{{ $x }}" value="1" name="unique{{ $x }}" />
                      <input type="text" class="form-control {{ empty($rules->{'unique'.$x})?'hidden':'' }}"
                      @if(!empty($rules->{'unique'.$x}))
                      @if(!empty($rules->{'unique'.$x}[1]))
                      value="{{ $rules->{'unique'.$x}[1] }}"
                      @endif
                      @else
                      value="table,column,except,idColumn"
                      @endif
                      name="unique_text{{ $x }}" />
                      <p>
                        (or with Model Like 'email' => 'unique:App\Models\User,email_address') <br>
                        (or like 'email' => 'unique:users,email_address')
                      </p>
                    </label>
                  </div>
                  <div class="col-md-4">
                    <label class="form-check-input" dir="rtl"> {{it_trans('it.exists_table')}}
                      <select name="exists_table{{ $x }}" class="form-control exists_table" linkmod="{{ $x }}">
                        <option value="">without check Exist</option>
                        <optgroup label="App">
                          @foreach(array_filter(glob(app_path().'/*'), 'is_file') as $app_model_file)
                          <?php
$app_model_file = explode('app', $app_model_file);
$app_model_file = str_replace('.php', '', $app_model_file[1]);
$app_model_file = str_replace('/', '\\', $app_model_file);
?>
                          <option value="App{{ $app_model_file }}"
                            {{ !empty($rules->{'exists_table'.$x}) && $rules->{'exists_table'.$x}[1] == 'App'.$app_model_file?'selected':'' }}
                          >App{{ $app_model_file }}</option>
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
$app_model_file = str_replace('/', '\\', $app_model_file);
?>
                          <option value="App{{ $app_model_file }}"
                            {{ !empty($rules->{'exists_table'.$x}) && $rules->{'exists_table'.$x}[1] == 'App'.$app_model_file?'selected':'' }}
                          >App{{ $app_model_file }}</option>
                          @endforeach
                        </optgroup>
                        @endif
                        @endforeach
                      </select>
                    </label>
                  </div>
                  <div class="col-md-8">
                    <label class="form-check-input" dir="rtl"> {{it_trans('it.date')}}
                      <input type="checkbox" value="1" class="date_data" to="{{ $x }}" name="date{{ $x }}" {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[0])?$rules->{'date'.$x}[0]:'' }} />
                    </label>
                    <div class="date_list{{ $x }} {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[0])?'':'hidden' }} ">
                      <div class="col-md-3" >
                        <label class="" dir="rtl"> {{it_trans('it.date_format')}}</label>
                        <select name="date_format{{ $x }}" class="form-control">
                          <option  selected>NULL</option>
                          <optgroup label="Date">
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:Y-m-d'?'selected':'' }} value="date_format:Y-m-d">date_format:Y-m-d</option>
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:Y-M-D'?'selected':'' }} value="date_format:Y-M-D">date_format:Y-M-D</option>
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:y-M-D'?'selected':'' }} value="date_format:y-M-D">date_format:y-M-D</option>
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:y-m-D'?'selected':'' }} value="date_format:y-m-D">date_format:y-m-D</option>
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:y-m-d'?'selected':'' }} value="date_format:y-m-d">date_format:y-m-d</option>
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:d-m-Y'?'selected':'' }} value="date_format:d-m-Y">date_format:d-m-Y</option>
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:d-M-Y'?'selected':'' }} value="date_format:d-M-Y">date_format:d-M-Y</option>
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:D-M-Y'?'selected':'' }} value="date_format:D-M-Y">date_format:D-M-Y</option>
                          </optgroup>
                          <optgroup label="Date & Time">
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:Y-m-d h:i:s'?'selected':'' }} value="date_format:Y-m-d h:i:s">date_format:Y-m-d h:i:s</option>
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:Y-M-D h:i:s'?'selected':'' }} value="date_format:Y-M-D h:i:s">date_format:Y-M-D h:i:s</option>
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:y-M-D h:i:s'?'selected':'' }} value="date_format:y-M-D h:i:s">date_format:y-M-D h:i:s</option>
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:y-m-D h:i:s'?'selected':'' }} value="date_format:y-m-D h:i:s">date_format:y-m-D h:i:s</option>
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:y-m-d h:i:s'?'selected':'' }} value="date_format:y-m-d h:i:s">date_format:y-m-d h:i:s</option>
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:d-m-Y h:i:s'?'selected':'' }} value="date_format:d-m-Y h:i:s">date_format:d-m-Y h:i:s</option>
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:d-M-Y h:i:s'?'selected':'' }} value="date_format:d-M-Y h:i:s">date_format:d-M-Y h:i:s</option>
                            <option {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'date_format'.$x} == 'date_format:D-M-Y h:i:s'?'selected':'' }} value="date_format:D-M-Y h:i:s">date_format:D-M-Y h:i:s</option>
                          </optgroup>
                        </select>
                      </div>
                      <div class="col-md-3" >
                        <label class="form-check-input" dir="rtl"> {{it_trans('it.after')}}
                          <input type="radio" value="after" class="after_before" to="{{ $x }}" name="after_before{{ $x }}"
                          {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'after_before'.$x} == 'after'?'checked':'' }}
                          />
                        </label>
                        -
                        <label class="form-check-input" dir="rtl"> {{it_trans('it.before')}}
                          <input type="radio" value="before"
                          {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'date_format'.$x}) && $rules->{'date'.$x}[1]->{'after_before'.$x} == 'before'?'checked':'' }}
                          class="after_before" to="{{ $x }}" name="after_before{{ $x }}" />
                        </label>
                        <div class="after_before_list{{ $x }}
                          {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x})?'':'hidden' }}
                          ">
                          <ol>
                            <li>
                              <label class="mt-radio" dir="rtl"> {{it_trans('it.today')}}
                                <input type="radio" value="today" class="before_after_tomorrow"
                                {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x}) && $rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x} == 'today'?'checked':'' }}
                                to="{{ $x }}" name="before_after_tomorrow{{ $x }}" />
                              </label>
                            </li>
                            <li>
                              <label class="mt-radio" dir="rtl"> {{it_trans('it.tomorrow')}}
                                <input type="radio" value="tomorrow"
                                {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x}) && $rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x} == 'tomorrow'?'checked':'' }}
                                class="before_after_tomorrow" to="{{ $x }}" name="before_after_tomorrow{{ $x }}" />
                              </label>
                            </li>
                            <li>
                              <label class="mt-radio" dir="rtl"> {{it_trans('it.other_col')}}
                                <input type="radio" value="other_col"
                                {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x}) && $rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x} == 'other_col'?'checked':'' }}
                                class="before_after_tomorrow" to="{{ $x }}" name="before_after_tomorrow{{ $x }}" />
                              </label>
                            </li>
                            <li>
                              <label class="mt-radio" dir="rtl"> {{it_trans('it.other_carbon')}}
                                <input type="radio" value="other_carbon"
                                {{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x}) && $rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x} == 'other_carbon'?'checked':'' }}
                                class="before_after_tomorrow" to="{{ $x }}" name="before_after_tomorrow{{ $x }}" />
                              </label>
                            </li>
                          </ol>
                        </div>
                      </div>
                      @if(!empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x}) && $rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x} == 'other_col')
                      <script type="text/javascript">
                      $(document).ready(function(){
                      var to = {{ $x }};
                      var val = 'other_col';
                      $('.each_other_carbon'+to).addClass('hidden');
                      $('.each_other_col'+to).removeClass('hidden');
                      var select_list = '<select name="other_cal_before_after'+to+'" class="form-control">';
                        $('input[name="col_name_convention[]"]').each(function(){
                        var vselect = $(this).val();
                        if(vselect == '{{ $rules->{'date'.$x}[1]->{'other_cal_before_after'.$x} }}'){
                        var selectedVal = 'selected';
                        }else{
                        var selectedVal = '';
                        }
                        select_list += '<option value="'+vselect+'" '+selectedVal+'>'+vselect+'</option>';
                        });
                      select_list += '</select>';
                      $('.each_col_name_other_col'+to).html(select_list);
                      });
                      </script>
                      @endif
                      <div class="col-md-3 each_other_col{{ $x }} hidden">
                        Select The Column
                        <span class="each_col_name_other_col{{ $x }}"></span>
                      </div>
                      <div class="col-md-3 each_other_carbon{{ $x }}
                        {{ empty($rules->{'date'.$x}) || empty($rules->{'date'.$x}[1]) || empty($rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x}) || $rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x} != 'other_carbon'?'hidden':'' }}
                        ">
                        Write Carbon Days
                        <label>
                          Days <input type="text" name="other_carbon{{ $x }}" placeholder="Days" class="form-control"
                          value="{{ !empty($rules->{'date'.$x}) && !empty($rules->{'date'.$x}[1]) && !empty($rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x}) && $rules->{'date'.$x}[1]->{'before_after_tomorrow'.$x} == 'other_carbon'?$rules->{'date'.$x}[1]->{'other_carbon'.$x}:'' }}"
                          />
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
          <input type="checkbox" value="1" name="forginkeyto{{ $x }}" class="forginkeyto" {{ !empty($rules->{'forginkeyto'.$x})?'checked':'' }}  to="{{ $x }}" value="1" />
        </div>
        <div class="forginkeyto{{ $x }} {{ empty($rules->{'forginkeyto'.$x})?'hidden':'' }}">
          <div class="form-group col-md-4">
            <label class="form-check-input" dir="rtl"> {{it_trans('it.references')}}
              <input type="text" name="references{{ $x }}"
              @if(!empty(!empty($rules->{'forginkeyto'.$x})) && !empty($rules->{'forginkeyto'.$x}[1]))
              @if(!empty($rules->{'forginkeyto'.$x}[1]->{'references'.$x}))
              value="{{ $rules->{'forginkeyto'.$x}[1]->{'references'.$x} }}"
              @endif
              @endif
              placeholder="{{it_trans('it.references')}}" class="form-control references" to="{{ $x }}" />
            </div>
            <div class="form-group col-md-4">
              <label class="form-check-input" dir="rtl"> {{it_trans('it.forgin_table_name')}}
                <input type="text" name="forgin_table_name{{ $x }}"
                @if(!empty(!empty($rules->{'forginkeyto'.$x})) && !empty($rules->{'forginkeyto'.$x}[1]))
                @if(!empty($rules->{'forginkeyto'.$x}[1]->{'forgin_table_name'.$x}))
                value="{{ $rules->{'forginkeyto'.$x}[1]->{'forgin_table_name'.$x} }}"
                @endif
                @endif
                placeholder="{{it_trans('it.forgin_table_name')}}" class="form-control forgin_table_name"  to="{{ $x }}" />
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-check-input" dir="rtl"> {{it_trans('it.nullable')}}
                    <input type="checkbox" name="schema_nullable{{ $x }}"
                    value="1"
                    @if(!empty(!empty($rules->{'forginkeyto'.$x})) && !empty($rules->{'forginkeyto'.$x}[1]))
                    @if(!empty($rules->{'forginkeyto'.$x}[1]->{'schema_nullable'.$x}))
                    {{ $rules->{'forginkeyto'.$x}[1]->{'schema_nullable'.$x} }}
                    @endif
                    @endif
                    class="func_nullable" to="{{ $x }}" />
                  </div>
                  <div class="form-group">
                    <label class="form-check-input" dir="rtl"> {{it_trans('it.onDelete')}}
                      <input type="checkbox" name="schema_onDelete{{ $x }}"
                      value="1"
                      @if(!empty(!empty($rules->{'forginkeyto'.$x})) && !empty($rules->{'forginkeyto'.$x}[1]))
                      @if(!empty($rules->{'forginkeyto'.$x}[1]->{'schema_onDelete'.$x}))
                      {{ $rules->{'forginkeyto'.$x}[1]->{'schema_onDelete'.$x} }}
                      @endif
                      @endif
                      class="onDelete" to="{{ $x }}" />
                    </div>
                    <div class="form-group">
                      <label class="form-check-input" dir="rtl"> {{it_trans('it.onUpdate')}}
                        <input type="checkbox" name="schema_onUpdate{{ $x }}"
                        value="1"
                        @if(!empty(!empty($rules->{'forginkeyto'.$x})) && !empty($rules->{'forginkeyto'.$x}[1]))
                        @if(!empty($rules->{'forginkeyto'.$x}[1]->{'schema_onUpdate'.$x}))
                        {{ $rules->{'forginkeyto'.$x}[1]->{'schema_onUpdate'.$x} }}
                        @endif
                        @endif
                        class="onUpdate" to="{{ $x }}" />
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <p>$table->foreignId('<span class="col_name_{{ $x }}">{{explode('|',$input->col_name_convention)[0]}}</span>')->constrained('<span class="forgin_table_name{{ $x }}">@if(!empty(!empty($rules->{'forginkeyto'.$x})) && !empty($rules->{'forginkeyto'.$x}[1]) && !empty($rules->{'forginkeyto'.$x}[1]->{'forgin_table_name'.$x})){{ $rules->{'forginkeyto'.$x}[1]->{'forgin_table_name'.$x} }}@endif</span>')->references('<span class="references{{ $x }}">@if(!empty(!empty($rules->{'forginkeyto'.$x})) && !empty($rules->{'forginkeyto'.$x}[1]) && !empty($rules->{'forginkeyto'.$x}[1]->{'references'.$x})){{ $rules->{'forginkeyto'.$x}[1]->{'references'.$x} }}@endif</span>')<span  class="schema_onDelete{{ $x }} {{ !empty(!empty($rules->{'forginkeyto'.$x})) && !empty($rules->{'forginkeyto'.$x}[1]) && $rules->{'forginkeyto'.$x}[1]->{'schema_onDelete'.$x}?'':'hidden' }}">->onDelete('cascade')</span><span  class="schema_onUpdate{{ $x }} {{ !empty(!empty($rules->{'forginkeyto'.$x})) && !empty($rules->{'forginkeyto'.$x}[1]) && $rules->{'forginkeyto'.$x}[1]->{'schema_onUpdate'.$x}?'':'hidden' }}">->onUpdate('cascade')</span><span class="func_nullable{{ $x }} {{ !empty(!empty($rules->{'forginkeyto'.$x})) && !empty($rules->{'forginkeyto'.$x}[1]) && !empty($rules->{'forginkeyto'.$x}[1]->{'schema_onDelete'.$x})?'':'hidden' }}">->nullable()</span>;</p>



                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="clearfix"></div>
              <a href="#" class="remove_field btn btn-danger pull-right"><i class="fa fa-trash"></i></a>
            </div>
            @php
            $x++;
            @endphp
            @endforeach
          </div>
          <div class="col-md-12">
            <button class="add_field_button btn btn-success"><i class="fa fa-plus"></i></button>
          </div>