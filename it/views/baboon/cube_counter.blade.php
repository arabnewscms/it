<div class="col-md-6 well">
  <div class="alert alert-info">
    <h4>{{ it_trans('it.statistics_cube') }}</h4>
    <div class="col-md-12">
      <div class="form-group">
        <label for="col_type" class="col-md-12">{{it_trans('it.statistics_theme')}}</label>
        <div class="col-md-12">
          <select name="statistics_theme" class="form-control">
            <option {{ !empty($module_data->statistics_theme) && $module_data->statistics_theme == 'small-box'?'selected':'' }} value="small-box">small-box</option>
            <option {{ !empty($module_data->statistics_theme) && $module_data->statistics_theme == 'info-box'?'selected':'' }} value="info-box">info-box</option>
            <option {{ !empty($module_data->statistics_theme) && $module_data->statistics_theme == 'progress-box'?'selected':'' }} value="progress-box">progress-box</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="col_type" class="col-md-12">{{it_trans('it.statistics_bgcolor')}}</label>
        <div class="col-md-12">
          <select name="statistics_bgcolor" class="form-control">
            <optgroup label="Normal">
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-primary'?'selected':'' }} value="bg-primary">bg-primary</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-info'?'selected':'' }} value="bg-info">bg-info</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-success'?'selected':'' }} value="bg-success">bg-success</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-danger'?'selected':'' }} value="bg-danger">bg-danger</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-dark'?'selected':'' }} value="bg-dark">bg-dark</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gray'?'selected':'' }} value="bg-gray">bg-gray</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gray-dark'?'selected':'' }} value="bg-gray-dark">bg-gray-dark</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-light'?'selected':'' }} value="bg-light">bg-light</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-secondary'?'selected':'' }} value="bg-secondary">bg-secondary</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-default'?'selected':'' }} value="bg-default">bg-default</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-indigo'?'selected':'' }} value="bg-indigo">bg-indigo</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-purple'?'selected':'' }} value="bg-purple">bg-purple</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-pink'?'selected':'' }} value="bg-pink">bg-pink</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-teal'?'selected':'' }} value="bg-teal">bg-teal</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-cyan'?'selected':'' }} value="bg-cyan">bg-cyan</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-orange'?'selected':'' }} value="bg-orange">bg-orange</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-white'?'selected':'' }} value="bg-white">bg-white</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-olive'?'selected':'' }} value="bg-olive">bg-olive</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-lime'?'selected':'' }} value="bg-lime">bg-lime</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-fuchsia'?'selected':'' }} value="bg-fuchsia">bg-fuchsia</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-maroon'?'selected':'' }} value="bg-maroon">bg-maroon</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-yellow'?'selected':'' }} value="bg-yellow">bg-yellow</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-navy'?'selected':'' }} value="bg-navy">bg-navy</option>
            </optgroup>
            <optgroup label="Gradient">
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-primary'?'selected':'' }} value="bg-gradient-primary">bg-gradient-primary</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-info'?'selected':'' }} value="bg-gradient-info">bg-gradient-info</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-success'?'selected':'' }} value="bg-gradient-success">bg-gradient-success</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-danger'?'selected':'' }} value="bg-gradient-danger">bg-gradient-danger</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-dark'?'selected':'' }} value="bg-gradient-dark">bg-gradient-dark</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-default'?'selected':'' }} value="bg-gradient-default">bg-gradient-default</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-secondary'?'selected':'' }} value="bg-gradient-secondary">bg-gradient-secondary</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-indigo'?'selected':'' }} value="bg-gradient-indigo">bg-gradient-indigo</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-purple'?'selected':'' }} value="bg-gradient-purple">bg-gradient-purple</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-pink'?'selected':'' }} value="bg-gradient-pink">bg-gradient-pink</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-teal'?'selected':'' }} value="bg-gradient-teal">bg-gradient-teal</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-cyan'?'selected':'' }} value="bg-gradient-cyan">bg-gradient-cyan</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-dark'?'selected':'' }} value="bg-gradient-dark">bg-gradient-dark</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-gray-dark'?'selected':'' }} value="bg-gradient-gray-dark">bg-gradient-gray-dark</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-gray'?'selected':'' }} value="bg-gradient-gray">bg-gradient-gray</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-light'?'selected':'' }} value="bg-gradient-light">bg-gradient-light</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-white'?'selected':'' }} value="bg-gradient-white">bg-gradient-white</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-orange'?'selected':'' }} value="bg-gradient-orange">bg-gradient-orange</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-olive'?'selected':'' }} value="bg-gradient-olive">bg-gradient-olive</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-lime'?'selected':'' }} value="bg-gradient-lime">bg-gradient-lime</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-fuchsia'?'selected':'' }} value="bg-gradient-fuchsia">bg-gradient-fuchsia</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-maroon'?'selected':'' }} value="bg-gradient-maroon">bg-gradient-maroon</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-yellow'?'selected':'' }} value="bg-gradient-yellow">bg-gradient-yellow</option>
              <option {{ !empty($module_data->statistics_bgcolor) && $module_data->statistics_bgcolor == 'bg-gradient-navy'?'selected':'' }} value="bg-gradient-navy">bg-gradient-navy</option>
            </optgroup>
          </select>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>