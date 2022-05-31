@extends('index')
@section('it')
	@section('header')
        <!-- jQuery and jQuery UI (REQUIRED) -->
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <!-- elFinder CSS (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="{{ asset($dir.'/css/elfinder.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset($dir.'/css/theme.css') }}">
        <!-- elFinder JS (REQUIRED) -->
        <script src="{{ asset($dir.'/js/elfinder.min.js') }}"></script>
        @if($locale)
            <!-- elFinder translation (OPTIONAL) -->
            <script src="{{ asset($dir."/js/i18n/elfinder.$locale.js") }}"></script>
        @endif
        <!-- elFinder initialization (REQUIRED) -->
        <script type="text/javascript" charset="utf-8">
            // Documentation for client options:
            // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
            $().ready(function() {
                $('#elfinder').elfinder({
                	  width: '100%',
                      height: '730px',
                    // set your elFinder options here
                    @if($locale)
                        lang: '{{ $locale }}', // locale
                    @endif
                    customData: {
                        _token: '{{ csrf_token() }}'
                    },
                    url : '{{ route("elfinder.connector") }}',  // connector URL
                    soundPath: '{{ asset($dir.'/sounds') }}'
                });
            });
        </script>
	@endsection
<div class="container-fluid">
	<div class="row">
			<div class="panel panel-default">
				<div class="bs-callout bs-callout-danger">
					<h4><i class="fa fa-cloud fa-2x"></i> {{$title}}</h4>
					<!-- Element where elFinder will be created (REQUIRED) -->
					<div id="elfinder"></div>
				</div>
			</div>
		<div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-7">
@endsection