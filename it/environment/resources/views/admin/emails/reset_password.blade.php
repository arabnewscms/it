@component('mail::message')

<center>
	 <p><bdi>{{ trans('admin.welcome',['name'=>$data['data']->name]) }}</bdi></p><br>
{{ trans('admin.here_reset_link') }}

@component('mail::button', ['url' => $data['url']])
{{ trans('admin.reset_link_here') }}
@endcomponent

<h1>
<center>{{ trans('admin.or') }}</center>
</h1>,
{{ trans('admin.copy_reset_link') }}
<a href="{{ $data['url'] }}">
	{{ $data['url'] }}
</a>


{{ trans('admin.thanks') }},<br>
{{ config('app.name') }}

</center>
@endcomponent
