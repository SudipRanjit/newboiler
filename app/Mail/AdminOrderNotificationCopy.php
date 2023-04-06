<?php

namespace App\Mail;

use App\Http\Requests\BillingAddressRequest;
use App\Webifi\Models\Booking\BillingAddress;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Webifi\Repositories\Boiler\BoilerRepository;
use App\Webifi\Repositories\Device\DeviceRepository;
use App\Webifi\Repositories\Addon\AddonRepository;
use App\Webifi\Repositories\Booking\BillingAddressRepository;
use App\Webifi\Repositories\Radiator\RadiatorRepository;
use App\Webifi\Repositories\Radiator\RadiatorPriceRepository;
use App\Webifi\Repositories\Booking\BookingRepository;
use App\Webifi\Repositories\Booking\OrderRepository;
use Illuminate\Support\Facades\Session;

class AdminOrderNotificationCopy extends Mailable
{
    use Queueable, SerializesModels;

    private $quote;

    private $boiler;

    private $body;

    private $order;

    private $billing;

    private $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body, $order, $id)
    {
        $this->quote = [];
        $boiler = new BoilerRepository(app());
        $this->boiler = $boiler->find($id);

        $BillingAddress = new BillingAddressRepository(app());
        $this->billing = $BillingAddress->find($order->billing_address_id);

        $Booking = new BookingRepository(app());
        $this->booking = $Booking->findBy('order_id', $order->id);

        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $selection = Session::get('selection');
        $extras = [];

        $Device = new DeviceRepository(app()) ;
        if (isset($selection['devices']))        
            $devices = $Device->getInArray([],'id',array_keys($selection['devices']));

        $k = 0;
        if(isset($devices)){
        foreach($devices as $device)
        {
            $extras['smart_device'][$k]['quantity'] = $selection['devices'][$device->id]['quantity'];
            $extras['smart_device'][$k]['name'] = $device->device_name;
            $extras['smart_device'][$k]['price'] = $device->price;
            $k++;
        }
    }
        if(isset($selection['control'])){
            $Addon = new AddonRepository(app()) ;
            $addon = $Addon->find($selection['control']);

            $extras['control_device']['name'] = $addon->addon_name;
            $extras['control_device']['price'] = $addon->price == "0.0" ? "Free" : $addon->price;
        }
        if (isset($selection['radiator']))
        {
            $Radiator = new RadiatorRepository(app()) ;        
            $radiator = $Radiator->find($selection['radiator']['id']);

            $extras['radiator']['name'] = $radiator->radiator_name;
           
            $RadiatorPrice = new RadiatorPriceRepository(app()) ;
            if (!empty($selection['radiator_type']) && !empty($selection['radiator_height']) && !empty($selection['radiator_length']))
                $radiator_price = $RadiatorPrice->findWithCondition(['radiator_type_id'=>$selection['radiator_type'],'radiator_height_id'=>$selection['radiator_height'],'radiator_length_id'=>$selection['radiator_length']]);
     
            $extras['radiator']['price'] = $radiator_price->price;
            $extras['radiator']['quantity'] = $selection["radiator"]["quantity"];
            
        }
        
        if(isset($selection["conversion_charge"]))
        {
            $extras['conversion_charge'] = $selection["conversion_charge"];
        }

        if(isset($selection["moving_boiler"]))
        {
            $extras['moving_boiler']['type'] = $selection["moving_boiler"]["type"];
            $extras['moving_boiler']['price'] = $selection["moving_boiler"]["price"];
        }

        if(isset($selection["scaffolding"]))
        {
            $extras['scaffolding']['type'] = $selection["scaffolding"]["type"];
            $extras['scaffolding']['price'] = $selection["scaffolding"]["price"];
        }
        $extras['totalPrice'] = $selection['total_price'];
        // $extras['quote_id'] = $this->quote->id;
        // $extras['quote_token'] = $this->quote->token;
        // $extras['step_url'] = route('saved.quote', ['id' => $this->quote->id, 'token' => $this->quote->token]);
        if(isset($selection["total_price"]))
            $extras['totalPrice'] = $selection["total_price"];

        return $this->subject('- Booking confirmation from Gasking')->markdown('email.admin_booking_copy')->with('order', $this->order->toArray())->with('booking', $this->booking->toArray())->with('billing', $this->billing->toArray())->with('boiler',$this->boiler->toArray())->with('extras', $extras);
    }
}
