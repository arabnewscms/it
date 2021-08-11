@if(!empty($audio))
@php
$random = Str::random(5);
$ext =  !is_null(explode('.',$audio)) && count(explode('.',$audio)) > 0?explode('.',$audio)[1]:'mp4';
@endphp
<div style="margin-top: 5px;display: inline-block;">
  <a href="#" data-toggle="modal" data-target="#audio_{{ $random }}">
    <i class="fa fa-file-audio fa-2x"></i>
  </a>
</div>
<div id="audio_{{ $random }}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="">
        <button type="button" class="btn btn-default btn-sm float-left" data-dismiss="modal">x</button>
      </div>
      <div class="modal-body">
        <audio controls class="audioTrack{{ $random }} hidden" style="width:100%">
          <source src="{{ it()->url($audio) }}" type="audio/{{ $ext }}">
          Your browser does not support the audio element.
        </audio>
        <a href="{{ it()->url($audio) }}" target="_blank" class="float-left"><i class="fa fa-download"></i></a>
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
  $("#audio_{{ $random }}").on('hidden.bs.modal', function() {
  //$('.audioTrack{{ $random }}')[0].pause();
  $('.audioTrack{{ $random }}')[0].pause();
  });
});
</script>
@endif