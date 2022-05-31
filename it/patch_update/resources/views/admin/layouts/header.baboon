<!DOCTYPE html>
<html lang="{{ app('l') }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{!empty($title)?$title:trans('admin.dashboard')}}</title>
    <!-- shortcut icon -->
    @if(!empty(setting()->icon))
    <link rel="shortcut icon" href="{{ it()->url(setting()->icon) }}" />
    @endif
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('assets') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ url('assets') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('assets') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ url('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- bootstrap-colorpicker Bootstrap 4 -->
    <link rel="stylesheet" href="{{ url('assets') }}/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- daterangepicker Bootstrap 4 -->
    <link rel="stylesheet" href="{{ url('assets') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min{{ app('l') == 'ar'?'-rtl':'' }}.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ url('assets') }}/plugins/jqvmap/jqvmap.min.css">
    <!-- DataTable Css bootstrap -->
    <link href="{{ url("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ url("assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ url("assets/plugins/datatables-colreorder/css/colreorder.bootstrap4.min.css") }}" rel="stylesheet" type="text/css" />
    @if(app("l") == 'ar')
    <link href="{{ url("assets/plugins/datatables-bs4/css/datatables.bootstrap-rtl.css") }}" rel="stylesheet" type="text/css" />
    @endif
    <!-- DataTable Css bootstrap End -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <!-- Theme style -->
    @if(app('l') == 'ar')
    <link rel="stylesheet" href="{{ url('assets') }}/css/adminlte-rtl.css">
    @else
    <link rel="stylesheet" href="{{ url('assets') }}/css/adminlte.css">
    @endif
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('assets') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('assets') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- Video.js base CSS -->
    <link href="https://unpkg.com/video.js@7/dist/video-js.min.css" rel="stylesheet">
    <!-- City -->
    <link href="https://unpkg.com/@videojs/themes@1/dist/city/index.css" rel="stylesheet">
    <!-- Fantasy -->
    <link href="https://unpkg.com/@videojs/themes@1/dist/fantasy/index.css" rel="stylesheet">
    <!-- Forest -->
    <link href="https://unpkg.com/@videojs/themes@1/dist/forest/index.css" rel="stylesheet">
    <!-- Sea -->
    <link href="https://unpkg.com/@videojs/themes@1/dist/sea/index.css" rel="stylesheet">
    @if(app('l') == 'ar')
    <!-- Bootstrap 4 RTL -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <!-- Custom style for RTL -->
    <link rel="stylesheet" href="{{ url('assets') }}/css/custom.css">
    @endif
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ url('assets') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ url('assets') }}/plugins/toastr/toastr.min.css">
    <!-- Cairo Font -->
    <link rel="stylesheet" href="{{ url('assets') }}/css/cairo.css">
    <style type="text/css">
    .buttons-print{
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    border-radius: 0;
    }
    .buttons-excel,.buttons-csv{
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
    border-radius: 0;
    }
    .buttons-pdf,.deleteBtn{
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
    border-radius: 0;
    }
    .buttons-reload{
    color: #fff;
    background-color: #17a2b8;
    border-color: #17a2b8;
    border-radius: 0;
    }
    .table-responsive{
    min-height: 400px;
    }
    </style>
    @stack('css')
    <!-- jQuery -->
{{-- <script src="{{url('assets/plugins/jquery/jquery.min.js')}}" type="text/javascript"></script> --}}
<script src="{{url('assets/js/jquery.min.js')}}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{url('assets/plugins/dropzone/min/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/plugins/dropzone/min/basic.css')}}">
  </head>
 <body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
    <div class="wrapper">