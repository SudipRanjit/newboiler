@extends('pages.layouts.master')

@section('title') Booking @endsection

@section('container-css') pb-5 @endsection

@section('progress-bar')
<div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
@endsection

@php $completed_wizards = ['boiler','control','radiator','smart-device'] @endphp

@section('content')
<div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-4 text-center" id="h2-title">Submitted successfully</h2>
                <p class="text-black-light mb-5 text-center" id="message"></p>
                
            </div>
</div>

       
@endsection

@if (isset($_GET['payment_option']) && $_GET['payment_option']=='stripe')
    @include('pages.booking.stripe_future.status')
@elseif (isset($_GET['payment_option']) && $_GET['payment_option']=='paypal')
    @section('paypal-scripts')
    <script>
        $('#message').html('Thank you for your payment. We will contact you soon.');
    </script>
    @endsection
@elseif (isset($_GET['payment_option']) && $_GET['payment_option']=='pay_with_finance')
    @section('pay_with_finance-scripts')
    <script>
        $('#message').html('Thank you. We will contact you soon.');
    </script>
    @endsection    
@endif 



