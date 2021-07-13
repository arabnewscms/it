@if(!empty($video))
@php
$random = Str::random(40);
$ext =  !is_null(explode('.',$video)) && count(explode('.',$video)) > 0?explode('.',$video)[1]:'mp4';
@endphp
<div style="margin-top: 5px;display: inline-block;">
  <a href="#" data-toggle="modal" data-target="#video_{{ $random }}">
    <i class="fa fa-video-camera fa-2x"></i>
  </a>
</div>
<div id="video_{{ $random }}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <video class="vjs-theme-fantasy video-js hidden" id="video{{ $random }}" data-setup='{"controls": true, "autoplay": false, "preload": "auto"}' width="870px" height="400px" >
          <source src="{{ it()->url($video) }}" type="video/{{ $ext }}">
        </video>
        <hr />
        <a href="{{ it()->url($video) }}" target="_blank"><i class="fa fa-download fa-2x"></i></a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans("admin.close") }}</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  var mplayer;
  $("#video_{{ $random }}").on('shown.bs.modal', function (e) {
  mplayer =  videojs('#video{{ $random }}', {
      controls: true,
      autoplay: false,
      preload: 'auto'
    });
    $('#video{{ $random }}').removeClass('hidden');
  });

  $(window).on('hidden.bs.modal', function() {
    mplayer.pause();
  });
});
</script>
@endif