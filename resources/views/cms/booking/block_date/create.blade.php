@extends('cms.layouts.master')

@section('content')

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header sty-one">
    <h1>Add Block Date</h1>
    <ol class="breadcrumb">
      <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
      <li><a href="{!! route('cms::block_dates.index') !!}"><i class="fa fa-angle-right"></i> Block Dates</a></li>
      <li><i class="fa fa-angle-right"></i> Add Block Date</li>
    </ol>
  </div>

  <div class="content"> 
    {!! Form::open(['route' => 'cms::block_dates.store','files'=>true, 'id' => 'post_form']) !!}
    <div class="row">
      @include('cms.booking.block_date.form')
    </div>
    {!! Form::close() !!}
    <!-- /.row -->
  </div>

</div>

@endsection
