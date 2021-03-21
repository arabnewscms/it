<details dir="ltr">
	<summary>
		<b>
			Copy Route Code Here <i class="fa fa-code"></i>
		</b>
	</summary>

	<code style="width:100%;min-height: 300px;float: left;" dir="ltr">
// Remember Add This in your htaccess File In Project To Protect Env File<br>
# Disable index view<br>
Options -Indexes<br>
<br>
# Hide a specific file
<br>
{{'
<Files .env>
    Order allow,deny
    Deny from all
</Files>

'}}
<br>
 {{' Route::group([\'middleware\'=>[\'admin\'],\'prefix\'=>app(\'admin\')],function(){ '}}
<br>


<br>
<?php
$link   = strtolower(preg_replace('/Controller|controller/i', '', $r->input('controller_name')));
$link2  = '{{Set::active(\''.$link.'\',\'active open\')}} ';
$link3  = '{{Set::active(\'\',\'block\')}}';
$link4  = '{{Set::active(\''.$link.'\',\'open\')}}';
$link5  = '{{trans(\''.$r->input('lang_file').'.'.$link.'\')}} ';
$urlurl = '{{url(app(\'set\')->admin_path.\'/'.$link.'\')}}';
$ttitle = '{{trans(\''.$r->input('lang_file').'.'.$link.'\')}} ';
$create = '{{trans(\''.$r->input('lang_file').'.create\')}} ';
?>
 {{' Route::resource(\''.$link.'\',\''.$r->input('controller_name').'\'); '}}
 {{' Route::post(\''.$link.'/multi_delete\',\''.$r->input('controller_name').'@multi_delete\'); '}}
<br>


{{' }); '}}
// Menu Link<br>
/*
<br>

   {{'<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">'}}<br><br>
{{'<li class="nav-item start '.$link2.'">'}}<br>
&nbsp;
{{' <a href="javascript:;" class="nav-link nav-toggle">'}}<br>
{{'   <i class="icon-list"></i>'}}<br>
&nbsp;
{{' <span class="title">'.$link5.'</span>'}}<br>
{{'<span class="selected"></span>'}}<br>
{{'<span class="arrow '.$link4.'"></span>'}}<br>
{{'</a>'}}<br>
{{' <ul class="sub-menu" style="'.$link3.'"> '}}<br>
{{'  <li class="nav-item start '.$link2.' "> '}}<br>
{{' <a href="'.$urlurl.'" class="nav-link "> '}}<br>
{{'    <i class="icon-list"></i>'}}<br>
{{' <span class="title">'.$ttitle.' </span>'}}<br>
{{' <span class="selected"></span>'}}<br>
{{' </a>'}}<br>

&nbsp;
{{'</li> '}}<br>
{{'  <li class="nav-item start"> '}}<br>
{{' <a href="'.$urlurl.'/create" class="nav-link "> '}}<br>
{{' <i class="icon-list"></i> '}}<br>
{{' <span class="title"> '.$create.' </span> '}}<br>
{{' <span class="selected"></span> '}}<br>
{{' </a> '}}<br>
&nbsp;
{{' </li> '}}<br>
&nbsp;
{{'</ul> '}}<br>
&nbsp;
{{' </li> '}}<br>

	<br>
*/
<br>

</code>
</details>