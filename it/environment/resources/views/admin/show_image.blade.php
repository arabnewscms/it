@if(!empty($image))
@php
$random = Str::random(40);
@endphp
<div style="margin-top: 5px;display: inline-block;">
<a href="#" data-toggle="modal" data-target="#img_{{ $random }}">
  <i class="fa fa-image fa-2x"></i>
</a>
</div>
<div id="img_{{ $random }}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <img src="{{ it()->url($image) }}" style="width:100%;height:500px" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans("admin.close") }}</button>
      </div>
    </div>
  </div>
</div>
@endif