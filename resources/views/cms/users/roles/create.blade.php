@extends('cms.layouts.master')

@section('content')

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header sty-one">
    <h1>Role</h1>
    <ol class="breadcrumb">
      <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
      <li><a href="{!! route('cms::users.roles.index') !!}"><i class="fa fa-angle-right"></i> Roles</a></li>
      <li><i class="fa fa-angle-right"></i> Add Role</li>
    </ol>
  </div>

  <div class="content"> 
    {!! Form::open(['route' => 'cms::users.roles.store','files'=>true]) !!}
    <div class="row">
      @include('cms.users.roles.form',['button' => 'Save'])
    </div>
    {!! Form::close() !!}
    <!-- /.row -->
  </div>

</div>

@endsection