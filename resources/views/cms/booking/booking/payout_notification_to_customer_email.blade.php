@component('mail::message')
<h2>Dear {{$body['name']}},</h2>
Payment of <b>&pound;{{ $booking->order->payout_amount }}</b> has been done for the boiler installment.
<br/><br/>
<h3>Details:</h3>
Order ID: {{ $booking->order->transaction_id }} <br/>
Payment Method: {{ $booking->order->payment_gateway->title }} <br/>
Appointment Date: {{ date('Y-m-d',strtotime($booking->appointment_date)) }} <br/> 
Booking ID: {{ $booking->booking_id }} <br/>
Payment Amount (&pound;): {{  $booking->amount }} <br/>
Discount (&pound;): {{  $booking->discount }} <br/>
Net Payment Amount (&pound;): {{  $booking->amount - $booking->discount }} <br/>
Paid Amount (&pound;): {{  $booking->order->payout_amount }} <br/>
<br/>
<h3>Items</h3>
@php $product_total_amount = $sno = 0; @endphp
@foreach($booking->order->order_details as $order_detail)
        @if($order_detail->product=='Boiler')
        <b>{{ ++$sno }}. Boiler: {{ $order_detail->boiler()->boiler_name }} </b><br/>
        @elseif($order_detail->product=='Addon')
        <b>{{ ++$sno }}. Control: {{ $order_detail->addon()->addon_name }} </b><br/>
        @elseif($order_detail->product=='Radiator')
        <b>{{ ++$sno }}. Radiator: {{ $order_detail->radiator()->radiator_name }} </b><br/>
            Type: {{ $order_detail->radiator_type()->exists() ? $order_detail->radiator_type->type:'' }} <br/>
            Height: {{ $order_detail->radiator_height()->exists() ? $order_detail->radiator_height->height:'' }} mm <br/>
            Length: {{ $order_detail->radiator_length()->exists() ? $order_detail->radiator_length->length:'' }} mm <br/>
            BTU: {{ $order_detail->radiator_btu }} <br/>
        @elseif($order_detail->product=='Device')
        <b>{{ ++$sno }}. Device: {{ $order_detail->device()->device_name }} </b><br/> 
        @endif
        Price(&pound;): {{ $order_detail->price }} <br/>
        Discount(&pound;): {{ $order_detail->discount }} <br/>
        Quantity: {{ $order_detail->quantity }} <br/>
        @php
              
                $total = round(($order_detail->price - $order_detail->discount) * $order_detail->quantity,2);
                $product_total_amount+= $total; 
                 
        @endphp
        <b>Amount(&pound;): {{ $total }} </b><br/> 
@endforeach
@if(!empty($booking->order->conversion_charge))
<b>{{ ++$sno }}. Boiler Conversion Charge (converting to a Combi boiler, &pound;): {{ $booking->order->conversion_charge }} </b><br/>
@php $product_total_amount+=$booking->order->conversion_charge @endphp
@endif
@if(!empty($booking->order->moving_boiler_charge))
<b>{{ ++$sno }}. Moving Boiler Charge (moving to {{ $booking->order->moving_boiler_to }}, &pound;): {{ $booking->order->moving_boiler_charge }} </b><br/>
@php $product_total_amount+=$booking->order->moving_boiler_charge @endphp
@endif 
<br/>
<b>Grand Total(&pound;): {{ $product_total_amount }} </b> <br/><br/>
 
{{--
@component('mail::button', ['url' => ''])
Button Text
@endcomponent
--}}
Thanks,<br>
{{ config('app.name') }}
@endcomponent
