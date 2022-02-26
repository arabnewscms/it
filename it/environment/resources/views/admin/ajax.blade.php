@push('js')
<script type="text/javascript">
$(document).ready(function(){
@if($typeForm == 'create')
   var selectID = '{{ $selectID }}';
   $(document).on('change','#'+selectID,function(){
    var selectIDValue = $('#'+selectID+' option:selected').val();
    if(selectIDValue > 0){
    $.ajax({
       url:'{{ $url }}',
       dataType:'html',
       type:'post',
       data:{_token:'{{ csrf_token() }}','{{ $selectID }}':selectIDValue},
       beforeSend: function(){
        $('.{{ $outputClass }}').html('<center><i class="fa fa-spinner fa-spin"></i></center>');
       },success: function(data){
        $('.{{ $outputClass }}').html(data);
        $('#{{ $outputClass }}').select2();
       }
    });
    }else{
        $('.{{ $outputClass }}').html('<select class="form-control" id="{{ $outputClass }}"></select>');
        $('#{{ $outputClass }}').select2();
    }
    });

    $('.{{ $outputClass }}').html('<select class="form-control" id="{{ $outputClass }}"></select>');
    $('#{{ $outputClass }}').select2();

    @if(old($outputClass))
    var selectIDValue = $('#'+selectID+' option:selected').val();
    $.ajax({
       url:'{{ $url }}',
       dataType:'html',
       type:'post',
       data:{_token:'{{ csrf_token() }}','{{ $selectID }}':selectIDValue,select:'{{ old($outputClass) }}'},
       beforeSend: function(){
        $('.{{ $outputClass }}').html('<center><i class="fa fa-spinner fa-spin"></i></center>');
       },success: function(data){
        $('.{{ $outputClass }}').html(data);
        $('#{{ $outputClass }}').select2();
       }
    });
   @endif
 @elseif($typeForm == 'edit')
   var selectID = '{{ $selectID }}';
   $(document).on('change','#'+selectID,function(){
    var selectIDValue = $('#'+selectID+' option:selected').val();
    if(selectIDValue > 0){
    $.ajax({
       url:'{{ $url }}',
       dataType:'html',
       type:'post',
       data:{_token:'{{ csrf_token() }}','{{ $selectID }}':selectIDValue},
       beforeSend: function(){
        $('.{{ $outputClass }}').html('<center><i class="fa fa-spinner fa-spin"></i></center>');
       },success: function(data){
        $('.{{ $outputClass }}').html(data);
        $('#{{ $outputClass }}').select2();
       }
    });
    }else{
        $('.{{ $outputClass }}').html('<select class="form-control" id="{{ $outputClass }}"></select>');
        $('#{{ $outputClass }}').select2();
    }
    });

    $('.{{ $outputClass }}').html('<select class="form-control select2" id="{{ $outputClass }}"></select>');
    $('#{{ $outputClass }}').select2();


    @if($selectedvalue > 0)
    var selectIDValue = $('#'+selectID+' option:selected').val();
    $.ajax({
       url:'{{ $url }}',
       dataType:'html',
       type:'post',
       data:{
        _token:'{{ csrf_token() }}',
        '{{ $selectID }}': '{{ $parentValue }}',
        select:'{{ $selectedvalue }}'
       },
       beforeSend: function(){
        $('.{{ $outputClass }}').html('<center><i class="fa fa-spinner fa-spin"></i></center>');
       },success: function(data){
        $('.{{ $outputClass }}').html(data);
        $('#{{ $outputClass }}').select2();
       }
    });
   @endif
 @endif
});
</script>
@endpush

