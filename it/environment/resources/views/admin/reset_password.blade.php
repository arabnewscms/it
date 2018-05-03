<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{app('l')}}" dir="{{app('dir')}}">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>{{ trans('admin.reset_password') }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/bootstrap/css/bootstrap{{app('direction')}}.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/plugins/bootstrap-switch/css/bootstrap-switch{{app('direction')}}.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{url('design/admin_panel')}}/assets/global/css/components{{app('direction')}}.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{url('design/admin_panel')}}/assets/global/css/plugins{{app('direction')}}.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{url('design/admin_panel')}}/assets/pages/css/login{{app('direction')}}.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <!-- END HEAD -->
    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="{{ aurl('login') }}">
            <img src="{{url('design/admin_panel')}}/assets/pages/img/logo-big.png" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-forms"  method="post">
                {!! csrf_field() !!}
                <h3 class="form-title font-green">{{ trans('admin.reset_password') }}</h3>
                <div class="alert alert-danger
                {{ session()->has('error') || count($errors) > 0?'':'display-hide' }}

                ">
                    <button class="close" data-close="alert"></button>

                    @if(session()->has('error'))
                    <span> {{ session('error') }} </span>
                    @elseif(!empty($errors->all()) && count($errors->all()) > 0)
                    <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                    @elseif(empty($errors) && !session()->has('error'))
                    <span> {{ trans('admin.enter_email_and_password') }} </span>
                    @endif
                </div>
                <div class="alert alert-success {{ session()->has('success')?'':'display-hide' }} ">
                    <button class="close" data-close="alert"></button>
                    @if(session()->has('success'))
                    <span> {{ session('success') }} </span>
                    @endif
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">{{ trans('admin.email') }}</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="{{ trans('admin.email') }}" value="{{ $token->email }}" name="email" /> </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">{{ trans('admin.password') }}</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="{{ trans('admin.password') }}" name="password" />
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">{{ trans('admin.password_confirmation') }}</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="{{ trans('admin.password_confirmation') }}" name="password_confirmation" />
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn green uppercase">{{ trans('admin.change_password') }}</button>
                        <label class="rememberme check mt-checkbox mt-checkbox-outline">
                            <input type="checkbox" name="andlogin" value="1" />{{ trans('admin.andlogin') }}
                            <span></span>
                        </label>
                    </div>
                </form>
                <!-- END LOGIN FORM -->
                <!-- BEGIN FORGOT PASSWORD FORM -->
                <!-- END FORGOT PASSWORD FORM -->
            </div>
            <div class="copyright">
<?php $i = 0;?>
@foreach(L::all() as $lang)
                <a style="color:{{ app('l') == $lang?'#c33':'#fff' }}" href="{{ aurl('lang/'.$lang) }}">{{ trans('admin.'.$lang) }}</a>
<?php $i++;?>
                {{ $i < count(L::all()) ?'.':'' }}
                @endforeach
                <br />
                <bdi> 2014 © Metronic. Admin Dashboard Template & <a href="http://phpanonymous.com/it" target="_blank">Deployed By It Version 1.0</a>  </bdi></div>
                <!--[if lt IE 9]>
                <script src="{{url('design/admin_panel')}}/assets/global/plugins/respond.min.js"></script>
                <script src="{{url('design/admin_panel')}}/assets/global/plugins/excanvas.min.js"></script>
                <![endif]-->
                <!-- BEGIN CORE PLUGINS -->
                <script src="{{url('design/admin_panel')}}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
                <script src="{{url('design/admin_panel')}}/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
                <script src="{{url('design/admin_panel')}}/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
                <script src="{{url('design/admin_panel')}}/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
                <script src="{{url('design/admin_panel')}}/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
                <script src="{{url('design/admin_panel')}}/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
                <!-- END CORE PLUGINS -->
                <!-- BEGIN PAGE LEVEL PLUGINS -->
                <script src="{{url('design/admin_panel')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
                <script src="{{url('design/admin_panel')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
                <script src="{{url('design/admin_panel')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
                <!-- END PAGE LEVEL PLUGINS -->
                <!-- BEGIN THEME GLOBAL SCRIPTS -->
                <script src="{{url('design/admin_panel')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
                <!-- END THEME GLOBAL SCRIPTS -->
                <!-- BEGIN PAGE LEVEL SCRIPTS -->
                <script src="{{url('design/admin_panel')}}/assets/pages/scripts/login.min.js" type="text/javascript"></script>
                <!-- END PAGE LEVEL SCRIPTS -->
                <!-- BEGIN THEME LAYOUT SCRIPTS -->
                <!-- END THEME LAYOUT SCRIPTS -->
            </body>
        </html>