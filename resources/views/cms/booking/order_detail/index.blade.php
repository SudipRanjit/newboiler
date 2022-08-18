@extends('cms.layouts.master')

@section('content')
<div class="content-wrapper">
<div class="content-header sty-one">
  <h1>Order Detail</h1>
  <ol class="breadcrumb">
    <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
    <li><i class="fa fa-angle-right"></i><a href="{!! route('cms::orders.index') !!}">Order</a></li>
    <li><i class="fa fa-angle-right"></i> Order Detail</li>
  </ol>
</div>


<div class="content">
  
  <!-- Default box -->
  <div class="row m-t-3">
    <div class="col-md-12">
  <div class="card">
    <div class="card-body">
 
      <div class="col-md-4 mb-4 float-right">
        <h4>Booking </h4>
        <div>ID: <b>{!! $booking->booking_id !!}</b></div>
        <div>Amount Paid(&pound;): <b>{!! $booking->amount !!}</b></div>
        <div>Discount(&pound;): <b>{!! $booking->discount !!}</b></div>
        <div>Appointment Date: <b>{!! date('Y-m-d',strtotime($booking->appointment_date)) !!}</b></div>
        <div>Status: <b>@if($booking->status===0)
                        On process (Installment not complete)
                        @elseif($booking->status===1)
                        Complete (Installment completed)
                        @elseif($booking->status===2)
                        Cancel (Installment cancelled)
                        @endif 
                     </b>
        </div>
      </div>    

    <div class="col-md-4 float-right mb-4">
      <h4>Billing Information </h4>
      <div>First Name: <b>{!! $billing_address->first_name.' '.$billing_address->last_name !!}</b></div>
      <div>Email: <b>{!! $billing_address->email !!}</b></div>
      <div>Contact number: <b>{!! $billing_address->contact_number !!}</b></div>
      <div>Address line 1: <b>{!! $billing_address->address_line_1 !!}</b></div>
      <div>Address line 2: <b>{!! $billing_address->address_line_2 !!}</b></div>
      <div>Address line 3: <b>{!! $billing_address->address_line_3 !!}</b></div>
      <div>City/Town: <b>{!! $billing_address->city !!}</b></div>
      <div>County: <b>{!! $billing_address->county !!}</b></div>
      <div>PostCode: <b>{!! $billing_address->postcode !!}</b></div>
      <div>Note for engineer: <b>{!! $billing_address->note !!}</b></div>                                
    </div>    

    <div class="col-md-4  mb-4">
      <h4>Order </h4>
      <div>Transaction ID: <b>{!! $order->transaction_id !!}</b></div>
      <div>Payment Method: <b>{!! $order->payment_gateway->title !!}</b></div>
      <div>{!! $order->payment_gateway->title !!} Transaction ID: <b>{!! $order->vendor_transaction_id !!}</b></div>
      <div>Amount(&pound;): <b>{!! $order->amount !!}</b></div>
      <div>Discount(&pound;): <b>{!! $order->discount !!}</b></div>
      <div>Status: <b>{!! $order->status?'Payment complete':'Payment incomplete' !!}</b></div>
      <div>Created: <b>{!! date('Y-m-d',strtotime($order->created_at)) !!}</b></div>                                
    </div>    
      
      <div class="col-md-12 table-responsive float-none">
      <h4>Products</h4>  
      <table class="table">
        <thead>
          <tr>
            <th scope="col">S.No.</th>
            <th scope="col">Product</th>
            <th scope="col">Price(&pound;)</th>
            <th scope="col">Discount(&pound;)</th>
            <th scope="col">Quantity</th>
            <th scope="col">Amount(&pound;)</th>
          </tr>
        </thead>
        <tbody>
          @php $product_total_amount = $sno = 0; @endphp
          @foreach($order_details as $order_detail)
          <tr>
            <td scope="row">{!! ++$sno !!}</td>
            <td>{!! $order_detail->product !!}
            @if($order_detail->product=='Radiator')
            <br/>
            <small>
              Type: {!! $order_detail->radiator_type->type !!}<br/>
              Height: {!! $order_detail->radiator_height->height !!} mm<br/>
              Length: {!! $order_detail->radiator_length->length !!} mm<br/>
            </small>   
            @endif
            </td>
            <td>{!! $order_detail->price !!}</td>
            <td>{!! $order_detail->discount !!}</td>
            <td>{!! $order_detail->quantity !!}</td>
            <td>
              @php
              
                $total = round(($order_detail->price - $order_detail->discount) * $order_detail->quantity,2);
                $product_total_amount+= $total; 
                 
              @endphp
              {!! $total !!}
            </td>
          </tr>
          @endforeach
          <tr>
            <td colspan="4"></td>
            <td><b>Total:</b></td>
            <td><b>{!! $product_total_amount !!}</b></td>
          </tr>
          @if(!empty($order->conversion_charge))
          <tr>
            <td colspan="4"></td>
            <td><b>Boiler Conversion Charge (converting to a Combi boiler):</b></td>
            <td><b>{!! $order->conversion_charge !!}</b></td>
            @php $product_total_amount+=$order->conversion_charge @endphp
          </tr>
          @endif
          @if(!empty($order->moving_boiler_charge))
          <tr>
            <td colspan="4"></td>
            <td><b>Moving Boiler Charge (moving to {!! $order->moving_boiler_to !!}):</b></td>
            <td><b>{!! $order->moving_boiler_charge !!}</b></td>
            @php $product_total_amount+=$order->moving_boiler_charge @endphp
          </tr>
          @endif
         
          <tr>
            <td colspan="4"></td>
            <td><b>Grand Total:</b></td>
            <td><b>{!! $product_total_amount !!}</b></td>
          </tr>
         
        </tbody>
      </table>
    </div>
    </div>
    <!-- /.card-body -->
  
    <div class="card-footer">
      <a href="{!! route('cms::orders.index') !!}" title="Cancel" class="btn btn-info cancel-btn">Back</a>
    </div> 
  
  </div>
  <!-- /.card -->
    </div>
  </div>
</div>
<!-- /.content -->
</div>
@endsection

