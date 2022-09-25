@extends('cms.layouts.master')

@section('content')

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header sty-one">
    <h1>Edit Payment Gateway</h1>
    <ol class="breadcrumb">
      <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
      <li><a href="{!! route('cms::payment_gateways.index') !!}"><i class="fa fa-angle-right"></i> Payment Gateway</a></li>
      <li><i class="fa fa-angle-right"></i> Edit Payment Gateway</li>
    </ol>
  </div>

  <div class="content"> 
    {!! Form::model($payment_gateway,['route' => ['cms::payment_gateways.update', $payment_gateway->id], 'method' => 'patch','files'=>true, 'id' => 'post_form']) !!}
    <div class="row">
      @include('cms.booking.payment_gateway.form')
    </div>
    {!! Form::close() !!}
    <!-- /.row -->
  </div>

</div>

@endsection

