{{-- @push('baboon_js')
<script type="text/javascript">
$(document).on('click','.install_package',function(){
  var install_package = $(this).attr('package_name');
  var btn_id = $(this).attr('btn_id');
  var package_name = $(this).parent('tr').addClass('info');
  if(install_package !== ''){
   $.ajax({
    url:'{{ url('it/baboon/install/package') }}',
    dataType:'json',
    type:'post',
    data:{_token:'{{ csrf_token() }}',install_package:install_package},
    beforeSend: function(){
     $('.package_td'+btn_id).html('<span class="btn btn-sm btn-info"><i class="fa fa-spin fa-spinner"></i> Downloading...</span>');
      $('.package_tr'+btn_id).removeClass('warning').addClass('info');
    },success: function(data){
      console.log(data);
    }
   });
  }
  return false;
});
</script>
@endpush --}}
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Package Name</th>
      <th>Status</th>
      <th>version</th>
    </tr>
  </thead>
  <tbody>
@php
 $package_list = [
  'yajra/laravel-datatables-oracle',
  'yajra/laravel-datatables-fractal',
  'yajra/laravel-datatables-buttons',
  'yajra/laravel-datatables-editor',
  'yajra/laravel-datatables-html',
  'laravelcollective/html',
  'intervention/image',
  'spatie/laravel-honeypot',
  'tymon/jwt-auth',
  'unisharp/laravel-filemanager',
  'guzzlehttp/guzzle',
  'laravel/ui',
  'maatwebsite/excel',
  'mpdf/mpdf',
  'tecnickcom/tcpdf',
  'barryvdh/laravel-snappy',
  'fruitcake/laravel-cors',
  'dompdf/dompdf',
  'langnonymous/lang',
  'phpanonymous/c3js',
  'phpanonymous/it',
 ];
@endphp
@foreach($package_list as $key=> $package)
    @include('baboon.installed_package_tr',['package_name'=>$package,'key'=>$key])
@endforeach
    </tbody>
  </table>