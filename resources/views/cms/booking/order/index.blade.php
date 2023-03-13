@extends('cms.layouts.master')

@section('content')
<div class="content-wrapper">
<div class="content-header sty-one">
  <h1>Orders</h1>
  <ol class="breadcrumb">
    <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
    <li><i class="fa fa-angle-right"></i> Order</li>
  </ol>
</div>


<div class="content">
  <div class="row">
    <div class="col-md-6 search__box">
      <div class="input-group">
        <input class="form-control" alt="Order" route="{!! route('cms::orders.search') !!}" id="search_box" placeholder="Search" type="text" value="@if(isset($searchTxt)) {!! $searchTxt !!} @endif">
        <div class="input-group-addon search__icon" id="search-btn"><i class="ti-search"></i></div>
        @if(isset($searchTxt))
        <a href="{!! route('cms::orders.index') !!}" title="Cancel Search"><i class="fa fa-times cancel__search"></i></a>
        @endif
      </div>
    </div>
  </div>
  <!-- Default box -->
  <div class="row m-t-3">
    <div class="col-md-12">
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">S.No.</th>
            <th scope="col">ID</th>
            <th scope="col">Payment Method</th>
            <th scope="col">Paypal/Stripe Transaction ID</th>
            <th scope="col">Billing</th>
            <th scope="col">Amount(&pound;)</th>
            <th scope="col">Discount(&pound;)</th>
            <th scope="col">Payout/Paid Amount(&pound;)</th>
            <th scope="col">Status</th>
            <th scope="col">Appointment</th>
            <th scope="col">Created&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th scope="col">Note for Engineer</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @php $sno = 0; @endphp
          @foreach($orders as $order)
          <tr>
            <td scope="row">{!! ++$sno !!}</td>
            <td>{!! $order->transaction_id !!}</td>
            <td>{!! $order->payment_gateway->title !!}</td>
            <td>{!! $order->vendor_transaction_id !!}</td>
            <td><a href="{!! route('cms::order_details.index',[$order->id]) !!}" title="View" target="_blank"><b>{!! $order->billing_address->first_name.' '.$order->billing_address->last_name!!}</b>
                      <br/>
                      @php 
                        $address =[
                                  $order->billing_address->email,
                                  "Phone: ".$order->billing_address->contact_number, 
                                  "Address: ".$order->billing_address->address_line_1,
                                  ];

                      if (!empty($order->billing_address->address_line_2))
                        $address[] = $order->billing_address->address_line_2;         

                      if (!empty($order->billing_address->address_line_3))
                        $address[] = $order->billing_address->address_line_3;         
          
                      $address[] = $order->billing_address->city;

                      if (!empty($order->billing_address->county))  
                        $address[] = $order->billing_address->county;
                    
                      $address[] = "Postcode: ".$order->billing_address->postcode;  
                      @endphp
                      <small>{!! implode(", ",$address)!!}</small>
                </a>
           </td>
            <td>{!! $order->amount !!}</td>
            <td>{!! $order->discount !!}</td>
            <td>{!! $order->payout_amount !!}</td>
            <td>
              @if($order->status===1)
              <span class="label label-success">Complete</span>
              @else
              <span class="label label-danger">InComplete</span>
              @endif
              @if($order->call_requested)<br><span class="label label-success">Call_Requested</span>@endif
            </td>
            <td>{!! date('Y-m-d',strtotime($order->booking->appointment_date)) !!}</td>
            <td>{!! date('Y-m-d',strtotime($order->created_at)) !!}</td>
            <td><span title="{!! $order->billing_address->note !!}">{!! Str::limit($order->billing_address->note, 10) !!}</span></td>
            <td>
              <a href="{!! route('cms::order_details.index',[$order->id]) !!}" class="btn btn-default" title="View" target="_blank"><span class="fa fa-eye"></span></a>
            </td>
          </tr>
          @endforeach
   
          <tr>
            <td colspan="8">{!! $orders->appends($_GET)->links() !!}</td>
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

