<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderNotificationToCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $body;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body, $order)
    {
        $this->body = $body;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Notification')->markdown('pages.booking.order_notification_to_customer_email')->with('body',$this->body)->with('order',$this->order);
    }
}
