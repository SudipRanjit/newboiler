<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Webifi\Repositories\Boiler\BoilerRepository;
use App\Webifi\Repositories\Addon\AddonRepository;
use App\Webifi\Repositories\Device\DeviceRepository;
use App\Webifi\Repositories\Radiator\RadiatorRepository;
use App\Webifi\Repositories\Radiator\RadiatorTypeRepository;
use App\Webifi\Repositories\Radiator\RadiatorHeightRepository;
use App\Webifi\Repositories\Radiator\RadiatorLengthRepository;
use App\Webifi\Repositories\Radiator\RadiatorPriceRepository;
use App\Webifi\Repositories\Booking\BillingAddressRepository;
use App\Webifi\Repositories\Booking\OrderRepository;
use App\Webifi\Repositories\Booking\OrderDetailRepository;
use App\Webifi\Repositories\Booking\BookingRepository;
use App\Webifi\Repositories\Booking\BlockDateRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\BillingAddressRequest;
use Illuminate\Support\Str;
use App\Webifi\Services\StripeService;
use App\Mail\OrderNotificationToCustomer;
use Mail;

class BookingController extends Controller
{

  /**
   * Constructor
   * @param StripeService $StripeService
   *
   */
  public function __construct(StripeService $StripeService)
  {
     $this->StripeService = $StripeService;
  }

    /**
     * Show pages
     *
     * @return view
     */
    public function index(Request $request)
    {   
        $selection = $request->session()->get('selection');
        
        if (empty($selection))
        {
            //set flash message and redirect to first wizard
            return redirect()->route('page.index')
                             ->with('error', "Please select options." );
        }    
        
       /* if ($selection && !in_array('page.smart-devices', $selection['completed_wizard']))
        {
            //set flash message and redirect 
            return redirect()->route('page.smart-devices')
                            ->with('error', 'Please choose smart devices.');
        }
       */

        $Device = new DeviceRepository(app()) ;
        $devices = null;
        if (isset($selection['devices']))        
            $devices = $Device->getInArray([],'id',array_keys($selection['devices']));
        
        //dd($devices);    

        $Boiler = new BoilerRepository(app()) ;
        if (empty($selection['boiler']))
        {
            //redirect to boiler listing page
            return redirect()->route('page.boilers')
                             ->with('error', "Please choose a boiler." );
        }

        $boiler = $Boiler->find($selection['boiler']);
        if (!$boiler)
        {
            //redirect to boiler listing page
            return redirect()->route('page.boilers')
                             ->with('error', "Please choose a boiler." );
        }

        $Addon = new AddonRepository(app()) ;
        $addon = $Addon->find($selection['control']);
        if (!$addon)
        {
            //redirect to control listing page
            return redirect()->route('page.controls')
                             ->with('error', "Please choose a control." );   
        }

        $radiator = $radiator_type = $radiator_height = $radiator_length = $radiator_price = null;
        if (isset($selection['radiator']))
        {
            $Radiator = new RadiatorRepository(app()) ;        
            $radiator = $Radiator->find($selection['radiator']['id']);

            $RadiatorType = new RadiatorTypeRepository(app()) ;        
            $radiator_type = $RadiatorType->find($selection['radiator_type']);
            
            $RadiatorHeight = new RadiatorHeightRepository(app()) ;        
            $radiator_height = $RadiatorHeight->find($selection['radiator_height']);

            $RadiatorLength = new RadiatorLengthRepository(app()) ;        
            $radiator_length = $RadiatorLength->find($selection['radiator_length']);

            $RadiatorPrice = new RadiatorPriceRepository(app()) ;
            if (!empty($selection['radiator_type']) && !empty($selection['radiator_height']) && !empty($selection['radiator_length']))
                $radiator_price = $RadiatorPrice->findWithCondition(['radiator_type_id'=>$selection['radiator_type'],'radiator_height_id'=>$selection['radiator_height'],'radiator_length_id'=>$selection['radiator_length']]);
     
        }
        
        $BlockDate = new BlockDateRepository(app()) ;
        $block_dates = $BlockDate->getWithCondition(['publish'=>1],'date','asc',array('*'),1000)->pluck('date')->toArray();
        
        $block_dates = json_encode($block_dates);
        //dd($block_dates);    

        $item_list_json_for_paypal = $this->make_item_list_json_for_paypal();
        //dd($item_list_json_for_paypal);
        return view('pages.booking.index',compact('devices','boiler','addon','radiator','radiator_type','radiator_height','radiator_length','item_list_json_for_paypal','block_dates','radiator_price'));
    }

    /**
     * Not used, for testing purposes only
     */
    public function completeBooking(/*BillingAddress*/Request $request)
    {
       
        try
        {
            DB::beginTransaction();

            $selection = session()->get('selection');
           
            if (empty($selection))
                throw new \Exception('Session expired.');

            $input = $request->only([
              'first_name','last_name','email','contact_number','address_line_1','address_line_2','address_line_3','city','county','postcode','note','payment_option'  
            ]);

            //store in billing_addresses, orders, order_details, bookings

            $BillingAddressRepository = new BillingAddressRepository(app()) ;
            //$BillingAddress=app::make($BillingAddressRepository->getModel());
          
            //store in billing_addresses
            $billing_address_record = $BillingAddressRepository->store($input);
            
            //store in orders
            $OrderRepository = new OrderRepository(app()) ;
            
            /*$table->integer('payment_gateway_id');
            $table->bigInteger('billing_address_id')->default(null)->nullable();
            $table->string('transaction_id')->comment('system generated unique token to display in invoice and reports');
            $table->string('vendor_transaction_id')->comment('stripe, paypal token');
            $table->float('amount');
            $table->float('discount')->default(0);
            $table->float('conversion_charge')->default(0)->comment('charge for converting to a Combi boiler');
            $table->float('moving_boiler_charge')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0 = incomplete, 1 = complete');
            $table->boolean('card_payment')->default(0)->comment('0 = payment not using card, 0 = payment using card');
            */

            $order = [];
            if ($input['payment_option']=='paypal')
                $order['payment_gateway_id'] = 1;
            elseif ($input['payment_option']=='stripe')
                $order['payment_gateway_id'] = 2;
            
            $order['billing_address_id'] = $billing_address_record->id;     
            $order['transaction_id'] = uniqid();      
            $order['vendor_transaction_id'] = uniqid();
            $order['amount'] = $selection['total_price'];
            $order['conversion_charge'] = $selection['conversion_charge'];
            $order['moving_boiler_to'] = $selection['moving_boiler']['type'];
            $order['moving_boiler_charge'] = $selection['moving_boiler']['price'];
            $order['status'] = 1;
            $order['card_payment'] = 0;

            $order_record = $OrderRepository->store($order);

            //dd($order_record->id);

            //save in order_detail
            //save boiler in order_detail
            $OrderDetailRepository = new OrderDetailRepository(app()) ;
            $order_detail = [];

            /*$table->bigInteger('order_id');
            $table->bigInteger('product_id')->comment('should be either boiler_id, addon_id, radiator_id or device_id');
            $table->string('product')->comment('should be either Boiler, Addon, Radiator or Device');
            $table->float('price');
            $table->integer('quantity');
            $table->integer('radiator_type_id');
            $table->integer('radiator_height_id');
            $table->integer('radiator_length_id');
            */
            $order_detail['order_id'] = $order_record->id;
            $order_detail['product'] = 'Boiler';
            $order_detail['product_id'] = $selection['boiler'];
            
            //save boiler in order_details 
            $BoilerRepository = new BoilerRepository(app()) ;
            $boiler = $BoilerRepository->findWithCondition(['publish'=>1,'id'=>$selection['boiler']]);
            if (empty($boiler))
                throw new \Exception('Boiler not found.');
            
            $order_detail['price'] = $boiler->price;   
            $order_detail['discount'] = $boiler->discount;
            $order_detail['quantity'] = 1;
            $order_detail_record = $OrderDetailRepository->store($order_detail);
            //dd($order_detail_record); 

            //save addon in order_details
            $order_detail = [];
            $order_detail['order_id'] = $order_record->id;
            $order_detail['product'] = 'Addon';
            $order_detail['product_id'] = $selection['control'];
            
            $AddonRepository = new AddonRepository(app()) ;
            $addon = $AddonRepository->findWithCondition(['publish'=>1,'id'=>$selection['control']]);
            if (empty($addon))
                throw new \Exception('Addon not found.');
            
            $order_detail['price'] = $addon->price;   
            $order_detail['quantity'] = 1;
            $order_detail_record = $OrderDetailRepository->store($order_detail);
            //dd($order_detail_record);

            //save radiator in order_details
            if (!empty($selection['radiator']['id']))
            {
                $order_detail = [];
                $order_detail['order_id'] = $order_record->id;
                $order_detail['product'] = 'Radiator';
                $order_detail['product_id'] = $selection['radiator']['id'];
                
                $RadiatorRepository = new RadiatorRepository(app()) ;
                $radiator = $RadiatorRepository->findWithCondition(['publish'=>1,'id'=>$selection['radiator']['id']]);
                if (empty($radiator))
                    throw new \Exception('Radiator not found.');
                
                $order_detail['price'] = $radiator->price;   
                $order_detail['quantity'] = $selection['radiator']['quantity'];
                $order_detail['radiator_type_id'] = $selection['radiator_type'];
                $order_detail['radiator_height_id'] = $selection['radiator_height'];
                $order_detail['radiator_length_id'] = $selection['radiator_length'];
                $order_detail_record = $OrderDetailRepository->store($order_detail);
                //dd($order_detail_record);
            }

            //save device in order_details
            foreach ($selection['devices'] as $device_id=>$Device)
            {   
                $order_detail = [];
                $order_detail['order_id'] = $order_record->id;
                $order_detail['product'] = 'Device';
                $order_detail['product_id'] = $device_id;
                
                $DeviceRepository = new DeviceRepository(app()) ;
                $device = $DeviceRepository->findWithCondition(['publish'=>1,'id'=>$device_id]);
                if (empty($device))
                    throw new \Exception('Device not found.');
                
                $order_detail['price'] = $device->price;   
                $order_detail['quantity'] = $Device['quantity'];
                $order_detail_record = $OrderDetailRepository->store($order_detail);
                dump($order_detail_record);
                
            }

            DB::commit();

        }
        catch (\Exception $e)
        {
            DB::rollback();
            Log::error((string)$e);
            
            return redirect()->route('page.booking')
            ->with('error', "Something went wrong! Please try again. ".$e->getMessage());
            
        }
        
    }

    public function saveOrder(Request $request)
        {
          if($request->ajax())
          { 
            $success = false;
           
            try
            {
                DB::beginTransaction();

                $selection = session()->get('selection');
               
                if (empty($selection))
                    throw new \Exception('Session expired.');
    
                $input = $request->only([
                  'first_name','last_name','email','contact_number','address_line_1','address_line_2','address_line_3','city','county','postcode','note','payment_option','appointment_date','transaction_id','transaction_status'  
                  ,'customer_id','setup_intent'
                 ]);
    
                 $OrderRepository = new OrderRepository(app()) ;

                 if ($input['payment_option']=='stripe')
                 {
                   if (empty($input['customer_id']) || empty($input['setup_intent']))
                        throw new \Exception('customer_id or setup_intent_id is empty.');

                   if ($input['customer_id']=='undefined' || $input['setup_intent']=='undefined')
                        throw new \Exception('customer_id or setup_intent_id is empty.'); 
                  
                   //search for customer_id and setup_intent_id in orders table and avoid multiple entries
                   $orders = $OrderRepository->getWithCondition(['stripe_customer_id'=>$input['customer_id'],'stripe_setup_intent_id'=>$input['setup_intent']],'id','desc',['*'],10000);
                   if (count($orders))
                      throw new \Exception('Already placed order.');

                 } 
                
                //store in billing_addresses, orders, order_details, bookings
    
                $BillingAddressRepository = new BillingAddressRepository(app()) ;
                //$BillingAddress=app::make($BillingAddressRepository->getModel());
              
                $input['first_name'] = ucwords($input['first_name']);
                $input['last_name'] = ucwords($input['last_name']);
                //store in billing_addresses
                $billing_address_record = $BillingAddressRepository->store($input);
                
                //store in orders
                
                $order = [];
                if ($input['payment_option']=='paypal')
                    $order['payment_gateway_id'] = 1;
                elseif ($input['payment_option']=='stripe')
                    $order['payment_gateway_id'] = 2;
                elseif ($input['payment_option']=='pay_with_finance')
                    $order['payment_gateway_id'] = 3;
                
                $order['billing_address_id'] = $billing_address_record->id;     
                $order['transaction_id'] = strtoupper(uniqid());      
                
                $order['vendor_transaction_id'] = isset($input['transaction_id'])?$input['transaction_id']:'';

                $order['amount'] = $selection['total_price'];
                $order['conversion_charge'] = $selection['conversion_charge'];
                $order['moving_boiler_to'] = $selection['moving_boiler']['type'];
                $order['moving_boiler_charge'] = $selection['moving_boiler']['price'];
                if (isset($input['transaction_status']))
                    $order['status'] = $input['transaction_status'];
                
                if ($input['payment_option']=='stripe')
                {
                  
                    $order['stripe_customer_id'] = $input['customer_id'];
                   
                    $order['stripe_setup_intent_id'] = $input['setup_intent'];
                }

                if ($input['payment_option']=='paypal')
                    {
                        $order['payout_amount'] = $order['amount'];
                        $order['payout_date'] = date('Y-m-d H:i:s');
                    }   
    
                $order_record = $OrderRepository->store($order);
    
                //dd($order_record->id);
    
                //save in order_detail
                //save boiler in order_detail
                $OrderDetailRepository = new OrderDetailRepository(app()) ;
                $order_detail = [];
                $order_detail['order_id'] = $order_record->id;
                $order_detail['product'] = 'Boiler';
                $order_detail['product_id'] = $selection['boiler'];
                
                //save boiler in order_details 
                $BoilerRepository = new BoilerRepository(app()) ;
                $boiler = $BoilerRepository->findWithCondition(['publish'=>1,'id'=>$selection['boiler']]);
                if (empty($boiler))
                    throw new \Exception('Boiler not found.');
                
                $order_detail['price'] = $boiler->price;   
                $order_detail['discount'] = $boiler->discount;
                $order_detail['quantity'] = 1;
                $order_detail_record = $OrderDetailRepository->store($order_detail);
                //dd($order_detail_record); 
    
                //save addon in order_details
                $order_detail = [];
                $order_detail['order_id'] = $order_record->id;
                $order_detail['product'] = 'Addon';
                $order_detail['product_id'] = $selection['control'];
                
                $AddonRepository = new AddonRepository(app()) ;
                $addon = $AddonRepository->findWithCondition(['publish'=>1,'id'=>$selection['control']]);
                if (empty($addon))
                    throw new \Exception('Addon not found.');
                
                $order_detail['price'] = $addon->price;   
                $order_detail['quantity'] = 1;
                $order_detail_record = $OrderDetailRepository->store($order_detail);
                //dd($order_detail_record);
    
                //save radiator in order_details
                if (!empty($selection['radiator']['id']))
                {
                    $order_detail = [];
                    $order_detail['order_id'] = $order_record->id;
                    $order_detail['product'] = 'Radiator';
                    $order_detail['product_id'] = $selection['radiator']['id'];
                    
                    $RadiatorRepository = new RadiatorRepository(app()) ;
                    $radiator = $RadiatorRepository->findWithCondition(['publish'=>1,'id'=>$selection['radiator']['id']]);
                    if (empty($radiator))
                        throw new \Exception('Radiator not found.');
                    
                    $RadiatorPrice = new RadiatorPriceRepository(app()) ; 

                    $radiator_price = null; 
                    if (!empty($selection['radiator_type']) && !empty($selection['radiator_height']) && !empty($selection['radiator_length']))
                        $radiator_price = $RadiatorPrice->findWithCondition(['radiator_type_id'=>$selection['radiator_type'],'radiator_height_id'=>$selection['radiator_height'],'radiator_length_id'=>$selection['radiator_length']]);
                                
                    if (empty($radiator_price))
                        throw new \Exception('Radiator Price not found.');
                                        
                    $order_detail['price'] = $radiator_price->price;   
                    $order_detail['quantity'] = $selection['radiator']['quantity'];
                    $order_detail['radiator_type_id'] = $selection['radiator_type'];
                    $order_detail['radiator_height_id'] = $selection['radiator_height'];
                    $order_detail['radiator_length_id'] = $selection['radiator_length'];
                    $order_detail['radiator_price_id'] = $radiator_price->id;
                    $order_detail['radiator_btu'] = $radiator_price->btu;
                    $order_detail_record = $OrderDetailRepository->store($order_detail);
                    //dd($order_detail_record);
                }
    
                //save device in order_details
                if (!empty($selection['devices']))
                {
                    foreach ($selection['devices'] as $device_id=>$Device)
                        {   
                            $order_detail = [];
                            $order_detail['order_id'] = $order_record->id;
                            $order_detail['product'] = 'Device';
                            $order_detail['product_id'] = $device_id;
                            
                            $DeviceRepository = new DeviceRepository(app()) ;
                            $device = $DeviceRepository->findWithCondition(['publish'=>1,'id'=>$device_id]);
                            if (empty($device))
                                throw new \Exception('Device not found.');
                            
                            $order_detail['price'] = $device->price;   
                            $order_detail['quantity'] = $Device['quantity'];
                            $order_detail_record = $OrderDetailRepository->store($order_detail);
                            //dump($order_detail_record);
                        }
                }

                //save in booking
                $BookingRepository = new BookingRepository(app()) ;
                $booking = [];
                
                $booking['order_id'] = $order_record->id;     
                $booking['booking_id'] = strtoupper(uniqid());      
                $booking['appointment_date'] = date('Y-m-d', strtotime($input['appointment_date']));
                $booking['amount'] = $selection['total_price'];
                $booking['status'] = 0;

                $booking_record = $BookingRepository->store($booking);

                DB::commit();

                $success = true;

                $request->session()->forget('selection'); 

                return response()->json(['success'=>$success,'order_id'=>$order_record->transaction_id]);
    
            }
            catch (\Exception $e)
            {
                DB::rollback();
                Log::error((string)$e);
                
                return response()->json(['success'=>$success,'message'=>$e->getMessage()]);
                
            }
         }    
       }
  
    public function send_order_notification_email_to_customer($order)
    {
      try
        {
            $body = [
                'name'=>ucwords($order->billing_address->first_name.' '.$order->billing_address->last_name),
                'email'=>$order->billing_address->email
            ];
    
            Mail::to($body['email'])->send(new OrderNotificationToCustomer($body,$order));
            return ['success'=>true];
        }
        catch(\Exception $e)
        {
            return ['success'=>false,'error_message'=>$e->getMessage()];
        }
    }
    
    public function ajSendOrderNotificationEmailToCustomer(Request $request)
    {
        if ($request->ajax())
        {
          try
            {
                $order_id = $request->order_id;
                if (empty($order_id))
                    throw new \Exception('Empty order id');
                
                $OrderRepository = new OrderRepository(app());
                $order = $OrderRepository->findWithCondition(['transaction_id'=>$order_id]);
                if (empty($order))
                    throw new \Exception('Order not found.');
                
                $response = $this->send_order_notification_email_to_customer($order);    
                if (!$response['success'])
                    throw new \Exception($response['error_message']);
                
                return ['success'=>true];    
            }
          catch(\Exception $e)
            {
                return ['success'=>false,'error_message'=>$e->getMessage()];
            }  
        }
    }
    
    /**
     * make item list json for submitting to paypal
     * format:
     * "items": [
            {
              "name": "First Product Name",
              "description": "Optional descriptive text..", 
              "unit_amount": {
                "currency_code": "USD",
                "value": "50"
              },
              "quantity": "2"
            },
          ]
     *  
     * return json     
     */
   public function make_item_list_json_for_paypal()
   {
        $selection = session()->get('selection');
        $items = [];
        if (!empty($selection))
        {
            if (!empty($selection['boiler']))    
                {
                    $Boiler = new BoilerRepository(app()) ;        
                    $boiler = $Boiler->find($selection['boiler']);
                    if ($boiler)
                    {
                        $item = [];
                        $item['name'] = $boiler->boiler_name;
                        $item['description'] = 'Boiler ID: '.$boiler->id;
                        if (!empty($boiler->summary))
                            $item['description'].=', Summary: '.Str::of($boiler->summary)->limit(20);
                        
                        $price = $boiler->price - $boiler->discount??0;
                        $item['unit_amount']['currency_code'] = 'GBP';
                        $item['unit_amount']['value'] = $price;
                        $item['quantity'] = 1;

                        $items[] = $item;
                    }
                }
            
            if (!empty($selection['control']))    
                {
                    $Addon = new AddonRepository(app()) ;        
                    $addon = $Addon->find($selection['control']);
                    if ($addon)
                    {
                        $item = [];
                        $item['name'] = $addon->addon_name;
                        $item['description'] = 'Control ID: '.$addon->id;
                        if (!empty($addon->summary))
                            $item['description'].= ', Summary: '.Str::of($addon->summary)->limit(20);
                        
                        $price = $addon->price;
                        $item['unit_amount']['currency_code'] = 'GBP';
                        $item['unit_amount']['value'] = $price;
                        $item['quantity'] = 1;
                        
                        $items[] = $item;
                    }
                }

            if (!empty($selection['devices']))    
                {
                    $devices = $selection['devices'];
                    $Device = new DeviceRepository(app()) ;
                    foreach($devices as $device_id=>$d)
                    {
                        $device = $Device->find($device_id);
                        if ($device)
                        {
                            $item = [];
                            $item['name'] = $device->device_name;
                            $item['description'] = 'Device ID: '.$device->id;
                            if (!empty($device->summary))
                                $item['description'].= ', Summary: '.Str::of($device->summary)->limit(20);
                            
                            $price = $device->price;
                            $item['unit_amount']['currency_code'] = 'GBP';
                            $item['unit_amount']['value'] = $price;
                            $item['quantity'] = $d['quantity'];
                        
                            $items[] = $item;
                        }
                    }    
                }
                
                if (!empty($selection['radiator']['id']))    
                {
                    $Radiator = new RadiatorRepository(app()) ;        
                    $radiator = $Radiator->find($selection['radiator']['id']);
                    if ($radiator)
                    {
                        $RadiatorPrice = new RadiatorPriceRepository(app()) ;    
                        if (!empty($selection['radiator_type']) && !empty($selection['radiator_height']) && !empty($selection['radiator_length']))
                            $radiator_price = $RadiatorPrice->findWithCondition(['radiator_type_id'=>$selection['radiator_type'],'radiator_height_id'=>$selection['radiator_height'],'radiator_length_id'=>$selection['radiator_length']],['price','btu']);
                        
                        $item = [];
                        $item['name'] = $radiator->radiator_name;
                        $item['description'] = 'Radiator ID: '.$radiator->id;
                        $item['description'].=',type: '.$selection['radiator_type'];
                        $item['description'].=',height: '.$selection['radiator_height'];
                        $item['description'].=',length: '.$selection['radiator_length'];
                        $item['description'].=',btu: '.$radiator_price->btu;
                        /*if (!empty($radiator->summary))
                            $item['description'].=', Summary: '.Str::of($radiator->summary)->limit(10);
                        */                        
                        $price = $radiator_price->price; 
                        $item['unit_amount']['currency_code'] = 'GBP';
                        $item['unit_amount']['value'] = $price;
                        $item['quantity'] = $selection['radiator']['quantity'];
                    
                        $items[] = $item;
                    }
                }

                if (!empty($selection['conversion_charge']))
                    {
                        $price =  $selection['conversion_charge'];

                        $item = [];
                        $item['name'] = "Boiler conversion charge(converting to Combi boiler)";
                        $item['description'] = 'Amount: '.$price;
                        $item['unit_amount']['currency_code'] = 'GBP';
                        $item['unit_amount']['value'] = $price;
                        $item['quantity'] = 1;
                    
                        $items[] = $item;
                    }

                if (!empty($selection['moving_boiler']))
                    {
                        $price =  $selection['moving_boiler']['price'];
                        $item = [];
                        $item['name'] = "Moving boiler to: ".$selection['moving_boiler']['type'];
                        $item['description'] = 'Amount: '.$price;
                        $item['unit_amount']['currency_code'] = 'GBP';
                        $item['unit_amount']['value'] = $price;
                        $item['quantity'] = 1;
                    
                        $items[] = $item;
                    }
                  
        }

        return json_encode($items);
   }
   
   /**
    * Not used, for testing purpose only
    */
   public function deletePreviousStripeOrder($customer_id,$setup_intent_id)
   {
        $OrderRepository = new OrderRepository(app()) ;

        $orders = $OrderRepository->getWithCondition(['stripe_customer_id'=>$customer_id,
                                                      'stripe_setup_intent_id'=>$setup_intent_id,  
                                                     ]
                                                    ,'id'
                                                    ,'desc'
                                                    ,['*']
                                                    ,10000);
        
                                                    
        if (!count($orders))
            return;
        
        foreach($orders as $order)
        {
            $order->billing_address->delete();
            $order->booking->delete();
            foreach ($order->order_details as $order_detail) {
            $order_detail->delete();
            }
            $order->delete();
        }  
   }

   /**
    * Not used, for testing purpose only
    */
   public function deleteStripeOrder(Request $request)
   {
    if($request->ajax()) 
     { 
       try
       {
           DB::beginTransaction();

           $input = $request->only([
            'customer_id','setup_intent_id' 
            ]);
           
           if (empty($input['customer_id']) && empty($input['setup_intent_id']))
                throw new \Exception('Empty parameters.');

           $OrderRepository = new OrderRepository(app()) ;

           $orders = $OrderRepository->getWithCondition(['stripe_customer_id'=>$input['customer_id'],
                                                         'stripe_setup_intent_id'=>$input['setup_intent_id'],  
                                                        ]
                                                        ,'id'
                                                        ,'desc'
                                                        ,['*']
                                                        ,10000);
           
            //dd($orders->isEmpty());                                            
            if (!count($orders))
                throw new \Exception('Empty order.');

         $order_ids = [];  
         foreach($orders as $order)
         {
           $order->billing_address->delete();
           $order->booking->delete();
           foreach ($order->order_details as $order_detail) {
            $order_detail->delete();
           }
           $order->delete();
           $order_ids[] = $order->id;
         }  

           DB::commit();

           $success = true;

           return response()->json(['success'=>$success, 'orders'=>$order_ids]);

       }
       catch (\Exception $e)
       {
           DB::rollback();
           
           $success = false;
           return response()->json(['success'=>$success,'message'=>(String)$e]);
           
       }
    }  
   }

  /* public function getPaymentIntentClientSecret(Request $request)
   {
                try {

                    \Stripe\Stripe::setApiKey(config('stripe.secret_key'));
                    
                       // Create a PaymentIntent with amount and currency
                        $paymentIntent = \Stripe\PaymentIntent::create([
                            'amount' => 10000,
                            'currency' => 'gbp',
                            'automatic_payment_methods' => [
                            'enabled' => true,
                            ],
                        ]);
                        
                    return response()->json(['success'=>true,'clientSecret'=>$paymentIntent->client_secret]);
                    }

                catch(Error $e)
                {
                    return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
                }   

          
    }
   */

    public function createStripeCustomerAndClientSecret()
    {
        try {

            $response =  $this->StripeService->createStripeCustomerAndClientSecret();
            if (!$response['success'])
                throw new \Exception($response['error']);
            
            $customer_id = $response['customer_id'];
            $clientSecret = $response['clientSecret'];    
            $setup_intent_id = $response['setup_intent_id'];

            return response()->json(['success'=>true,'customer'=>$customer_id,'clientSecret'=>$clientSecret,'setup_intent'=>$setup_intent_id]);
            }

        catch(\Exception $e)
        {
            return response()->json(['success'=>false, 'error'=>(String)$e]);
        }
    }

    /*public function testStripeListPaymentMethods()
    {
        $customer_id = "cus_MOQPKUu2gdopkJ";
     
        try {

                $stripe = new \Stripe\StripeClient(config('stripe.secret_key'));
                
                $payment_methods = $stripe->paymentMethods->all(['customer' => $customer_id, 'type' => 'card']);
                            
                return response()->json(['success'=>true,'payment_methods'=>$payment_methods]);
            }

            catch(\Exception $e)
            {
                return response()->json(['success'=>false, 'message'=>(String)$e]);
            }
     }

     public function testStripeFuturePayout()  
     {
        $customer_id = "cus_MOQPKUu2gdopkJ";

        try
         {

                $stripe = new \Stripe\StripeClient(config('stripe.secret_key'));

                $payment_methods = $stripe->paymentMethods->all(['customer' => $customer_id, 'type' => 'card']);

                //dd($payment_methods['data'][0]['id']);  
                if (empty($payment_methods['data']))
                    throw new \Exception('Payment methods not found.');

                  
                $payment_method_id = $payment_methods['data'][0]['id'] ;

                $payment_intent =  $stripe->paymentIntents->create([
                'amount' => 30000,
                'currency' => 'gbp',
                'customer' => $customer_id,
                'payment_method' => $payment_method_id,
                'off_session' => true,
                'confirm' => true,
                ]);

                return response()->json(['success'=>true,'payment_intent'=>$payment_intent]);
        } 
        catch (\Stripe\Exception\CardException $e)
        {
            // Error code will be authentication_required if authentication is needed
            //echo 'Error code is:' . $e->getError()->code;
            //$payment_intent_id = $e->getError()->payment_intent->id;
            //$payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
            return response()->json(['success'=>false, 'message'=>(string)$e]);
        }
        catch (\Exception $e)
        {
            return response()->json(['success'=>false, 'message'=>(string)$e]);
        }
    }*/
    
    public function thankyou_page(Request $request)
    {
        if( !$request->has('payment_option') ) 
        {
            return redirect()->route('page.index')
                             ->with('error', "Please select options." );

        }

        $selection = session()->get('selection');
        if ($request->query('payment_option')=='stripe' && empty($selection))
            return redirect()->route('page.index')
                             ->with('error', "Please select options." );
        
        $referer = $request->headers->get('referer');
        //dd($referer);
        if (strpos($referer,'/booking')===false) 
            return redirect()->route('page.index')
                             ->with('error', "Please select options." );

        return view('pages.booking.thankyou');
    }

    public function updateStripeCustomer(Request $request)
    {
        if($request->ajax())
        {
            try {

                $input = $request->all();
                if (empty($input['customer_id']))
                    throw new \Exception('Empty customer_id');

                if (empty($input['email']) || empty($input['first_name']) || empty($input['last_name']) || empty($input['contact_number'])
                    || empty($input['address_line_1']) || empty($input['city']) || empty($input['postcode'])
                    )
                    throw new \Exception('Empty required parameters.');    
                
                $params = [];
                $params['email'] = $input['email'];
                $params['name'] = ucwords($input['first_name'].' '.$input['last_name']);
                $params['phone'] = $input['contact_number']; 

                $params['address']['line1'] = $input['address_line_1'];
                if (trim($input['address_line_2'])!='')
                    $params['address']['line2'] = $input['address_line_2'];
                $params['address']['city'] = $input['city'];
                $params['address']['postal_code'] = $input['postcode'];
                if (trim($input['county'])!='')
                    $params['address']['state'] = $input['county'];    
                
                $params['shipping']['name'] = ucwords($input['first_name'].' '.$input['last_name']);
                
                $params['shipping']['address']['line1'] = $input['address_line_1'];
                if (trim($input['address_line_2'])!='')
                    $params['shipping']['address']['line2'] = $input['address_line_2'];
                $params['shipping']['address']['city'] = $input['city'];
                $params['shipping']['address']['postal_code'] = $input['postcode'];
                if (trim($input['county'])!='')
                    $params['shipping']['address']['state'] = $input['county'];    
    
                $params['metadata']['order_id'] = $input['order_id'];    

                $response =  $this->StripeService->update_customer($input['customer_id'], $params);
                if (!$response['success'])
                    throw new \Exception($response['error']);
               
                return response()->json(['success'=>true]);
                }
    
            catch(\Exception $e)
            {
                return response()->json(['success'=>false, 'error'=>(String)$e]);
            }    
       }
   }     

}
