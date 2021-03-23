@if(!empty($photo_profile))
<a href="#" data-toggle="modal" data-target="#img{{ $id }}"><img src="{{ it()->url($photo_profile) }}" style="width:32px;height:32px" /></a>
<div id="img{{ $id }}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <img src="{{ it()->url($photo_profile) }}" style="width:100%;height:500px" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans("admin.close") }}</button>
      </div>
    </div>
  </div>
</div>
@endif