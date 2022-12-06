@extends('cms.layouts.master')

@section('content')

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header sty-one">
    <h1>Edit Block Date</h1>
    <ol class="breadcrumb">
      <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
      <li><a href="{!! route('cms::block_dates.index') !!}"><i class="fa fa-angle-right"></i> Block Date</a></li>
      <li><i class="fa fa-angle-right"></i> Edit Block Date</li>
    </ol>
  </div>

  <div class="content"> 
    {!! Form::model($block_date,['route' => ['cms::block_dates.update', $block_date->id], 'method' => 'patch','files'=>true, 'id' => 'post_form']) !!}
    <div class="row">
      @include('cms.booking.block_date.form')
    </div>
    {!! Form::close() !!}
    <!-- /.row -->
  </div>

</div>

@endsection

