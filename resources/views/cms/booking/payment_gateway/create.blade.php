@extends('cms.layouts.master')

@section('content')

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header sty-one">
    <h1>Add Payment Gateway</h1>
    <ol class="breadcrumb">
      <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
      <li><a href="{!! route('cms::payment_gateways.index') !!}"><i class="fa fa-angle-right"></i> Payment Gateways</a></li>
      <li><i class="fa fa-angle-right"></i> Add Payment Gateway</li>
    </ol>
  </div>

  <div class="content"> 
    {!! Form::open(['route' => 'cms::payment_gateways.store','files'=>true, 'id' => 'post_form']) !!}
    <div class="row">
      @include('cms.booking.payment_gateway.form')
    </div>
    {!! Form::close() !!}
    <!-- /.row -->
  </div>

</div>

@endsection
