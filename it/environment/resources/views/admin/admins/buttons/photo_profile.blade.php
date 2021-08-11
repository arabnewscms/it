@if(!empty($photo_profile))
<div style="margin-top: 5px;display: inline-block;">
  <a href="#" data-toggle="modal" data-target="#img_{{ $id }}">
    <i class="fa fa-image fa-2x"></i>
  </a>
</div>
<div id="img_{{ $id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="">
        <button type="button" class="btn btn-default btn-sm float-right" data-dismiss="modal">x</button>
      </div>
      <div class="modal-body">
        <center>
        <img src="{{ it()->url($photo_profile) }}" style="width:100%;height:100" />
        </center>
      </div>
    </div>
  </div>
</div>
@endif