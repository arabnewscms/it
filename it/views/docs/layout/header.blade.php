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
    </script>
       <div id="wrapper">
        <div class="container">