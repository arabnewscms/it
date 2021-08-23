<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse js-navbar-collapse">
	<ul class="nav navbar-nav navbar-left">
		<li class="nav-item">
			<a class="navbar-brand" href="{{url('it')}}">
			@include('layouts.logo')
		</a>
		</li>
		<li class="nav-item baboon_monkey">
			<a href="{{url('it/baboon-sd')}}">
				<i>&#128018;</i>
				{{it_trans('it.baboon-sd')}}
			</a>
		</li>
		<li class="nav-item">
			<a href="{{url('it/routelist')}}"><i class="fa fa-route"></i> {{it_trans('it.routelist')}} </a>
		</li>
		<li class="nav-item">
			<a href="{{url('it/workflow')}}"><i class="fa fa-cog "></i> {{it_trans('it.workflow')}}</a></li>
		@if(class_exists('Barryvdh\Elfinder\ElfinderController'))
		<li class="nav-item"><a href="{{url('it/merge')}}"><i class="fa fa-cloud "></i> {{it_trans('it.merge')}}</a></li>
		@endif
		<li class="nav-item">
			<a data-toggle="modal" data-href="#loginModal" data-target="#loginModal" style="cursor:pointer;">
			<i class="fa fa-bug"></i>
			Have Bugs !!
			</a>
		</li>
		<li class="nav-item">
			<a href="{{url('it/docs')}}" title="{{it_trans('it.document_offline')}}">
				<i class="fa fa-newspaper"></i>
				{{it_trans('it.document_offline')}}
			</a>
		</li>
		<li class="nav-item">
			<a href="#" data-toggle="modal" data-target="#donate" title="donate">
				<i style="font-size:20px">&#9749;</i>&nbsp; {{ it_trans('it.donate') }}
			</a>
		</li>
		<li>
			<a href="#" onclick="darkmode()">
				<i class="fa fa-lightbulb"></i>
			Dark Mode</a>
		</li>

	</ul>
	{{-- <ul class="nav navbar-nav navbar-right">
		<li class="dropdown hidden">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My account <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li class="divider"></li>
				<li><a href="#">Separated link</a></li>
			</ul>
		</li>
	</ul> --}}
	</div><!-- /.nav-collapse -->