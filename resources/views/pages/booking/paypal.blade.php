@php $paypal_client_id ='AZcymT8ks4CIX_bGhcdGG37t4MN7bcnhUbaWEggkPs9HKYZaMYp3y82W5sXeqHDmMbYh5SqCNF_QSlxj' @endphp

<script src="https://www.paypal.com/sdk/js?client-id={!! $paypal_client_id !!}&currency=GBP&enable-funding=paylater" data_source="integrationbuilder"></script>
<script>
    const paypalButtonsComponent = paypal.Buttons({

        onClick: function(data, actions) {
        
         var validate = formvalidate($('#form-billing-address'));
         if (!validate)
            {
                $('#btn-submit').click();
                return actions.reject();
            }      
         else
            {           
              return actions.resolve();  
            }
       },


        // optional styling for buttons
        // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
        style: {
          color: "gold",
          shape: "rect",
          layout: "vertical"
        },

        // set up the transaction
        createOrder: (data, actions) => {
            // pass in any options from the v2 orders create call:
            // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
            const createOrderPayload = {
                /*purchase_units: [
                    {
                        amount: {
                            value: "{!! $Selection['total_price'] !!}"
                        },*/
                        "purchase_units": [{
                        "amount": {
                        "currency_code": "GBP",
                        "value": "{!! $Selection['total_price'] !!}",
                        "breakdown": {
                            "item_total": {  // Required when including the `items` array /
                            "currency_code": "GBP",
                            "value": "{!! $Selection['total_price'] !!}"
                            }
                        }
                        }, 
                        items: {!! $item_list_json_for_paypal !!},     
                        shipping: {
                                        name: {
                                            full_name: $('#first-name').val()+' '+$('#last-name').val()
                                        },
                                        type: 'SHIPPING',
                                        address: {
                                            address_line_1: $('#address-line1').val(),
                                            address_line_2: $('#address-line2').val(),
                                            country_code: 'GB',
                                            postal_code: $('#postcode').val(),
                                            admin_area_1: $('#county').val()+' United Kingdom',
                                            admin_area_2: $('#city-town').val(),
                                        }
                                    }  
                    }
                ],
                application_context: {
                        shipping_preference: 'SET_PROVIDED_ADDRESS',
                        } 
            };

            /*purchase_units: [{
                                        items: itemList,
                                        amount: { data },
                                        shipping: {
                                                    name: {
                                                        full_name: address.name+' '+address.surname
                                                    },
                                                    type: 'SHIPPING',
                                                    address: {
                                                        address_line_1: address.address,
                                                        country_code: address.country.iso_code,
                                                        postal_code: address.zip_code,
                                                        admin_area_2: address.city,
                                                        admin_area_1: address.country.general_name
                                                            }
                                                    },
                              }]
                            ,
                        application_context: {
                        shipping_preference: 'SET_PROVIDED_ADDRESS',
                        }
               */         
            return actions.order.create(createOrderPayload);
        },

        


/*createOrder: function(data, actions) {
      return actions.order.create({
         "purchase_units": [{
            "amount": {
              "currency_code": "USD",
              "value": "100",
              "breakdown": {
                "item_total": {  // Required when including the `items` array /
                  "currency_code": "USD",
                  "value": "100"
                }
              }
            },
            "items": [
              {
                "name": "First Product Name", // Shows within upper-right dropdown during payment approval 
                "description": "Optional descriptive text..", // Item details will also be in the completed paypal.com transaction view 
                "unit_amount": {
                  "currency_code": "USD",
                  "value": "50"
                },
                "quantity": "2"
              },
            ]
          }]
      });
    },
*/

        // finalize the transaction
        /*onApprove: (data, actions) => {
            const captureOrderHandler = (details) => {
                const payerName = details.payer.name.given_name;
                console.log('Transaction completed');
            };

            return actions.order.capture().then(captureOrderHandler);
        },
        */

         // Finalize the transaction after payer approval
         onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
                //console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                //alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

            // When ready to go live, remove the alert and show a success message within this page. For example:
            // var element = document.getElementById('paypal-button-container');
            // element.innerHTML = '';
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
            save_order_paypal(transaction.id,transaction.status);
          });
        },

        // handle unrecoverable errors
        onError: (err) => {
            console.error('An error prevented the buyer from checking out with PayPal');
            alert('Something went wrong. Please try again.');
        }
    });

    paypalButtonsComponent
        .render("#paypal-button-container")
        .catch((err) => {
            console.error('PayPal Buttons failed to render');
        });
   
  function save_order_paypal(transaction_id,transaction_status)
  {
    var data = $('#form-billing-address').serialize();
    if (transaction_status=='COMPLETED')
        transaction_status = 1;
    else 
        transaction_status = 0;   

    data+='&transaction_id='+transaction_id+'&transaction_status='+transaction_status;

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
                   alert('Thank you. We will contact you soon.');
                   location.href = "{!! route('page.index') !!}"    
                }

            });    
 }
  
</script>

