<nav class="docs-sidebar" data-spy="affix" data-offset-top="300" data-offset-bottom="200" role="navigation">
    <center>
    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"  width="50.000000pt" height="50.000000pt" viewBox="0 0 100.000000 100.000000"  preserveAspectRatio="xMidYMid meet">  <g
        style="fill: rgb(255, 255, 255); transition: all 2s ease 0s;"
    transform="translate(0.000000,100.000000) scale(0.050000,-0.050000)" class="logoit" fill="#ef3b2d" stroke="none"> <path d="M514 1484 l-494 -494 310 -310 310 -310 0 465 c0 256 3 465 7 465 4 0 35 -10 68 -21 42 -15 85 -15 133 -2 l72 20 0 -605 c0 -605 0 -605 46 -648 l46 -43 198 199 c183 184 195 200 144 200 -89 0 -205 70 -241 147 -28 60 -33 158 -33 718 0 868 60 845 -566 219z m386 116 c99 -99 18 -280 -124 -280 -131 0 -206 179 -115 276 54 58 183 60 239 4z"></path> <path d="M1360 1520 l0 -100 104 0 104 0 -98 100 c-54 55 -101 100 -104 100 -3 0 -6 -45 -6 -100z"></path> <path d="M1360 973 c0 -530 63 -561 415 -208 l225 226 -155 154 -156 155 -164 0 -165 0 0 -327z"></path> </g> </svg>
    </center>
    <ul class="nav">
        <li><a href="#introduction">{{ it_trans('docs.introduction') }}</a></li>
        <li><a href="#getting_started">{{ it_trans('docs.Getting_Started') }}</a></li>
        <li><a href="#automatic_settings">{{ it_trans('docs.automatic_settings') }}</a></li>
        <li><a href="#routelist">{{ it_trans('docs.routelist') }}</a></li>
        <li><a href="#workflow">{{ it_trans('docs.workflow') }}</a></li>
        <li><a href="#baboon">{{ it_trans('docs.baboon') }}</a>
        <ul class="nav">
            <li><a href="#baboon_1">{{ it_trans('docs.what_is_baboon') }}</a></li>
            <li><a href="#baboon_2">{{ it_trans('docs.Initialize_CRUD') }}</a></li>
            <li><a href="#baboon_3">{{ it_trans('docs.Language_Other') }}</a></li>
            <li><a href="#baboon_4">{{ it_trans('docs.Columns_Inputs') }}</a></li>
            <li><a href="#baboon_5">{{ it_trans('docs.Relation_Models') }}</a></li>
        </ul>
        <li><a href="#create_crud">{{ it_trans('docs.create_demo_crud') }}</a>
        <ul class="nav">
            <li><a href="#create_crud_1">1 - {{ it_trans('docs.create_demo_crud_init') }}</a></li>
            <li><a href="#create_crud_2">2 - {{ it_trans('docs.create_demo_crud_language_lango') }}</a></li>
            <li><a href="#create_crud_3">3 - {{ it_trans('docs.create_demo_crud_input_columns') }}</a></li>
        </ul>
    </li>

    {{-- <li><a href="#line9">Files & Sources</a></li>
    <li><a href="#line10">Version History (Changelog)</a></li>
    <li><a href="#line11">Copyright and license</a></li> --}}
</ul>
<div>
    <center>Back To</center>
    <p><a href="{{ url('it') }}">IT</a>,<a href="{{ url('it/baboon-sd') }}">Baboon Maker</a></p>

</div>
<div class="col-md-12">
    <p>الوثائق متاحة باللغة العربية حاليا ونعمل على انشاء النسخة الانجليزية قريبا نقدر لك  صبرك - هذه الوثائق تجريبية</p>
    <p>{{ it_trans('docs.package_version') }} {{ it_version() }} <br> {{ it_trans('docs.docs_version') }} {{ it_docs_version() }}</p>
</div>
</nav >