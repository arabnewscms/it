<section class="welcome" id="introduction">
    <div class="row" >
        <div class="col-md-12 {{ app('l') == 'en'?'left-align':'' }}" >
            <h2 class="dark-text">{{ it_trans('docs.introduction') }}<hr></h2>
            <div class="row">
                <div class="col-md-12 full">
                    <div class="intro1">
                        <ul>
                            <li><strong>{{ it_trans('docs.package_name') }} : </strong>IT</li>
                            <li><strong>{{ it_trans('docs.package_version') }} : </strong> v {{ it_version() }}</li>
                            <li><strong>{{ it_trans('docs.docs_version') }} : </strong> v {{ it_docs_version() }}</li>
                            <li><strong>{{ it_trans('docs.package_author') }}  : </strong> <a href="https://www.facebook.com/anonym0us.dev" target="_blank">Mahmoud Ibrahim</a></li>
                            <li><strong>{{ it_trans('docs.package_laravel') }}  : </strong> <a href="https://laravel.com/docs/8.x" target="_blank">Laravel {{ it_laravelversion() }}</a></li>
                            <li><strong>{{ it_trans('docs.package_repo') }} : </strong> <a href="https://github.com/arabnewscms/it" target="_blank">https://github.com/arabnewscms/it</a></li>
                            <li><strong>{{ it_trans('docs.package_license') }} : </strong> <a href="https://en.wikipedia.org/wiki/MIT_License" target="_blank">MIT License</a></li>
                        </ul>
                    </div>
                    <hr>
                    <div>
                        <p>{{ it_trans('docs.package_welcome_message') }}
                            <strong>{{ it_trans('docs.you_are_awesome') }}!</strong>
                            <br>
                        </p>
                        <p>{{ it_trans('docs.package_welcome_message_1') }}</p>
                        <h4>{{ it_trans('docs.package_requirements') }}</h4>
                        <p>{{ it_trans('docs.package_requirements_') }}</p>
                        <ol>
                            <li>{{ it_trans('docs.package_php') }}</li>
                            <li>{{  it_trans('docs.package_php_ini') }}
                                <pre class="brush: html; ">
                                     max_input_vars=500000
                                     max_input_time=6000
                                     memory_limit=3000M
                                     max_execution_time=300
                                     post_max_size=2000M
                                     max_file_uploads=200
                                     upload_max_filesize=2000M
                                </pre>
                            </li>
                            <li>
                                {{ it_trans('docs.install_wkhtmltopdf') }}
                                <br />
                                    {{ it_trans('docs.install_tomacosx') }}
                                    {{ it_trans('docs.by_brew') }}
                                <pre class="brush: html; ">
                                     brew install wkhtmltopdf
                                </pre>
                                {{ it_trans('docs.install_tolinux') }}
                                <p>CentOS 8</p>
                                   <pre class="brush: html; ">
                                     sudo yum -y install wget
                                     wget https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox-0.12.6-1.centos8.x86_64.rpm
                                     sudo dnf localinstall wkhtmltox-0.12.6-1.centos8.x86_64.rpm

                                </pre>
                                CentOS 7
                                <pre class="brush: html; ">
                                     wget https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox-0.12.6-1.centos7.x86_64.rpm
                                     sudo yum localinstall wkhtmltox-0.12.6-1.centos7.x86_64.rpm
                                     to test pdf version
                                     wkhtmltopdf --version
                                     wkhtmltopdf 0.12.6 (with patched qt)
                                     to test image
                                     wkhtmltoimage --version
                                     wkhtmltoimage 0.12.6 (with patched qt)
                                </pre>

                            </li>
                        </ol>
                        <div class="intro2 clearfix">
                            <p><i class="fa fa-exclamation-triangle"></i>
                                {!! it_trans('docs.msg_from_developer') !!}.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
</section>