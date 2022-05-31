<section id="getting_started" class="section">
    <div class="row">
        <div class="col-md-12 left-align">
            <h2 class="dark-text">{{ it_trans('docs.Getting_Started') }} <hr></h2>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-md-12">
            <p>{{ it_trans('docs.set_your_scaffolding_setting') }}</p>
            <h4>{{ it_trans('docs.package_installed') }}</h4>
            <pre class="brush: html; highlight: [1,3,5,7,9,11,13,15,17,19,21]">
                    "barryvdh/laravel-snappy"
                    "dompdf/dompdf"
                    "fideloper/proxy"
                    "fruitcake/laravel-cors"
                    "guzzlehttp/guzzle"
                    "intervention/image"
                    "langnonymous/lang"
                    "laravelcollective/html"
                    "maatwebsite/excel"
                    "mpdf/mpdf"
                    "phpanonymous/c3js"
                    "phpanonymous/it"
                    "spatie/laravel-honeypot"
                    "tecnickcom/tcpdf"
                    "tymon/jwt-auth"
                    "unisharp/laravel-filemanager"
                    "yajra/laravel-datatables-buttons"
                    "yajra/laravel-datatables-editor"
                    "yajra/laravel-datatables-fractal"
                    "yajra/laravel-datatables-html"
                    "yajra/laravel-datatables-oracle"
            </pre>
            <p>{{ it_trans('docs.install_auth_types') }}</p>
            <pre class="brush: html">
                    php artisan ui:auth --views
                    php artisan ui:auth
                    php artisan ui bootstrap --auth
                    php artisan ui vue --auth
                    php artisan ui react --auth
            </pre>
            <p>{{ it_trans('docs.extract_admin_info') }}</p>
            <pre class="brush: html">
                    php artisan migrate
                    php artisan db:seed
            </pre>
            <a href="{{ url('admin') }}" target="_blank">{{ it_trans('docs.go_to_admin_panel') }} {{ url('admin') }}</a>
            <p>
                {{ trans('admin.email') }}: test@test.com <br />
                {{ trans('admin.password') }}: 123456
            </p>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</section>
<!-- end section -->