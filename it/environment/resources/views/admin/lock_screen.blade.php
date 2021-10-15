<!DOCTYPE html>
<html lang="{{app('l')}}" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ trans('admin.lock_screen') }}</title>
        <!-- Google Font: Source Sans Pro -->
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ url('assets') }}/plugins/fontawesome-free/css/all.min.css">
        <!-- Custom style for RTL -->
        <!-- Theme style -->
        @if(app('l') == 'ar')
        <link rel="stylesheet" href="{{ url('assets') }}/css/adminlte-rtl.css">
        <link rel="stylesheet" href="{{ url('assets') }}/css/custom.css">
        @else
        <link rel="stylesheet" href="{{ url('assets') }}/css/adminlte.css">
        @endif
        @if(!empty(setting()->icon))
        <link rel="shortcut icon" href="{{ it()->url(setting()->icon) }}" />
        @endif
        <link rel="stylesheet" href="{{ url('assets') }}/css/cairo.css">
    </head>
    <body class="hold-transition lockscreen">
        <!-- Automatic element centering -->
        <div class="lockscreen-wrapper">
            <div class="lockscreen-logo">
                <a href="{{ aurl('screen') }}" class="h1">
                    @if(!empty(setting()->logo))
                    <img src="{{it()->url(setting()->logo)}}" alt="{{ setting()->{l('sitename')} }}" style="width:48px;height: 48px" />
                    @else
                    {{ setting()->{l('sitename')} }}
                    @endif
                </a>
            </div>
            <!-- User name -->
            <div class="lockscreen-name">{{ $admin->name }}</div>
            @if(session()->has('error'))
            <div class="alert alert-warning alert-dismissible" dir="{{ app('dir') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <center>
                    <h6>{{ session('error') }}</h6>
                </center>
            </div>
            @endif
            <!-- START LOCK SCREEN ITEM -->
            <div class="lockscreen-item">
                <!-- lockscreen image -->
                <div class="lockscreen-image">
                    @if(!empty($admin->photo_profile))
                    <img src="{{ it()->url($admin->photo_profile) }}" alt="{{ $admin->name }}">
                    @else
                    <img src="{{ url('assets') }}/img/avatar5.png" alt="{{ $admin->name }}">
                    @endif
                </div>
                <!-- /.lockscreen-image -->
                <!-- lockscreen credentials (contains the form) -->
                <form method="post" class="lockscreen-credentials" action="{{ aurl('login') }}">
                    @honeypot
                    <input type="hidden" name="_method" value="POST">
                    {!! csrf_field() !!}
                    <div class="input-group">
                        <input type="hidden" name="email" value="{{ $admin->email }}">
                        <input type="password" name="password" class="form-control" placeholder="{{ trans('admin.password') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn"><i class="fas fa-arrow-right text-muted"></i></button>
                        </div>
                    </div>
                </form>
                <!-- /.lockscreen credentials -->
            </div>
            <!-- /.lockscreen-item -->
            <div class="help-block text-center">
                {{ trans('admin.password_retrieve_session') }}
            </div>
            <div class="text-center">
                <a href="{{ aurl('login') }}">{{trans('admin.or_sign_different_user')}}</a>
            </div>
            <div class="text-center">
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
        </div>
        <!-- /.center -->
        <!-- jQuery -->
        <script src="{{ url('assets') }}/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ url('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>