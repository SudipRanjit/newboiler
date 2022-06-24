@extends('cms.layouts.master')

@section('content')

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header sty-one">
    <h1>Users</h1>
    <ol class="breadcrumb">
      <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
      <li><a href="{!! route('cms::users.index') !!}"><i class="fa fa-angle-right"></i> Users</a></li>
      <li><i class="fa fa-angle-right"></i> Add User</li>
    </ol>
  </div>

  <div class="content"> 
    {!! Form::open(['route' => 'cms::users.store','files'=>true]) !!}
    <div class="row">
      @include('cms.users.form')
    </div>
    {!! Form::close() !!}
    <!-- /.row -->
  </div>

</div>

@endsection