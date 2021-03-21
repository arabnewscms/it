@extends('index')
@section('it')


<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready( function () {
    $('.routelist').DataTable();
} );
</script>

<div class="container-fluid">
<div class="row">
<div class="col-xs-12 col-sm-12">
<div class="panel panel-default">
    <div class="bs-callout bs-callout-danger">
        <h4>{{$title}}</h4>
        <hr />
        <div class="tabbable" id="tabs-442449">
            <ul class="nav nav-tabs">
                <li class="nav-item active">
                    <a class="nav-link active" href="#All_Routes" data-toggle="tab"><i class="fa fa-road"></i> All Routes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#GET_Routes" data-toggle="tab"><i class="fa fa-road"></i> GET Routes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#HEAD_Routes" data-toggle="tab"><i class="fa fa-road"></i> HEAD Routes</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#POST_Routes" data-toggle="tab"><i class="fa fa-road"></i> POST Routes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#PUT_Routes" data-toggle="tab"><i class="fa fa-road"></i> PUT Routes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#PATCH_Routes" data-toggle="tab"><i class="fa fa-road"></i> PATCH Routes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#DELETE_Routes" data-toggle="tab"><i class="fa fa-road"></i> DELETE Routes</a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="All_Routes">
                    {!! it_views('route',['name'=>'All Routes','routes'=>$all]) !!}
                </div>
                <div class="tab-pane" id="GET_Routes">
                    {!! it_views('route',['name'=>'GET Routes','routes'=>$all,'in'=>'GET']) !!}
                </div>
                <div class="tab-pane" id="HEAD_Routes">
                    {!! it_views('route',['name'=>'HEAD Routes','routes'=>$all,'in'=>'HEAD']) !!}
                </div>
                <div class="tab-pane" id="POST_Routes">
                    {!! it_views('route',['name'=>'POST Routes','routes'=>$all,'in'=>'POST']) !!}
                </div>
                <div class="tab-pane" id="PUT_Routes">
                    {!! it_views('route',['name'=>'PUT Routes','routes'=>$all,'in'=>'PUT']) !!}
                </div>
                <div class="tab-pane" id="PATCH_Routes">
                    {!! it_views('route',['name'=>'PATCH Routes','routes'=>$all,'in'=>'PATCH']) !!}
                </div>
                <div class="tab-pane" id="DELETE_Routes">
                    {!! it_views('route',['name'=>'DELETE Routes','routes'=>$all,'in'=>'DELETE']) !!}
                </div>
            </div>
        </div>
                    <pre class="prettyprint linenums:1 hidden">
        </pre>
    </div>
</div>
@endsection