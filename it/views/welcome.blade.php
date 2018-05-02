@extends('index')
@section('it')


<div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-7">

          <div class="panel panel-default">
                        <div class="bs-callout bs-callout-danger">
                            <h4>{{it_trans('it.welcome')}}</h4>
                            <p>
                               	{{it_trans('it.welcome')}}
							{{it_version()}}

							  <blockquote>
                                 <b>Note: </b> 	Choose program in tools dropdown
                                </blockquote>

                            </p>
                            <p>



<pre class="prettyprint linenums:1">
Test Line<br>
Test Line<br>
</pre>
                            </p>
                            <p> </p>
                        </div>
                    </div>





@endsection