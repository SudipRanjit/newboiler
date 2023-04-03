<?php

namespace App\Webifi\Services;

use Twilio\Rest\Client;
use Psr\Log\LoggerInterface;

/**
 * Class UserVerification
 * @package App\Webifi\Services
 */
class SMSService
{
    /**
     * LoggerInterface $log
     */
    private $log;

    /**
     * SMSService
     * 
     * @param LoggerInterface $log
     */
    public function __construct(LoggerInterface $log)
    {   
        $this->log = $log;
    }

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
            $this->log->info("SMS sent to ".$receiverNumber);
            return ['success' => "SMS Sent!"];
  
        } catch (\Exception $e) {
            $this->log->error((string) $e);
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
        $countryCode = '+44'; // Country code for UK

        // Check if the phone number starts with '0'
        if (substr($number, 0, 1) === '0') {
            // Add the country code prefix
            $phoneNumberWithCode = $countryCode . substr($number, 1);

            return $phoneNumberWithCode; 
        } else {
            return $countryCode . $number;
        }
    }


}
