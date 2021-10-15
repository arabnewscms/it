<!DOCTYPE html>
<html lang="{{app('l')}}" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ trans('admin.forgot_password') }}</title>
        <!-- Google Font: Source Sans Pro -->
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ url('assets') }}/plugins/fontawesome-free/css/all.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ url('assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Bootstrap 4 RTL -->
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
        <!-- Custom style for RTL -->
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ url('assets') }}/css/adminlte.min.css">
        @if(!empty(setting()->icon))
        <link rel="shortcut icon" href="{{ it()->url(setting()->icon) }}" />
        @endif
        <link rel="stylesheet" href="{{ url('assets') }}/css/cairo.css">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="{{ aurl('login') }}" class="h1">
                        @if(!empty(setting()->logo))
                        <img src="{{it()->url(setting()->logo)}}" alt="{{ setting()->{l('sitename')} }}" style="width:48px;height: 48px" />
                        @else
                        {{ setting()->{l('sitename')} }}
                        @endif
                    </a>
                    <hr />
                    @if(session()->has('error'))
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h6><i class="icon fas fa-exclamation-triangle"></i> {{ trans('admin.alert') }}!</h6>
                        {{ session('error') }}
                    </div>
                    @else
                    <span> {{ trans('admin.enter_email_to_reset') }} </span>
                    @endif
                     @if(session()->has('success'))

                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h6><i class="icon fas fa-check"></i> {{ trans('admin.success') }}</h6>
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <p class="login-box-msg">{{ trans('admin.forgot_password') }}</p>
                    <form method="post" action="{{ aurl('reset/password') }}">
                        @honeypot
                        {!! csrf_field() !!}
                        <div class="input-group mb-3" dir="{{app('dir')}}">
                            <input type="email" name="email" class="form-control" placeholder="{{ trans('admin.email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-dark btn-block btn-flat">
                                <i class="fas fa-key"></i>
                                {{ trans('admin.reset_password') }}
                                </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <!-- /.social-auth-links -->
                    <br/>
                    <p class="mb-1">
                        <a href="{{ aurl('login') }}">{{ trans('admin.login') }}</a>
                    </p>
                    @if(count(L::all()) > 0)
                    <hr />
                    <center>
                    @php
                    $i = 0;
                    @endphp
                    @foreach(L::all() as $lang)
                    <a style="color:{{ app('l') == $lang?'#c33':'#343a40' }}" href="{{ aurl('lang/'.$lang) }}">{{ trans('admin.'.$lang) }}</a>
                    @php
                    $i++;
                    @endphp
                    {{ $i < count(L::all()) ?'.':'' }}
                    @endforeach
                    </center>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->
        <!-- jQuery -->
        <script src="{{ url('assets') }}/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ url('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ url('assets') }}/js/adminlte.min.js"></script>
    </body>
</html>