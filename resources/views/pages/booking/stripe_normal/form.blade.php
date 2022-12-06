@section('head-custom-scripts')
<script src="https://js.stripe.com/v3/"></script>
@endsection

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


  @include('pages.booking.stripe_normal.css') 
  @include('pages.booking.stripe_normal.script') 
  