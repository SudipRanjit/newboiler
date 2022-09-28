<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PayoutNotificationToCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $body;
    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body, $booking)
    {
        $this->body = $body;
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Payment Notification')->markdown('cms.booking.booking.payout_notification_to_customer_email')->with('body',$this->body)->with('booking',$this->booking);
    }
}
