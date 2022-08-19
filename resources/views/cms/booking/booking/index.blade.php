@extends('cms.layouts.master')

@section('content')
<div class="content-wrapper">
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
            <th scope="col">Order Transaction ID</th>
            <th scope="col">Amount(&pound;)</th>
            <th scope="col">Discount(&pound;)</th>
            <th scope="col">Status</th>
            <th scope="col">Appointment Date</th>
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
            <td><a href="{!! route('cms::order_details.index',[$booking->order->id]) !!}" style="color:#0275d8" title="View Order" target="_blank"> {!! $booking->order->transaction_id !!}</a></td>
            <td>{!! $booking->amount !!}</td>
            <td>{!! $booking->discount !!}</td>
            <td>
              @if($booking->status===0)
              <span class="label label-info">On process</span>
              @elseif($booking->status===1)
              <span class="label label-success">Complete</span>
              @elseif($booking->status===2)
              <span class="label label-danger">Cancel</span>
              @endif
            </td>
            <td>{!! date('Y-m-d', strtotime($booking->appointment_date)) !!}</td>
            <td>{!! date('Y-m-d', strtotime($booking->created_at)) !!}</td>
            <td>
              <a href="{!! route('cms::bookings.edit',['booking' => $booking->id]) !!}" class="btn btn-default" title="Edit"><span class="fa fa-edit"></span></a>
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

