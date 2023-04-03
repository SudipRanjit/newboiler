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
        $receiverNumber = $this->convertNumber($receiverNumber);
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

    /**
     * Convert to international number if local provided
     * 
     * @param $number
     * @return String
     */
    private function convertNumber($number)
    {
        // Check if the phone number starts with '0'
        if (substr($number, 0, 1) === '0') {
            // Add the country code prefix
            $countryCode = '+44'; // Country code for UK
            $phoneNumberWithCode = $countryCode . substr($number, 1);

            return $phoneNumberWithCode; 
        } else {
            $countryCode = '+44';
            return $countryCode . $number;
        }
    }


}
