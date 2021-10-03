@extends('index')
@section('it')
<link href="{{it_des('it/css/baboon.css')}}" rel="stylesheet" id="bootstrap-css">
@include('baboon.bundel_js')

<form method="post" id="baboon">
  <input type="hidden" name="_token" value="{{csrf_token()}}" />
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 baboon-tab-container">
    <div class="alert alert-danger messages_baboon hidden"></div>
    <div class="alert alert-success success_message hidden"></div>
    <div class="tabbable" id="tabs-114052">
      <ul class="nav nav-tabs">
        <li class="nav-item active">
          <a class="nav-link" href="#panel-info" aria-expanded="true" data-toggle="tab">
            <h4 class="fa fa-layer-group"></h4>
          <b>Init</b> CRUD-info</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#panel-language" data-toggle="tab">
            <h4 class="fa fa-language "></h4>
          Language & Other</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#panel-columns" data-toggle="tab">
            <h4 class="fa fa-border-all"></h4>
          Inputs & columns</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#panel-relations" data-toggle="tab">
            <h4 class="fa fa-database "></h4>
          Relations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#panel-datatable" data-toggle="tab">
            <h4 class="fa fa-network-wired"></h4>
          Datatable & APIs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#panel-statistics" data-toggle="tab">
            <h4 class="fa fa-chart-bar"></h4>
          Statistics</a>
        </li>
        <li class="nav-item"><br>
          <button type="button" class="btn btn-success  generate">
          <i class="fa fa-plus-circle"></i>
          {{it_trans('it.generate_crud')}}
          </button>
          <i class="fa fa-spinner  fa-spin loading_genereate hidden"></i>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="panel-info">
          @include('baboon.Initialize')
          <div class="clearfix"></div>
        </div>
        <div class="tab-pane" id="panel-language">
          @include('baboon.language')
          <div class="clearfix"></div>
        </div>
        <div class="tab-pane" id="panel-columns">
          @include('baboon.columns_input')
          <div class="clearfix"></div>
        </div>
        <div class="tab-pane" id="panel-relations">
          @include('baboon.relations')
          <div class="clearfix"></div>
        </div>
        <div class="tab-pane" id="panel-datatable">
          @include('baboon.datatable_settings')
          <!-- Api Prepare Start-->
          @include('baboon.api_settings')
          <!-- Api Prepare End-->
          <div class="clearfix"></div>
        </div>
        <div class="tab-pane " id="panel-statistics">
          @include('baboon.statistics')
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <br />
        <div class="col-md-12">
          <button type="button" class="btn btn-success generate">
          <i class="fa fa-plus-circle"></i>
          {{it_trans('it.generate_crud')}}
          </button>
          <i class="fa fa-spinner fa-2x fa-spin loading_genereate hidden"></i>
        </div>
        <div class="clearfix"></div>
        <br />
      </div>
    </div>
  </div>
</form>
@endsection