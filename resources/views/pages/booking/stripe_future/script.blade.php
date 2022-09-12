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

  save_order_stripe();

  const {error} = await stripe.confirmSetup({
    //`Elements` instance that was used to create the Payment Element
    elements,
    confirmParams: {
      //return_url: 'https://example.com/account/payments/setup-complete',
      return_url: "{!! route('page.thankyou') !!}?customer_id="+customer_id,
    }
  });

  if (error) {
    // This point will only be reached if there is an immediate error when
    // confirming the payment. Show error to your customer (for example, payment
    // details incomplete)
    const messageContainer = document.querySelector('#error-message');
    messageContainer.textContent = error.message;
    //delete_stripe_order();
  } else {
    // Your customer will be redirected to your `return_url`. For some payment
    // methods like iDEAL, your customer will be redirected to an intermediate
    // site first to authorize the payment, then redirected to the `return_url`.
   
  }

  
});

function save_order_stripe()
  {
    var data = $('#form-billing-address').serialize();
    
    data+='&transaction_status=0&customer_id='+customer_id+'&setup_intent_id='+setup_intent_id;

    $.ajax({
                url:"{!! route('save-order') !!}", 
                type: "POST",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': "{!! csrf_token() !!}"
                },
                beforeSend: function () {
                    $('.loader').show();
                },
                complete: function () {
                    $('.loader').hide();
                },     
                success:function(data)
                {
                   //redirect to thank you page
                   //alert('Thank you. We will contact you soon.');
                   //location.href = "{!! route('page.index') !!}"    
                }

            });    
 }

 function delete_stripe_order()
  {
    
    $.ajax({
                url:"{!! route('delete-stripe-order') !!}", 
                type: "POST",
                data: {'customer_id':customer_id,'setup_intent_id':setup_intent_id},
                headers: {
                    'X-CSRF-TOKEN': "{!! csrf_token() !!}"
                },
                beforeSend: function () {
                    $('.loader').show();
                },
                complete: function () {
                    $('.loader').hide();
                },     
                success:function(data)
                {
                     
                }

            });    
 }
</script>
@endsection