<?php

namespace App\Http\Controllers\CMS\Booking;

use App\Webifi\Models\Booking\Booking;
use App\Webifi\Repositories\Booking\BookingRepository;
use App\Webifi\Repositories\Booking\OrderRepository;
use App\Http\Requests\BookingRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;
use App\Mail\PayoutNotificationToCustomer;
use Mail;

class BookingController extends Controller
{
  /**
   * BookingRepository $booking
   */
  private $booking;
  
  /**
   * @var DatabaseManager
   */
  private $db;

  /**
   * @var LoggerInterface
   */
  private $log;

  /**
   * BookingController constructor.
   * @param BookingRepository $booking
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    BookingRepository $booking,
    OrderRepository $order,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->booking   = $booking;
    $this->order   = $order;
    $this->db       = $db;
    $this->log      = $log;
  }

  /**
   * Show all booking
   * 
   * @return View
   */
  public function index()
  { 
    $this->authorize('view', Booking::class);
    $bookings = $this->booking->paginate(20);
    return view('cms.booking.booking.index')->with('bookings', $bookings);
  }

  /**
   * Search all booking
   *
   * @param Request $request
   * @return View
   */
  public function search(Request $request)
  {
    $this->authorize('view', Booking::class);
    $bookings = $this->booking->searchWithMultipleCondition([] ,$request->search_txt, "id", "desc", ['*'], 20);
    return view('cms.booking.booking.index')->with('bookings', $bookings)->with("searchTxt", $request->search_txt);
  }
  
  /**
   * Show form to edit booking
   *
   * @param Booking $booking
   * @return View
   */
  public function edit(Booking $booking)
  {
    $this->authorize('update', Booking::class);

    return view('cms.booking.booking.edit')
      ->with('booking', $booking);
  }

  /**
   * Update booking detail
   *
   * @param BookingRequest $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(BookingRequest $request, $id)
  {
    $this->authorize('update', Booking::class);

    $booking = $this->booking->find($id);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'appointment_date','amount','discount','status','note' 
        
      ]);
      
      $this->booking->update($id, $input);
      $this->db->commit();

      return redirect()->route('cms::bookings.index')
        ->with('success', 'Booking updated successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::bookings.edit', ['booking' => $id])
        ->with('error', 'Failed to update booking. ' . $e->getMessage())
        ->withInput();
    }
  }

  public function stripe_payout(Request $request)  
     {
        $this->authorize('stripe_payout', Booking::class);
        //$customer_id = "cus_MOQPKUu2gdopkJ";

        try
         {

                $input = $request->only([
                  'customer_id','booking_id' 
                  
                ]);
          
                if (empty($input['customer_id']))
                  throw new \Exception('Customer is empty.');

                $booking = $this->booking->find($input['booking_id']);
                
                if (empty($booking))
                  throw new \Exception('Booking is empty.');

                if ($booking->order->status=='1')
                  throw new \Exception('Payout is already done from customer.');

                $payout_amount = round($booking->amount - $booking->discount,2); 

                $stripe = new \Stripe\StripeClient(config('stripe.secret_key'));

                $payment_methods = $stripe->paymentMethods->all(['customer' => $input['customer_id'], 'type' => 'card']);

                //dd($payment_methods['data'][0]['id']);  
                if (empty($payment_methods['data']))
                    throw new \Exception('Payment methods not found.');
                  
                $payment_method_id = $payment_methods['data'][0]['id'] ;

                $payment_intent =  $stripe->paymentIntents->create([
                'amount' => $payout_amount*100,
                'currency' => 'gbp',
                'customer' => $input['customer_id'],
                'payment_method' => $payment_method_id,
                'off_session' => true,
                'confirm' => true,
                'description' =>"Booking ID: ".$booking->booking_id.', '."Order ID: ".$booking->order->transaction_id,
                'metadata' =>["Booking ID"=>$booking->booking_id,"Order ID"=>$booking->order->transaction_id]
                ]);

                //store payment intent id on orders table
                $order = $this->order->find($booking->order->id);
                
                $updates = [];
                $updates['vendor_transaction_id'] = $payment_intent->id;
                $updates['stripe_payment_method_id'] = $payment_method_id;
                $updates['status'] = 1;
                $updates['payout_amount'] = $payout_amount;

                $id = $order->id;
                $this->order->update($id, $updates);

                $booking = $this->booking->find($input['booking_id']);
                $this->send_payout_notification_email_to_customer($booking);

                return redirect()->route('cms::bookings.index')
                                 ->with('success', 'Payout successfull.');
        } 
        catch (\Stripe\Exception\CardException $e)
        {
            // Error code will be authentication_required if authentication is needed
            //echo 'Error code is:' . $e->getError()->code;
            //$payment_intent_id = $e->getError()->payment_intent->id;
            //$payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
            $this->log->error((string)$e);
            return redirect()->route('cms::bookings.index')
                           ->with('error', $e->getMessage());
        }
        catch (\Exception $e)
        {
          $this->log->error((string)$e);
          return redirect()->route('cms::bookings.index')
                           ->with('error', $e->getMessage());
        }
    }

  public function send_payout_notification_email_to_customer($booking)
  {
    try
      {
          $body = [
              'name'=>ucwords($booking->order->billing_address->first_name.' '.$booking->order->billing_address->last_name),
              'email'=>$booking->order->billing_address->email
          ];
  
          Mail::to($body['email'])->send(new PayoutNotificationToCustomer($body,$booking));
          return ['success'=>true];
      }
      catch(\Exception $e)
      {
          return ['success'=>false,'error_message'=>$e->getMessage()];
      }
  }  
}
