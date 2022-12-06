@extends('cms.layouts.master')

@section('content')
<div class="content-wrapper">
<div class="content-header sty-one">
  <h1>Payment Gateways</h1>
  <ol class="breadcrumb">
    <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
    <li><i class="fa fa-angle-right"></i> Payment Gateway</li>
  </ol>
</div>


<div class="content">
  <div class="row">
    <div class="col-md-6 search__box">
      <div class="input-group">
        <input class="form-control" alt="Payment Gateway" route="{!! route('cms::payment_gateways.search') !!}" id="search_box" placeholder="Search" type="text" value="@if(isset($searchTxt)) {!! $searchTxt !!} @endif">
        <div class="input-group-addon search__icon" id="search-btn"><i class="ti-search"></i></div>
        @if(isset($searchTxt))
        <a href="{!! route('cms::payment_gateways.index') !!}" title="Cancel Search"><i class="fa fa-times cancel__search"></i></a>
        @endif
      </div>
    </div>
    <div class="col-md-6 add__btn">
      <a href="{!! route('cms::payment_gateways.create') !!}" class="btn btn-outline-primary">Add Payment Gateway</a>
    </div>
  </div>
  <!-- Default box -->
  <div class="row m-t-3">
    <div class="col-md-12">
  <div class="card">
    <div class="card-body">
      Note: <b><span>Do not delete records. Deleting records with title Paypal, Stripe or Pay with Finance will not work booking system.</span></b>
      
      <div class="table-responsive m-t-3">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($payment_gateways as $payment_gateway)
          <tr>
            <td scope="row">
              {!! $payment_gateway->id !!}
            </td>
            <td>{!! $payment_gateway->title !!}</td>
            <td>
              <a href="{!! route('cms::payment_gateways.edit',['payment_gateway' => $payment_gateway->id]) !!}" class="btn btn-default" title="Edit"><span class="fa fa-edit"></span></a>

              {!! Form::open(['route' => ['cms::payment_gateways.delete',$payment_gateway->id],'method' => 'delete','onsubmit' =>'return confirm("Are you sure?")', 'class' => 'action-form']) !!}
                <button class="btn btn-default"><span class="fa fa-trash"></span></button>
              {!! Form::close() !!}
            </td>

          </tr>
          @endforeach

          <tr>
            <td colspan="8">{!! $payment_gateways->appends($_GET)->links() !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
    </div>
  </div>
</div>
<!-- /.content -->
</div>
@endsection

