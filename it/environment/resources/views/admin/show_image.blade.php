@if(!empty($image))
@php
$random = Str::random(5);
@endphp
<div style="margin-top: 5px;display: inline-block;">
<a href="#" data-toggle="modal" data-target="#img_{{ $random }}">
  <i class="fa fa-image fa-2x"></i>
</a>
</div>
<div id="img_{{ $random }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="">
        <button type="button" class="btn btn-default btn-sm float-left" data-dismiss="modal">x</button>
      </div>
      <div class="modal-body">
        <center>
          <img src="{{ it()->url($image) }}" style="width:100%;height:100%;" />
        </center>
      </div>
    </div>
  </div>
</div>
@endif