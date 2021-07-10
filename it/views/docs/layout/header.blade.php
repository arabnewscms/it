<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="{{ app('l') }}" dir="{{ app('dir') }}"  class="dark">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{{ it_trans('docs.title',['v'=>it_version()]) }}</title>
    <link rel="shortcut icon" href="{{it_des('it/img/it48-48.png')}}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{ it_des('docs/fonts/font-awesome-4.3.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ it_des('docs/css/stroke.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ it_des('docs/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ it_des('docs/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ it_des('docs/css/prettyPhoto.css') }}">
    @if(app('l') == 'ar')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="{{ it_des('docs/css/style-ar.css') }}">

    @else
    <link rel="stylesheet" type="text/css" href="{{ it_des('docs/css/style.css') }}">
    @endif
    <link rel="stylesheet" type="text/css" href="{{ it_des('docs/js/syntax-highlighter/styles/shCore.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ it_des('docs/js/syntax-highlighter/styles/shThemeRDark.css') }}" media="all">

    <!-- CUSTOM -->
    <link rel="stylesheet" type="text/css" href="{{ it_des('docs/css/custom.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <button onclick="topFunction()" id="gotop" title="Go to top"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
    <script src="{{ it_des('docs/js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        var mybutton = document.getElementById("gotop");
        window.onscroll = function() {scrollFunction()};
        function scrollFunction() {
            if (document.body.scrollTop > 1000 || document.documentElement.scrollTop > 1000) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        function topFunction() {
            window.scrollTo({ top: 0, behavior: 'smooth' })
            document.documentElement.scrollTo({ top: 0, behavior: 'smooth' })
        }

       $(document).ready(function(){
        $(document).on('click','#mode',function(){
            document.querySelector('html').classList.toggle('dark');
             if($('html').hasClass('dark')){
                 $('.logoit').attr('style','fill: rgb(255, 255, 255); ');
                }else{
                 $('.logoit').attr('style','fill: rgb(90,90,90); ');
                }
        });
       });
    </script>
       <div id="wrapper">
        <div id="mode" >
            <div class="dark">
                <svg aria-hidden="true" viewBox="0 0 512 512">
                    <title>lightmode</title>
                    <path fill="currentColor" d="M256 160c-52.9 0-96 43.1-96 96s43.1 96 96 96 96-43.1 96-96-43.1-96-96-96zm246.4 80.5l-94.7-47.3 33.5-100.4c4.5-13.6-8.4-26.5-21.9-21.9l-100.4 33.5-47.4-94.8c-6.4-12.8-24.6-12.8-31 0l-47.3 94.7L92.7 70.8c-13.6-4.5-26.5 8.4-21.9 21.9l33.5 100.4-94.7 47.4c-12.8 6.4-12.8 24.6 0 31l94.7 47.3-33.5 100.5c-4.5 13.6 8.4 26.5 21.9 21.9l100.4-33.5 47.3 94.7c6.4 12.8 24.6 12.8 31 0l47.3-94.7 100.4 33.5c13.6 4.5 26.5-8.4 21.9-21.9l-33.5-100.4 94.7-47.3c13-6.5 13-24.7.2-31.1zm-155.9 106c-49.9 49.9-131.1 49.9-181 0-49.9-49.9-49.9-131.1 0-181 49.9-49.9 131.1-49.9 181 0 49.9 49.9 49.9 131.1 0 181z"></path>
                </svg>
            </div>
            <div class="light">
                <svg aria-hidden="true" viewBox="0 0 512 512">
                    <title>darkmode</title>
                    <path fill="currentColor" d="M283.211 512c78.962 0 151.079-35.925 198.857-94.792 7.068-8.708-.639-21.43-11.562-19.35-124.203 23.654-238.262-71.576-238.262-196.954 0-72.222 38.662-138.635 101.498-174.394 9.686-5.512 7.25-20.197-3.756-22.23A258.156 258.156 0 0 0 283.211 0c-141.309 0-256 114.511-256 256 0 141.309 114.511 256 256 256z"></path>
                </svg>
            </div>
        </div>
        <div class="container">