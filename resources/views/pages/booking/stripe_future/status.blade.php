@section('head-custom-scripts')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('stripe-scripts')
<script>
// Initialize Stripe.js using your publishable key
const stripe = Stripe("{!! config('stripe.publishable_key') !!}");

// Retrieve the "setup_intent_client_secret" query parameter appended to
// your return_url by Stripe.js
const clientSecret = new URLSearchParams(window.location.search).get(
  'setup_intent_client_secret'
);

const customer_id = new URLSearchParams(window.location.search).get(
  'customer_id'
);

const setup_intent_id = new URLSearchParams(window.location.search).get(
  'setup_intent'
);

if (clientSecret)
        {
            // Retrieve the SetupIntent
            stripe.retrieveSetupIntent(clientSecret).then(({setupIntent}) => {
            const message = document.querySelector('#message')
            //console.log(setup_intent_id);
            //return false;
            // Inspect the SetupIntent `status` to indicate the status of the payment
            // to your customer.
            //
            // Some payment methods will [immediately succeed or fail][0] upon
            // confirmation, while others will first enter a `processing` state.
            //
            // [0]: https://stripe.com/docs/payments/payment-methods#payment-notification
            switch (setupIntent.status) {
                case 'succeeded': {
                //message.innerText = 'Success! Your payment method has been saved.';
                /*var message_d = 'Thank you. We will contact you soon.'; 
                alert(message_d);*/
                message.innerText = 'Thank you. We will contact you soon.';
                alert(message.innerText);
                location.href = "{!! route('page.index') !!}";
                break;
                }

                case 'processing': {
                //message.innerText = "Processing payment details. We'll update you when processing is complete.";
                /*var message_d = "Processing payment details. We'll update you when processing is complete.";
                alert(message_d);*/
                message.innerText = 'Failed to process payment details. Please try another card.';
                delete_stripe_order();
                alert(message.innerText);
                location.href = "{!! route('page.booking') !!}";
                break;
                }

                case 'requires_payment_method': {
                //message.innerText = 'Failed to process payment details. Please try another payment method.';

                // Redirect your user back to your payment page to attempt collecting
                // payment again
                /*var message_d = "Failed to process payment details. Please try another payment method.";
                alert(message_d);  
                */
                message.innerText = 'Failed to process payment details. Please try another card.'; 
                delete_stripe_order();
                alert(message.innerText);
                location.href = "{!! route('page.booking') !!}"; 
                break;
                }
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