@if(!empty($audio))
@php
$random = Str::random(40);
$ext =  !is_null(explode('.',$audio)) && count(explode('.',$audio)) > 0?explode('.',$audio)[1]:'mp4';
@endphp
<div style="margin-top: 5px;display: inline-block;">
  <a href="#" data-toggle="modal" data-target="#audio_{{ $random }}">
    <i class="fa fa-file-audio-o fa-2x"></i>
  </a>
</div>
<div id="audio_{{ $random }}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <audio controls class="audioTrack{{ $random }} hidden" style="width:100%">
          <source src="{{ it()->url($audio) }}" type="audio/{{ $ext }}">
          Your browser does not support the audio element.
        </audio>
        <hr />
        <a href="{{ it()->url($audio) }}" target="_blank"><i class="fa fa-download fa-2x"></i></a>
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
$("#audio_{{ $random }}").on('shown.bs.modal', function (e) {
  $('.audioTrack{{ $random }}').removeClass('hidden');
});
  $(window).on('hidden.bs.modal', function() {
  $('.audioTrack{{ $random }}')[0].pause();
  });
});
</script>
@endif