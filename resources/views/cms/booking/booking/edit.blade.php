@extends('cms.layouts.master')

@section('content')

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header sty-one">
    <h1>Edit Booking</h1>
    <ol class="breadcrumb">
      <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
      <li><a href="{!! route('cms::bookings.index') !!}"><i class="fa fa-angle-right"></i> Booking</a></li>
      <li><i class="fa fa-angle-right"></i> Edit Booking</li>
    </ol>
  </div>

  <div class="content"> 
    {!! Form::model($booking,['route' => ['cms::bookings.update', $booking->id], 'method' => 'patch','files'=>true, 'id' => 'post_form']) !!}
    <div class="row">
      @include('cms.booking.booking.form')
    </div>
    {!! Form::close() !!}
    <!-- /.row -->
  </div>

</div>

@endsection

