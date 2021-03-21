</ul>
<!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
<div class="page-content-wrapper">
<!-- BEGIN CONTENT BODY -->
<div class="page-content">
<!-- BEGIN PAGE HEAD-->
<div class="page-head">
	<!-- BEGIN PAGE TITLE -->
	<div class="page-title ">
		<h1>{{!empty($title)?$title:''}}</h1>
	</div>
	<!-- END PAGE TITLE -->
</div>
<!-- END PAGE HEAD-->
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
	@if(!empty(Request::segment(2)))
	<li>
		<a href="{{aurl('/')}}">{{trans('admin.dashboard')}}</a>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<a href="{{aurl(Request::segment(2))}}">{{trans('admin.'.Request::segment(2))}}</a>
		<i class="fa fa-circle"></i>
	</li>
	@endif
	@if(!empty(Request::segment(3)))
	<li>
		<span class="active">{{!empty($title)?$title:''}}</span>
	</li>
	@endif
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE BASE CONTENT -->
@if(count($errors->all()) > 0)
<div class="alert alert-danger">
 <ol>
 	@foreach($errors->all() as $error)
 	 <li>{{ $error }}</li>
 	@endforeach
 </ol>
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">
	<button class="close" data-close="alert"></button>

	<span> {{ session('error') }} </span>
</div>
@endif

@if(session()->has('success'))
<div class="alert alert-success">
	<button class="close" data-close="alert"></button>
	@if(session()->has('success'))
	<span> {{ session('success') }} </span>
	@endif
</div>
@endif