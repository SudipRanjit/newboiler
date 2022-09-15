@section('pay_with_finance-scripts')

<script>

function pay_with_finance_submit(event)
{
    event.preventDefault();
    save_order_pay_with_finance();
}

 function add_pay_with_finance_submit_event()
 {
    const form = document.getElementById('form-billing-address');
    form.addEventListener('submit', pay_with_finance_submit);
 }  
 
 function remove_pay_with_finance_submit_event()
 {
    const form = document.getElementById('form-billing-address');
    form.removeEventListener('submit', pay_with_finance_submit);
 }

  function save_order_pay_with_finance()
  {
    var data = $('#form-billing-address').serialize();
    
    data+='&transaction_status=0';

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
                   if (data.success)
                    location.href = "{!! route('page.thankyou') !!}?payment_option=pay_with_finance";    
                   else
                    alert('Something went wrong. Please try again.');
                   
                }

            });    
  }
  
</script>

@endsection