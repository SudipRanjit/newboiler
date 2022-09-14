<?php

namespace App\Webifi\Services;


class StripeService
{
    
    /**
     * @var $stripe_scret_key
     */
    private $stripe_scret_key;

    public function __construct()
    {
        //$this->stripe = new \Stripe\StripeClient(config('stripe.secret_key'));
        $this->stripe_secret_key = config('stripe.secret_key');
        //$this->stripe_secret_key = 12;
    }

    public function createStripeCustomerAndClientSecret()
    {
        try {

            $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
            
            $customer = $stripe->customers->create([
                //'description' => 'My First Test Customer (created for API docs at https://www.stripe.com/docs/api)',
              ]);

            $setup_intent = $stripe->setupIntents->create(
                [
                  'customer' => $customer->id,
                  'payment_method_types' => ['card'],
                ]);
            
                
           
            /*$update_customer = $this->StripeService->update_customer($customer->id,['email'=>'rabinsth1111@gmail.com']);
            if (empty($update_customer['response']))
                throw new \Exception($update_customer['error']); 
            */
            
            return ['success'=>true,'customer_id'=>$customer->id,'clientSecret'=>$setup_intent->client_secret,'setup_intent_id'=>$setup_intent->id];
            }

        catch(\Exception $e)
        {
            return ['success'=>false, 'error'=>(String)$e];
        }
    }


    public function update_customer($customer_id, $params)
    {
        try
        {
            $this->stripe = new \Stripe\StripeClient($this->stripe_secret_key);

            $response = $this->stripe->customers->update(
                $customer_id,
                $params
              );

            return ['response'=>$response];  
        }
        catch(\Exception $e)
        {
            return ['response'=>null, 'error'=>(String)$e];
        }
        
    }

}
