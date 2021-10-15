<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>{{!empty($title)?$title:it_trans('it.home')}}</title>
        <meta name="referrer" content="strict-origin" />
        <link href="{{it_des('it/css/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
        <link href="{{url('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet" id="bootstrap-css">
        <link href="{{it_des('it/css/style.css')}}" rel="stylesheet" id="bootstrap-css">
        <!--script src="{{it_des('it/js/jquery-1.11.1.min.js')}}"></script-->
        <script src="{{it_des('it/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{it_des('it/js/bootstrap.min.js')}}"></script>
        <script src="{{it_des('it/js/run_prettify.js')}}"></script>
        <script src="{{it_des('it/js/it.js')}}"></script>
        <link rel="icon" href="{{it_des('it/img/it48-48.png')}}">
        @yield('header')

    </head>
</head>
<body id="page-top" name="page-top" class="active">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="nav-btn btn-dark btn-lg accordion-toggle pull-left" title="Follow Us" role="tab" id="social-collapse" data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fa fa fa-globe"></i>
                </a>
                <a id="menu-toggle" href="#" class="nav-btn btn-dark btn-lg toggle">
                    <i class="fa fa-bars" style="color:#fff;"></i>
                </a>
                <a id="to-top" class="btn btn-lg btn-inverse" href="#top">
                    <span class="sr-only">Toggle to Top Navigation</span>
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
            @include('layouts.menu')
            </div><!-- /.container-fluid -->
        </nav>
        <nav id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <a id="menu-close" href="#" class="btn btn-danger pull-right hidden-md hidden-lg toggle"><i class="fa fa-times"></i></a>
                <li class="sidebar-brand">
                    <a href="#top"><strong>It</strong></a>
                </li>
                <li>
                    <a href="https://it.phpanonymous.com">{{it_trans('it.home_page')}}</a>
                </li>
                <li>
                    <a href="https://it.phpanonymous.com/docs" title="{{it_trans('it.document_online')}}">{{it_trans('it.document_online')}}</a>
                </li>
                <li>
                    <a href="{{url('it/docs')}}" title="{{it_trans('it.document_offline')}}">{{it_trans('it.document_offline')}}</a>
                </li>
                <li>
                    <a href="http://phpanonymous.com" title="phpanonymous">PHP Anonymous</a>
                </li>
                <li>
                    <a data-toggle="modal" data-href="#loginModal" data-target="#loginModal" style="cursor:pointer;">Have Bugs !!</a>
                </li>
            </ul>
        </nav>
        <div class="container">
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
                <div class="modal-dialog modal-default">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3>{{it_trans('it.have_bugs')}}</h3>
                        </div>
                        <div class="modal-body">
                            <article class="container-form center-block">
                                <!-- Form Content HERE! -->
                                This Feature Not Available Right now
                            </article>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark" data-dismiss="modal" data-href="#collapseTwo" data-toggle="collapse" data-target="#collapseTwo" style="cursor:pointer;">{{it_trans('it.send_now')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <aside id="accordion" class="social text-vertical-center">
            <div class="accordion-social">
                <ul class="panel-collapse collapse {{empty(Request::segment(2))?'in':''}} nav nav-stacked" role="tabpanel" aria-labelledby="social-collapse" id="collapseOne">
                    <li><a href="https://www.facebook.com/groups/anonymouses.developers" target="_blank">
                    <i class="fab fa-lg fa-facebook"></i></a></li>
                    <li><a href="https://youtube.com/c/phpanonymous" target="_blank"><i class="fab fa-lg fa-youtube"></i></a></li>
                    <li><a href="https://github.com/arabnewscms/it" target="_blank"><i class="fab fa-lg fa-github"></i></a></li>
                    <li><a href="https://www.facebook.com/groups/anonymouses.developers" target="_blank">
                    <i class="fab fa-lg fa-facebook"></i></a></li>
                    <li><a href="https://phpanonymous.com" target="_blank"><i class="fa fa-lg fa-pager"></i></a></li>
                    <li><a href="https://www.facebook.com/anonym0us.dev" target="_blank"><i class="fab fa-lg fa-facebook-f"></i></a></li>
                </ul>
            </div>
        </aside>

    </div>
</div>