'<div class="col-md-12 well">'+
	'<div class="col-md-4">'+
		'<div class="form-group">'+
			'<label for="col_name" class="col-md-6">{{it_trans('it.col_name')}}</label>'+
			'<div class="col-md-12">'+
				'<input type="text" name="col_name[]" value="{{old('col_name')}}" class="form-control" placeholder="{{it_trans('it.col_name')}}" >'+
			'</div>'+
		'</div>'+
	'</div>'+
	'<div class="col-md-4">'+
		'<div class="form-group">'+
			'<label for="col_type" class="col-md-6">{{it_trans('it.col_type')}}</label>'+
			'<div class="col-md-12">'+
				'<select name="col_type[]" class="form-control">'+
					'<option value="text">{{it_trans('it.text')}}</option>'+
					'<option value="email">{{it_trans('it.email')}}</option>'+
					'<option value="url">{{it_trans('it.url')}}</option>'+
					'<option value="textarea">{{it_trans('it.textarea')}}</option>'+
					'<option value="textarea_ckeditor">{{it_trans('it.textarea_ckeditor')}}</option>'+
					'<option value="select">{{it_trans('it.select')}}</option>'+
					'<option value="file">{{it_trans('it.file')}}</option>'+
					'<option value="password">{{it_trans('it.password')}}</option>'+
					'<option value="checkbox">{{it_trans('it.checkbox')}}</option>'+
					'<option value="radio">{{it_trans('it.radio')}}</option>'+
					'<option value="color">{{it_trans('it.color')}}</option>'+
					'<option value="date">{{it_trans('it.date')}}</option>'+
					'<option value="date_time">{{it_trans('it.date_time')}}</option>'+
					'<option value="time">{{it_trans('it.time')}}</option>'+
					'<option value="timestamp">{{it_trans('it.timestamp')}}</option>'+
					'<option value="number">{{it_trans('it.number')}}</option>'+
				'</select>'+
			'</div>'+
		'</div>'+
	'</div>'+
	'<div class="col-md-4">'+
		'<div class="form-group">'+
			'<div class="col-md-12">'+
				'<label for="col_name_convention" class="">{{it_trans('it.col_name_convention')}}</label>'+
				'<input type="text" name="col_name_convention[]" to="'+x+'" value="{{old('col_name_convention')}}" class="form-control col_name_convention" placeholder="{{it_trans('it.col_name_convention')}}" >'+
				'<small>Select - active|1,yes/0,no</small><br>'+
				'<small>Select - user_id|App\User::pluck("name","id")</small><br>'+
				'<small>checkbox or radio - active#1</small><br>'+
			'</div>'+
		'</div>'+
	'</div>'+
	'<div class="clearfix"></div>'+
	'<hr />'+
	'<div class="col-md-12 alert alert-default">'+
		'<div class="col-md-12">'+
			'<label class="mt-radio">'+
				'<input type="radio" name="col_name_null'+x+'" class="col_name_null" id="col_name_null" list="'+x+'" value="null" checked>'+
				' {{it_trans('it.col_name_null')}} '+
				'<span></span>'+
			'</label>  '+
			'<label class="mt-radio">'+
				'<input type="radio" name="col_name_null'+x+'" class="col_name_null" id="col_name_null" list="'+x+'" value="has">'+
				' {{it_trans('it.not_null')}} '+
				'<span></span>'+
			'</label>'+
		'</div>'+
		'<div class="clearfix"></div>'+
		'<hr />'+
		'<div class="col-md-12 list_validation'+x+' hidden">'+
			'<div class="col-md-3">'+
				'<label class="mt-checkbox" dir="rtl">'+
					' {{it_trans('it.url')}} '+
					'<input type="checkbox" value="1" name="url'+x+'" />'+
				'</label>'+
			'</div>'+
			'<div class="col-md-3">'+
				'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.image')}} '+
					'<input type="checkbox" value="1" name="image'+x+'" />'+
				'</label>'+
			'</div>'+
			'<div class="col-md-3">'+
				'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.required')}} '+
					'<input type="checkbox" value="1" name="required'+x+'" />'+
				'</label>'+
			'</div>'+
			'<div class="col-md-3">'+
				'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.numeric')}} '+
					'<input type="checkbox" value="1" name="numeric'+x+'" />'+
				'</label>'+
			'</div>'+
			'<div class="col-md-3">'+
				'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.sometimes')}} '+
					'<input type="checkbox" value="1" name="sometimes'+x+'" />'+
				'</label>'+
			'</div>'+
			'<div class="col-md-3">'+
				'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.nullable')}} '+
					'<input type="checkbox" value="1" name="nullable'+x+'" />'+
				'</label>'+
			'</div>'+
			'<div class="col-md-3">'+
				'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.confirmed')}} '+
					'<input type="checkbox" value="1" name="confirmed'+x+'" />'+
				'</label>'+
			'</div>'+
			'<div class="col-md-3">'+
				'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.string')}}'+
					'<input type="checkbox" value="1" name="string'+x+'" />'+
				'</label>'+
			'</div>'+
			'<div class="col-md-3">'+
				'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.alpha-dash')}}'+
					'<input type="checkbox" value="1" name="alpha-dash'+x+'" />'+
				'</label>'+
			'</div>'+
			'<div class="clearfix"></div>'+
			'<br>'+
			'<div class="col-md-12">'+
				'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.date')}}'+
					'<input type="checkbox" value="1" class="date_data" to="'+x+'" name="date'+x+'" />'+
				'</label>'+
				'<div class="date_list'+x+' hidden">'+
					' <div class="col-md-3">'+
						'  <label class="" dir="rtl"> {{it_trans('it.date_format')}}</label>'+
						' <select name="date_format'+x+'" class="form-control">'+
							'    <option  selected>NULL</option>'+
							'  <optgroup label="Date">'+
								'<option value="date_format:Y-m-d">date_format:Y-m-d</option>'+
								'<option value="date_format:Y-M-D">date_format:Y-M-D</option>'+
								'<option value="date_format:y-M-D">date_format:y-M-D</option>'+
								'<option value="date_format:y-m-D">date_format:y-m-D</option>'+
								'<option value="date_format:y-m-d">date_format:y-m-d</option>'+
								'<option value="date_format:d-m-Y">date_format:d-m-Y</option>'+
								'<option value="date_format:d-M-Y">date_format:d-M-Y</option>'+
								'<option value="date_format:D-M-Y">date_format:D-M-Y</option>'+
							'</optgroup>'+
							'<optgroup label="Date & Time">'+
								'<option value="date_format:Y-m-d h:i:s">date_format:Y-m-d h:i:s</option>'+
								'<option value="date_format:Y-M-D h:i:s">date_format:Y-M-D h:i:s</option>'+
								'<option value="date_format:y-M-D h:i:s">date_format:y-M-D h:i:s</option>'+
								'<option value="date_format:y-m-D h:i:s">date_format:y-m-D h:i:s</option>'+
								'<option value="date_format:y-m-d h:i:s">date_format:y-m-d h:i:s</option>'+
								'<option value="date_format:d-m-Y h:i:s">date_format:d-m-Y h:i:s</option>'+
								'<option value="date_format:d-M-Y h:i:s">date_format:d-M-Y h:i:s</option>'+
								'<option value="date_format:D-M-Y h:i:s">date_format:D-M-Y h:i:s</option>'+
							'</optgroup>'+
						'</select>'+
					'</div>'+
					'<div class="col-md-3">'+
						'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.after')}}'+
							'<input type="radio" value="after" class="after_before" to="'+x+'" name="after_before'+x+'" />'+
						'</label>'+
						'-'+
						'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.before')}}'+
							'<input type="radio" value="before" class="after_before" to="'+x+'" name="after_before'+x+'" />'+
						'</label>'+
						'<div class="after_before_list'+x+' hidden">'+
							'<ol>'+
								'<li>'+
									'<label class="mt-radio" dir="rtl"> {{it_trans('it.today')}}'+
										'<input type="radio" value="today" class="before_after_tomorrow" to="'+x+'" name="before_after_tomorrow'+x+'" />'+
									'</label>'+
								'</li>'+
								'<li>'+
									'<label class="mt-radio" dir="rtl"> {{it_trans('it.tomorrow')}}'+
										'<input type="radio" value="tomorrow"  class="before_after_tomorrow" to="'+x+'" name="before_after_tomorrow'+x+'" />'+
									'</label>'+
								'</li>'+
								'<li>'+
									'<label class="mt-radio" dir="rtl"> {{it_trans('it.other_col')}}'+
										'<input type="radio" value="other_col"  class="before_after_tomorrow" to="'+x+'" name="before_after_tomorrow'+x+'" />'+
									'</label>'+
								'</li>'+
								'<li>'+
									'<label class="mt-radio" dir="rtl"> {{it_trans('it.other_carbon')}}'+
										'<input type="radio" value="other_carbon" class="before_after_tomorrow" to="'+x+'" name="before_after_tomorrow'+x+'" />'+
									'</label>'+
								'</li>'+
							'</ol>'+
						'</div>'+
					'</div>'+
					'<div class="col-md-3 each_other_col'+x+' hidden">'+
						'Select The Column'+
						'<span class="each_col_name_other_col'+x+'"></span>'+
					'</div>'+
					'<div class="col-md-3 each_other_carbon'+x+' hidden">'+
						'Write Carbon Days'+
						'<label>'+
							'Days <input type="text" name="other_carbon'+x+'" placeholder="Days" class="form-control" >'+
						'</label>'+
					'</div>'+
				' </div>'+
			'</div>'+
			'<div class="clearfix"></div>'+
		'</div>'+
		'<div class="col-md-12 well">'+
			'<h4>Schema Relation</h4>'+
			'<div class="form-group">'+
				'<label class="mt-checkbox" dir="rtl">  {{it_trans('it.forginkeyto')}}      </label>'+
				'<input type="checkbox" value="1" name="forginkeyto'+x+'" class="forginkeyto" to="'+x+'" value="1" />'+
			'</div>'+
			'<div class="forginkeyto'+x+' hidden">'+
				'<div class="form-group col-md-4">'+
					'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.references')}}'+
						'<input type="text" name="references'+x+'" placeholder="{{it_trans('it.references')}}" class="form-control references" to="'+x+'" />'+
					'</div>'+
					'<div class="form-group col-md-4">'+
						'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.forgin_table_name')}}'+
							'<input type="text" name="forgin_table_name'+x+'" placeholder="{{it_trans('it.forgin_table_name')}}" class="form-control forgin_table_name"  to="'+x+'" />'+
						'</div>'+
						'<div class="col-md-4">'+
							'<div class="form-group">'+
								'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.nullable')}}'+
									'<input type="checkbox" name="schema_nullable'+x+'" class="func_nullable" to="'+x+'" />'+
								'</div>'+
								'<div class="form-group">'+
									'<label class="mt-checkbox" dir="rtl"> {{it_trans('it.onDelete')}}'+
										'<input type="checkbox" name="schema_onDelete'+x+'" class="onDelete" to="'+x+'" />'+
									'</div>'+
								'</div>'+
								'<div class="clearfix"></div>'+
								'<p>$table->integer("<span class="col_name_'+x+'"></span>")->unsigned()<span class="func_nullable'+x+' hidden">->nullable()</span>;</p>'+
								'<p>$table->foreign("<span class="col_name_'+x+'"></span>")->references("<span class="references'+x+'"></span>")->on("<span class="forgin_table_name'+x+'"></span>")<span  class="schema_onDelete'+x+' hidden">->onDelete("cascade")</span>;</p>'+
							'</div>'+
						'</div>'+
						'<div class="clearfix"></div>'+
					'</div>'+
					'<a href="#" class="remove_field btn btn-danger"><i class="fa fa-trash"></i></a>'+
				'</div>'