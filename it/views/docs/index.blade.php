@include('docs.layout.header')
@include('docs.layout.navbar')
<div class="row">
    <div class="col-md-3">
        @include('docs.layout.menu_side')


    </div>
    <div class="col-md-9">
        @include('docs.content.Introduction')
        @include('docs.content.getting_started')
        @include('docs.content.automatic_settings')
        @include('docs.content.routelist')
        @include('docs.content.workflow')
        @include('docs.content.baboon.index')
    </div>
    <!-- // end .col -->
</div>
<!-- // end .row -->
@include('docs.layout.footer')