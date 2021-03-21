<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse js-navbar-collapse">
	<ul class="nav navbar-nav navbar-left">
		<a class="navbar-brand" href="{{url('it')}}">
			<img height="20" width="20" src="{{it_des('it/img/it100-100.png')}}" class="img-responsive pull-left" alt="Responsive image">
		</a>
		<li class="dropdown mega-dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				{{it_trans('it.programs')}}
				<span class="caret"></span></a>
				<ul class="dropdown-menu mega-dropdown-menu">
					<li class="col-sm-3">
						<ul>


							<li class="dropdown-header">{{it_trans('it.feat_tools')}}</li>
							<li>
								<a href="{{url('it/routelist')}}"><i class="fa fa-road"></i> {{it_trans('it.routelist')}} </a>
							</li>
							<li><a href="{{url('it/workflow')}}"><i class="fa fa-cog fa-2x"></i> {{it_trans('it.workflow')}}</a></li>
							@if(class_exists('Barryvdh\Elfinder\ElfinderController'))
							<li><a href="{{url('it/merge')}}"><i class="fa fa-cloud fa-2x"></i> {{it_trans('it.merge')}}</a></li>
							@endif

						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">CRUD System (Baboon) Schema Database</li>

							<li>
								<a href="{{url('it/baboon-sd')}}">🙈 {{it_trans('it.baboon-sd')}} </a>
							</li>
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">{{it_trans('it.much_more')}}</li>
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
					</li>
				</ul>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
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
		</ul>
		</div><!-- /.nav-collapse -->