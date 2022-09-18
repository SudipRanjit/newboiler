@extends('cms.layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="loader" style="background:none;display:none;">
    <img src="{{asset('cms/dist/img/loading.gif')}}" style="padding-top:10%" />
  </div> 
<div class="content-header sty-one">
  <h1>Bookings</h1>
  <ol class="breadcrumb">
    <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
    <li><i class="fa fa-angle-right"></i> Booking</li>
  </ol>
</div>
<div class="content">
  <div class="row">
    <div class="col-md-6 search__box">
      <div class="input-group">
        <input class="form-control" alt="Booking" route="{!! route('cms::bookings.search') !!}" id="search_box" placeholder="Search" type="text" value="@if(isset($searchTxt)) {!! $searchTxt !!} @endif">
        <div class="input-group-addon search__icon" id="search-btn"><i class="ti-search"></i></div>
        @if(isset($searchTxt))
        <a href="{!! route('cms::bookings.index') !!}" title="Cancel Search"><i class="fa fa-times cancel__search"></i></a>
        @endif
      </div>
    </div>
    {{--
    <div class="col-md-6 add__btn">
      <a href="{!! route('cms::bookings.create') !!}" class="btn btn-outline-primary">Add Booking</a>
    </div>
    --}}
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
            <th scope="col">Order ID</th>
            <th scope="col">Customer</th>
            <th scope="col">Amount(&pound;)</th>
            <th scope="col">Discount(&pound;)</th>
            <th scope="col">Payout Amount(&pound;)</th>
            <th scope="col">Payout status</th>
            <th scope="col">Appointment Date</th>
            <th scope="col">Booking Status</th>
            <th scope="col">Created</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @php $sno = 0; @endphp
          @foreach($bookings as $booking)
          <tr>
            <td scope="row">
              {{ ++$sno }}
            </td>
            <td>{!! $booking->booking_id !!}</td>
            <td>{!! $booking->order->payment_gateway->title !!}</td>
            <td><a href="{!! route('cms::order_details.index',[$booking->order->id]) !!}" style="color:#0275d8" title="View Order" target="_blank"> {!! $booking->order->transaction_id !!}</a></td>
            <td><b>{!! $name = $booking->order->billing_address->first_name.' '.$booking->order->billing_address->last_name !!}</b>
              <br/>
              @php 
                $address =[
                           $booking->order->billing_address->email,
                           "Phone: ".$booking->order->billing_address->contact_number, 
                           "Address: ".$booking->order->billing_address->address_line_1,
                          ];

              if (!empty($booking->order->billing_address->address_line_2))
                $address[] = $booking->order->billing_address->address_line_2;         

              if (!empty($booking->order->billing_address->address_line_3))
                $address[] = $booking->order->billing_address->address_line_3;         
  
              $address[] =$booking->order->billing_address->city;

              if (!empty($booking->order->billing_address->county))  
                $address[] = $booking->order->billing_address->county;
            
              $address[] = "Postcode: ". $booking->order->billing_address->postcode;  
              @endphp
              <small>{!! implode(", ",$address)!!}</small>
              @if(!empty($booking->order->billing_address->note))
              <br/>
              <small><b>Note for engineer:</b> {!! Str::limit($booking->order->billing_address->note, 10) !!}</small>
              @endif 
            </td>
            <td>{!! $booking->amount !!}</td>
            <td>{!! $booking->discount !!}</td>
            <td>
              @if($booking->order->status=='0')
                {{ $payout_amount = $booking->amount - $booking->discount }}
              @elseif($booking->order->status=='1')
                {{ $payout_amount = $booking->order->payout_amount }}
              @endif
            </td>
            <td>
              @if($booking->order->status=='0')
              <span class="label label-danger">InComplete</span>
              @elseif($booking->order->status=='1')
              <span class="label label-success">Complete</span>
              @endif
            </td>
            <td>{!! date('Y-m-d', strtotime($booking->appointment_date)) !!}</td>
            <td>
              @if($booking->status===0)
              <span class="label label-info">On process</span>
              @elseif($booking->status===1)
              <span class="label label-success">Complete</span>
              @elseif($booking->status===2)
              <span class="label label-danger">Cancel</span>
              @elseif($booking->status===3)
              <span class="label label-info">Finance Awaiting</span>
              @elseif($booking->status===4)
              <span class="label label-success">Finance Approved</span>
              @elseif($booking->status===5)
              <span class="label label-danger">Finance Rejected</span>
              @endif
            </td>
            <td>{!! date('Y-m-d', strtotime($booking->created_at)) !!}</td>
            <td>
              <a href="{!! route('cms::bookings.edit',['booking' => $booking->id]) !!}" class="btn btn-default" title="Edit"><span class="fa fa-edit"></span></a>
              @if ($booking->order->payment_gateway_id =='2' && $booking->order->status=='0')
                {!! Form::open(['route' => ['cms::bookings.stripe-payout'],'method' => 'post','onsubmit' =>"return onpayout('{$booking->booking_id}','{$name}','{$booking->order->billing_address->email}','{$payout_amount}')", 'class' => 'action-form']) !!}
                  <input type="hidden" name="booking_id" value="{!! $booking->id !!}" />
                  <input type="hidden" name="customer_id" value="{!! $booking->order->stripe_customer_id !!}" />
                  <button class="btn btn-default" title="Payout"><span class="fa fa-credit-card"></span></button>
                {!! Form::close() !!}
              @endif
            </td>

          </tr>
          @endforeach

          <tr>
            <td colspan="8">{!! $bookings->appends($_GET)->links() !!}</td>
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

@section ('custom-scripts')
<script>
function onpayout(booking_id, customer_name, customer_email, amount)
{
  var con = confirm("Are you sure for payout(£) "+amount+" from customer# "+ customer_name+"("+customer_email+") for booking ID# "+booking_id+"?");
  if (con) {$(".loader").show().attr('tabindex','-1').focus().removeAttr('tabindex'); return true;} 
  else return false;    
}
</script>  
@endsection
