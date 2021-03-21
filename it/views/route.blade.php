<table class="table  table-striped table-bordered table-hover routelist">
	<caption>{{ @$name }}</caption>
	<thead>
		<tr>
			<th>host</th>
			<th>method</th>
			<th>uri</th>
			<th>name</th>
			<th>action</th>
			<th>middleware</th>
		</tr>
	</thead>
	<tbody>
		@if(!empty($routes))
		@foreach($routes as $route)
		@if(empty($in) || is_numeric(array_search($in,$route->methods)))
		<tr>
			<td>
				{{ $route->domain() }}
			</td>
			<td width="10%">
				@if(!empty($in))
				<span class="label
					{{ $in == 'GET'?'label-success':'' }}
					{{ $in == 'HEAD'?'label-default':'' }}
					{{ $in == 'DELETE'?'label-danger':'' }}
					{{ $in == 'PUT'?'label-warning':'' }}
					{{ $in == 'POST'?'label-warning':'' }}
					{{ $in == 'PATCH'?'label-warning':'' }}
					{{ $in == 'OPTION'?'label-primary':'' }}
					">
					{{ $in }}
					</span> &nbsp;
				@else
				@foreach($route->methods as $method)
					<span class="label
					{{ $method == 'GET'?'label-success':'' }}
					{{ $method == 'HEAD'?'label-default':'' }}
					{{ $method == 'DELETE'?'label-danger':'' }}
					{{ $method == 'PUT'?'label-warning':'' }}
					{{ $method == 'POST'?'label-warning':'' }}
					{{ $method == 'PATCH'?'label-warning':'' }}
					{{ $method == 'OPTION'?'label-primary':'' }}
					">
					{{ $method }}
					</span>&nbsp;
				@endforeach
				@endif
			</td>
			<td width="20%">
				{{ $route->uri }}
			</td>
			<td>
				{{ $route->getName() }}
			</td>
			<td>
				{{ $route->getActionName() }}
			</td>
			<td width="15%">
				{{ implode(' | ', $route->action['middleware']) }}
			</td>
		</tr>
		@endif
		@endforeach
		@endif
	</tbody>
</table>
