@section('head-custom-scripts')
<script src="https://js.stripe.com/v3/"></script>
@endsection

{{--
<div id="stripe-payment-form" style="margin-top:20px;display:none">
    <div id="payment-element">
      <!--Stripe.js injects the Payment Element-->
    </div>
    <button id="submit">
      <div class="spinner hidden" id="spinner"></div>
      <span id="button-text">Pay now</span>
    </button>
    <div id="payment-message" class="hidden"></div>
</div>
--}}

<div id="stripe-payment-form" style="margin-top:20px;display:none">
  <div id="payment-element">
    <!-- Elements will create form elements here -->
  </div>
  <button id="submit">Submit</button>
  <div id="error-message" style="color:red;margin-top:15px">
    <!-- Display error message to your customers here -->
  </div>
</div>

  @include('pages.booking.stripe_future.css') 
  @include('pages.booking.stripe_future.script')
  
  