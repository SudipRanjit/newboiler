@section('stripe-scripts')
<script>
// This is your test publishable API key.
const stripe = Stripe("{!! config('stripe.publishable_key') !!}");


// The items the customer wants to buy
// const items = [{ id: "xl-tshirt" }];

let elements;
let customer_id;
let setup_intent_id;

initialize();

// Fetches and captures the client secret
async function initialize() {
  const response = await fetch("{!! route('get-customer-secret') !!}", {
    method: "POST",
    headers: { "Content-Type": "application/json",
               'X-CSRF-TOKEN': "{!! csrf_token() !!}"
             },
    //body: JSON.stringify({ items }),
    
  });
 
	const data = await response.json();
  
  const CLIENT_SECRET = data.clientSecret;
   
  elements = stripe.elements({clientSecret:CLIENT_SECRET});

  const paymentElement = elements.create("payment");
  paymentElement.mount("#payment-element");

  customer_id = data.customer;
  setup_intent_id = data.setup_intent;

}

const form = document.getElementById('form-billing-address');

form.addEventListener('submit', async (event) => {
  event.preventDefault();

  $('.loader').show();
  
  var data = $('#form-billing-address').serialize();
  data+='&transaction_status=0&customer_id='+customer_id;
  
  const {error} = await stripe.confirmSetup({
    //`Elements` instance that was used to create the Payment Element
    elements,
    confirmParams: {
      //return_url: 'https://example.com/account/payments/setup-complete',
      return_url: "{!! route('page.thankyou') !!}?"+data,
    }
  });

  if (error) {
    // This point will only be reached if there is an immediate error when
    // confirming the payment. Show error to your customer (for example, payment
    // details incomplete)
    const messageContainer = document.querySelector('#error-message');
    messageContainer.textContent = error.message;
    $('.loader').hide();
   
  } else {
    // Your customer will be redirected to your `return_url`. For some payment
    // methods like iDEAL, your customer will be redirected to an intermediate
    // site first to authorize the payment, then redirected to the `return_url`.
    
  }
  
});

</script>
@endsection