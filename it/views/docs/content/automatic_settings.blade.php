<section id="automatic_settings" class="section">
    <div class="row">
        <div class="col-md-12 left-align">
            <h2 class="dark-text">{{ it_trans('docs.automatic_settings') }} <hr></h2>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-md-12">
            <p>{{ it_trans('docs.automatic_settings_info') }}</p>
            <h4>{{ it_trans('docs.environment_structure') }}</h4>
            <p>{{ it_trans('docs.folder_files') }}</p>
            <div dir="ltr" style="height:500px;overflow:auto">
                <ol>
                    <li>
                        - app
                        <ol>
                            <li>-- DataTables</li>
                            <li>-- Exceptions
                                <ol>
                                    <li>-- Handler.php</li>
                                </ol>
                            </li>
                            <li>-- Handlers
                                <ol>
                                    <li>-- LfmConfigHandler.php</li>
                                </ol>
                            </li>
                            <li>- Http
                                <ol>
                                    <li>
                                        -- Controllers
                                        <ol>
                                            <li>-- Admin
                                                <ol>
                                                    <li>-- AdminAuthenticated.php</li>
                                                    <li>-- AdminGroups.php</li>
                                                    <li>-- Admins.php</li>
                                                    <li>-- Dashboard.php</li>
                                                    <li>-- Settings.php</li>
                                                </ol>
                                            </li>
                                            <li>-- Api
                                                <ol>
                                                    <li>-- AuthApiLoggedIn.php</li>
                                                </ol>
                                            </li>
                                            <li>-- Validations
                                                <ol>
                                                    <li>-- AdminGroupsRequest.php</li>
                                                    <li>-- AdminsRequest.php</li>
                                                </ol>
                                            </li>
                                            <li>-- FileUploader.php</li>
                                        </ol>
                                        <li>-- Middleware
                                            <ol>
                                                <li>-- AdminAutenticated.php</li>
                                                <li>-- AdminGuest.php</li>
                                                <li>-- AdminRole.php</li>
                                                <li>-- ApiLang.php</li>
                                            </ol>
                                        </li>
                                    </li>
                                </ol>
                            </li>
                            <li>-- AdminRouteList.php</li>
                            <li>-- Kernel.php</li>
                            <li>-- Mail
                                <ol>
                                    <li>-- AdminResetPassword.php</li>
                                </ol>
                            </li>
                            <li>-- Models
                                <ol>
                                    <li>-- Admin.php</li>
                                    <li>-- AdminGroup.php</li>
                                    <li>-- AdminGroupRole.php</li>
                                    <li>-- Files.php</li>
                                    <li>-- Setting.php</li>
                                    <li>-- User.php</li>
                                </ol>
                            </li>
                            <li>-- Providers
                                <ol>
                                    <li>-- AppServiceProvider.php</li>
                                    <li>-- ExtraValidations.php</li>
                                    <li>-- RouteServiceProvider.php</li>
                                </ol>
                            </li>
                        </ol>
                    </li>
                    <li>- config
                        <ol>
                         <li>-- auth.php</li>
                         <li>-- cors.php</li>
                         <li>-- datatables-buttons.php</li>
                         <li>-- datatables-fractal.php</li>
                         <li>-- datatables-html.php</li>
                         <li>-- elfinder.php</li>
                         <li>-- excel.php</li>
                         <li>-- filesystems.php</li>
                         <li>-- honeypot.php</li>
                         <li>-- image.php</li>
                         <li>-- itconfiguration.php</li>
                         <li>-- jwt.php</li>
                         <li>-- langnonymous.php</li>
                         <li>-- lfm.php</li>
                         <li>-- logging.php</li>
                         <li>-- session.php</li>
                         <li>-- snappy.php</li>
                        </ol>
                    </li>
                    <li>- database
                        <ol>
                            <li>-- migrations
                                <ol>
                                    <li>-- 2014_10_12_000000_create_users_table.php</li>
                                    <li>-- 2014_10_12_100000_create_password_resets_table.php</li>
                                    <li>-- 2019_08_19_000000_create_failed_jobs_table.php</li>
                                    <li>-- 2019_10_19_094109_create_admins_table.php</li>
                                    <li>-- 2019_10_19_102130_create_files_table.php</li>
                                    <li>-- 2019_10_19_985759_create_settings_table.php</li>
                                    <li>-- 2021_03_22_134182_create_admin_groups_table.php</li>
                                    <li>-- 2021_03_22_193126_create_admin_group_roles_table.php</li>
                                </ol>
                            </li>
                            <li>- seeders
                                <ol>
                                    <li>-- DatabaseSeeder.php</li>
                                </ol>
                            </li>
                        </ol>

                    </li>
                    <li>- public
                        <ol>
                            <li>-- design</li>
                            <li>-- js</li>
                            <li>-- css</li>
                            <li>-- it_des</li>
                            <li>-- vendor</li>
                        </ol>
                    </li>
                    <li>- resources
                        <ol>
                            <li>-- lang
                                <ol>
                                    <li>-- ar
                                        <ol>
                                            <li>-- admin.php</li>
                                            <li>-- pagination.php</li>
                                            <li>-- validation.php</li>
                                        </ol>
                                    </li>
                                    <li>-- en
                                        <ol>
                                            <li>-- admin.php</li>
                                            <li>-- pagination.php</li>
                                            <li>-- validation.php</li>
                                        </ol>
                                    </li>
                                    <li>-- fr
                                        <ol>
                                            <li>-- admin.php</li>
                                            <li>-- pagination.php</li>
                                            <li>-- validation.php</li>
                                        </ol>
                                    </li>

                                </ol>
                            </li>
                            <li>- views
                                <ol>
                                    <li>-- admin*</li>
                                    <li>-- errors*</li>
                                    <li>-- vendor*</li>
                                    <li>-- welcome.blade.php</li>
                                </ol>
                            </li>
                        </ol>
                    </li>
                    <li>- routes
                        <ol>
                            <li>-- admin.php</li>
                            <li>-- api.php</li>
                            <li>-- configurations.php</li>
                            <li>-- web.php</li>
                        </ol>
                    </li>
                </ol>
            </div>
            <p>{{ it_trans('docs.automatic_settings_last') }}</p>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</section>
<!-- end section -->