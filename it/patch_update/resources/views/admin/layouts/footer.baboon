  </div><!-- /.container-fluid -->
                      </section>
                      <!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>
<!-- /.content-wrapper -->
 <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<footer class="main-footer">
<strong>&copy; {{ date('Y') }} {{ setting()->{l('sitename')} }}</strong>
<div class="float-right d-none d-sm-inline-block">
@if(function_exists('it_version'))
<a href="https://github.com/arabnewscms/it" target="_blank"><b>(IT Package)</b> {{ it_version() }} ❤️</a> <br />
don't forget to remove me
@endif
</div>
</footer>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="{{ url('assets') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="{{ url('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$(document).ready(function(){
$.widget.bridge('uibutton', $.ui.button);
});
</script>
<!-- DataTables -->
<script src="{{url("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{url("assets/plugins/datatables/selecta_all_checkbtn.js")}}"></script>
<script src="{{url("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
<script src="{{url("assets/plugins/datatables-buttons/js/dataTables.buttons.min.js")}}"></script>
<script src="{{url("assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js")}}"></script>
<script src="{{url("assets/plugins/datatables-buttons/js/buttons.html5.min.js")}}"></script>
<script src="{{url("assets/plugins/datatables-buttons/js/buttons.print.min.js")}}"></script>
<script src="{{url("assets/plugins/datatables-buttons/js/buttons.flash.min.js")}}"></script>
<script src="{{url("assets/plugins/datatables-buttons/js/buttons.colVis.min.js")}}"></script>
<script src="{{url("assets/plugins/datatables-buttons/js/buttons.server-side.js")}}"></script>


<!-- moment -->
<script src="{{ url('assets') }}/plugins/moment/moment.min.js"></script>
<!-- Summernote -->
<script src="{{ url('assets') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ url('assets') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('assets') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- sweetalert2 App -->
<script src="{{ url('assets') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- date-range-picker -->
<script src="{{ url('assets') }}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-colorpicker App -->
<script src="{{ url('assets') }}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

<!-- Select2 -->
<script src="{{ url('assets') }}/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('assets') }}/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script type="text/javascript">
var config = {
  url:'{{ aurl('/') }}',
  token:'{{ csrf_token() }}',
  custome_title:'Custom Theme Color'
};
// Change Card theme color
@if(!empty(!empty(setting()->theme_setting)) && !empty(setting()->theme_setting->navbar))
@php
$card = trim(str_replace('card-dark','',str_replace('navbar','card',setting()->theme_setting->navbar)));
@endphp
@if(!empty($card) && $card != 'card-dark')
$('.card').removeClass('card-dark').addClass('{{ $card }}');
@else
$('.card').addClass('card-dark');
@endif
@endif
</script>
<script src="{{ url('assets') }}/js/demo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script>
var options = {
filebrowserImageBrowseUrl: '{{ aurl('filemanager?type=Images') }}',
filebrowserImageUploadUrl: '{{ aurl('filemanager/upload?type=Images&_token=') }}',
filebrowserBrowseUrl: '{{ aurl('filemanager?type=Files') }}',
filebrowserUploadUrl: '{{ aurl('/filemanager/upload?type=Files&_token=') }}'
};
</script>
<script src="https://cdn.ckeditor.com/4.10.0/full/ckeditor.js"></script>
<script type="text/javascript" src="{{ url('vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>

<script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>
<!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
<!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->
<!-- END THEME LAYOUT SCRIPTS -->
@if(empty(request()->segment(2)))
<!-- ChartJS -->
<script src="{{ url('assets') }}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ url('assets') }}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ url('assets') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ url('assets') }}/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('assets') }}/plugins/jquery-knob/jquery.knob.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('assets') }}/js/pages/dashboard.js"></script>
@endif

<script src="{{url('assets/plugins/dropzone/min/dropzone.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$('textarea.ckeditor').ckeditor(options);
$('.date-picker').datepicker();
$.fn.dataTable.ext.errMode = 'none';

//color picker with addon
 $('.colorpicker').colorpicker();

 $('.colorpicker').on('colorpickerChange', function(event) {
      $('.colorpicker .fa-square').css('color', event.color.toString());
  });

 //Date range picker
 $('.datepicker').daterangepicker({
     // dateFormat: 'yyyy-mm-dd',
      showButtonPanel: true,
      gotoCurrent: false,
       locale: {
        format: 'YYYY-MM-DD'
      },
    singleDatePicker: true,
    showDropdowns: true,
    //startDate: '{{ date('Y-m-d') }}',
    //endDate: '{{ date('Y-m-d') }}',
    });

//date_time_picker
 $('.date_time_picker').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      showButtonPanel: true,
      gotoCurrent: false,
       locale: {
        format: 'YYYY-MM-DD hh:mm A'
      },
    singleDatePicker: true,
    showDropdowns: true,
    });


  //Timepicker
    $('.timepicker').datetimepicker({
      format: 'LT',
      ignoreReadonly:true
    });
    $('.timepicker').prop('readonly', true);

  $('.select2').select2({
      theme: 'bootstrap4'
    });

  $('input[type="file"]').on('change',function(){
      //get the file name
      var fileName = $(this).val().replace(/^C:\\fakepath\\/i, '');
      //replace the "Choose a file" label
      $(this).next('.custom-file-label').html(fileName);
  });


});
</script>

@stack('js')
</body>
</html>