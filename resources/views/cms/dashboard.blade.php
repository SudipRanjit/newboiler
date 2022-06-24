@extends('cms.layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header sty-one">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Dashboard</li>
    </ol>
  </div>
 <!-- Main content -->
 <div class="content"> 
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-sm-6 col-xs-12">
      <div class="info-box bg-darkblue"> <span class="info-box-icon bg-transparent"><i class="ti-stats-up text-white"></i></span>
        <div class="info-box-content">
          <h6 class="info-box-text text-white">New Inquiries</h6>
          <h1 class="text-white">0</h1></div>
        <!-- /.info-box-content --> 
      </div>
      <!-- /.info-box --> 
    </div>
    <!-- /.col -->
    <div class="col-lg-3 col-sm-6 col-xs-12">
      <div class="info-box bg-green text-white"> <span class="info-box-icon bg-transparent"><i class="ti-money"></i></span>
        <div class="info-box-content">
          <h6 class="info-box-text text-white">Total Brands</h6>
          <h1 class="text-white">{{ $totalBrands }}</h1></div>
        <!-- /.info-box-content --> 
      </div>
      <!-- /.info-box --> 
    </div>
    <!-- /.col -->
    <div class="col-lg-3 col-sm-6 col-xs-12">
      <div class="info-box bg-aqua"> <span class="info-box-icon bg-transparent"><i class="ti-bar-chart"></i></span>
        <div class="info-box-content">
          <h6 class="info-box-text text-white">Total Boilers</h6>
          <h1 class="text-white">{{ $totalBoilers }}</h1></div>
        <!-- /.info-box-content --> 
      </div>
      <!-- /.info-box --> 
    </div>
    <!-- /.col -->
    <div class="col-lg-3 col-sm-6 col-xs-12">
      <div class="info-box bg-orange"> <span class="info-box-icon bg-transparent"><i class="ti-face-smile"></i></span>
        <div class="info-box-content">
          <h6 class="info-box-text text-white">Published Boilers</h6>
          <h1 class="text-white">{{ $publishedBoilers }}</h1></div>
        <!-- /.info-box-content --> 
      </div>
      <!-- /.info-box --> 
    </div>
    <!-- /.col --> 
  </div>
  <!-- /.row --> 

</div>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->

@endsection