<!--{{ $link }}_start-->
@if($default_theme == 'small-box')
<?php
echo '<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box ' . $default_bgcolor . '">
      <div class="inner">
        <h3>{{ mK(App\Models\\' . $data["model_name"] . '::count()) }}</h3>
        <p>{{ trans("' . $data['lang_file'] . '.' . $link . '") }}</p>
      </div>
      <div class="icon">
        <i class="' . $fa_icon . '"></i>
      </div>
      <a href="{{ aurl("' . $link . '") }}" class="small-box-footer">{{ trans("' . $data['lang_file'] . '.' . $link . '") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
';
?>
@elseif($default_theme == 'info-box')
<?php
echo '<div class="col-md-3 col-sm-6 col-12">
  <div class="info-box">
    <span class="info-box-icon ' . $default_bgcolor . '"><i class="' . $fa_icon . '"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">{{ trans("' . $data['lang_file'] . '.' . $link . '") }}</span>
      <span class="info-box-number">{{ mK(App\Models\\' . $data["model_name"] . '::count()) }}</span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
';
?>
@elseif($default_theme == 'progress-box')
<?php
echo '<div class="col-md-3 col-sm-6 col-12">
  <div class="info-box ' . $default_bgcolor . '">
    <span class="info-box-icon"><i class="' . $fa_icon . '"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">{{ trans("' . $data['lang_file'] . '.' . $link . '") }}</span>
      <span class="info-box-number">{{ mK(App\Models\\' . $data["model_name"] . '::count()) }}</span>
      <div class="progress">
        <div class="progress-bar" style="width: 70%"></div>
      </div>
      <span class="progress-description">
         (70% demo text here)
      </span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
';
?>
@endif
<!--{{ $link }}_end-->