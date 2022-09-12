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
                <h2 class="mb-4">Submitted successfully</h2>
                <p class="text-black-light mb-5" id="message"></p>
                
            </div>
</div>

       
@endsection

@include('pages.booking.stripe_future.status')

@section('custom-scripts')

</script>
@endsection


