<?php

namespace App\Webifi\Services;

use Twilio\Rest\Client;

/**
 * Class UserVerification
 * @package App\Webifi\Services
 */
class SMSService
{

    /**
     * Send SMS
     *
     * @param $receiverNumber
     * @param null $message
     * @return Array
     */
    public function sendSMS($receiverNumber = "", $message = "")
    {
        try {
  
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
            return ['success' => "SMS Sent!"];
  
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }


}
