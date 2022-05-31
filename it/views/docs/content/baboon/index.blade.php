<section id="baboon" class="section">
    <div class="row">
        <div class="col-md-12 left-align">
            <h2 class="dark-text">{{ it_trans('docs.baboon') }} <hr></h2>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-md-12" style="min-height:900px">
            <h4 id="baboon_1">{{ it_trans('docs.what_is_baboon') }}</h4>
            <p>{{ it_trans('docs.what_is_baboon_') }}.</p>
            <p>{{ it_trans('docs.Initialize_CRUD') }}</p>
            <p>{{ it_trans('docs.Language_Other') }}</p>
            <p>{{ it_trans('docs.Columns_Inputs') }}</p>
            <p>{{ it_trans('docs.Relation_Models') }}</p>
            <a href="{{ url('it/baboon-sd') }}" target="_blank">{{ it_trans('docs.click_here') }} {{ url('it/baboon-sd') }}</a>
            <p>{{ it_trans('docs.youcanedit_module') }}</p>
            <p></p>
            <p></p>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-md-12" style="min-height:900px">
            <h4 id="baboon_2">{{ it_trans('docs.Initialize_CRUD') }}</h4>
            <p>{!! it_trans('docs.Initialize_CRUD_') !!}</p>
            <img src="{{ url('it_des/docs/images/upload/Initialize_CRUD.png') }}" style="width:100%">
            <hr />
            <p>{!! it_trans('docs.playlist_') !!}</p>
            <div class="intro1">
            <ol>
                <li><a href="https://www.youtube.com/playlist?list=PLcfD4HARQRF-zd0Kue0q8OTpS7f7j0J5B" target="_blank">IT Application - Course</a></li>
                <li><a href="https://www.youtube.com/playlist?list=PLcfD4HARQRF_Jo2gdldaiUbh29EzaMqlt" target="_blank">IT package v1.3 with Laravel 6.x</a></li>
                <li><a href="https://www.youtube.com/playlist?list=PLcfD4HARQRF_IgXv2MSFGbSYqdQNFj9Wu" target="_blank">IT package version 1.5.x with laravel 8.x</a></li>
            </ol>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-md-12" style="min-height:900px">
            <h4 id="baboon_3">{{ it_trans('docs.Language_Other') }}</h4>
            <p>{!! it_trans('docs.Language_Other_') !!}</p>
             <img src="{{ url('it_des/docs/images/upload/Language_Other.png') }}" style="width:100%">
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-md-12" style="min-height:900px">
            <h4 id="baboon_4">{{ it_trans('docs.Columns_Inputs') }}</h4>
            <p>{!! it_trans('docs.Columns_Inputs_') !!}</p>
            <img src="{{ url('it_des/docs/images/upload/Columns_Inputs.png') }}" style="width:100%">

        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-md-12" style="min-height:900px">
            <h4 id="baboon_5">{{ it_trans('docs.Relation_Models') }}</h4>
            <p>{!! it_trans('docs.Relation_Models_') !!}</p>
                output relation like
            <pre class="brush: html;" dir="ltr">

            public function user_id
            (){
            return $this->hasOne(\App\Models\User::class,"id","user_id");
            }
            </pre>
            <img src="{{ url('it_des/docs/images/upload/Relation_Models.png') }}" style="width:100%">
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->



</section>
<!-- end section -->
  @include('docs.content.baboon.create_demo_crud')