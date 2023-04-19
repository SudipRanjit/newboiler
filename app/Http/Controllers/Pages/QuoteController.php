<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Mail\SaveQuote;
use App\Webifi\Repositories\Boiler\BoilerRepository;
use App\Webifi\Repositories\Quote\QuoteRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;
use Illuminate\Support\Facades\Mail;
use App\Webifi\Services\SMSService;
use App\Webifi\Repositories\Booking\OrderRepository;
use Illuminate\Support\Facades\Session;

class QuoteController extends Controller
{
    /**
     * QuoteRepository $quote
     */
    private $quote;

    /**
     * BoilerRepository $boiler
     */
    private $boiler;

    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * @var LoggerInterface
     */
    private $log;

    /**
     * SMSService $sms
     */
    private $sms;

    /**
     * OrderRepository $order
     */
    private $order;

    /**
     * QuoteController constructor.
     * @param QuoteRepository $quote
     * @param BoilerRepository $boiler
     * @param DatabaseManager $db
     * @param LoggerInterface $log
     * @param SMSService $sms
     * @param OrderRepository $order
     */
    public function __construct(
        QuoteRepository $quote,
        BoilerRepository $boiler,
        DatabaseManager $db,
        LoggerInterface $log,
        SMSService $sms,
        OrderRepository $order
    ) {
        $this->quote = $quote;
        $this->boiler = $boiler;
        $this->db = $db;
        $this->log = $log;
        $this->sms = $sms;
        $this->order = $order;
    }

    /**
     * Save quote
     *
     * @return View
     */
    public function saveQuote(Request $request)
    {
        // $quote = $this->quote->findWithCondition(['email' => $request->email, 'boiler' => $request->boiler]);
        // if($quote != null)
        // {
        //     return ['message' => 'You\'ve already saved quote for this boiler!'];
        // }

        try {
            $this->db->beginTransaction();

            $input = $request->only([
                'selection',
                'boiler',
                'email',
                'contact',
                'saved_url',
            ]);

            $boiler = $this->boiler->find($request->boiler);

            $input['offered_price'] = $boiler->price - $boiler->discount;
            $input['total_price'] = $boiler->price;
            $input['token'] = rand(11111, 99999) . time();

            $id = $this->quote->store($input);
            $this->db->commit();

            $booking_link = route('saved.quote', ['id' => $id, 'token' => $input['token']]);

            $input['boiler_name'] = $boiler->boiler_name;

            // $this->mailer->send('email.save_quote', $input, function ($message) use ($input, $boiler) {
            //     $message->from("no-reply@gasking.co.uk", "Gasking");
            //     $message->to($input['email']);
            //     $message->subject("Your fixed price for ".$boiler->boiler_name);
            // });
            Mail::to($input['email'])->send(new SaveQuote($id));

            $selection = Session::get('selection');

            $totalPrice = $input['offered_price'];

            if(isset($selection["total_price"]))
                $totalPrice = $selection["total_price"];

            $link = route('call.request.quote', ['id' => $id, 'token' => $input['token']]);

            $smsMessage = "Your GasKing fixed price of £".$totalPrice." is locked in for 7 days.\n Go to the following link if you would like us to call you to discussion about your quote. ".$link
            . "\nTo continue your booking click here ".$booking_link;
            $this->sms->sendSMS($request->contact, $smsMessage);
            return ['message' => 'Your quote has been saved! We\'ll email you shortly!'];

        } catch (\Exception $e) {
            $this->db->rollback();
            $this->log->error((string) $e);
            return ['message' => 'Error occured!'];
        }
    }

    /**
     * Saved quote
     *
     * @return View
     */
    public function savedQuote(Request $request)
    {
        $id = $request->id;

        $token = $request->token;

        $quote = $this->quote->find($id);

        if($quote == null)
           return redirect()->route('page.index');
        
        if($quote->token != $token)
            return redirect()->route('page.index');

        $url = $quote->saved_url;

        $request->session()->put('selection', json_decode($quote->selection, true));

        return redirect($url);
    }

    /**
     * 
     */
    public function quoteCallRequest(Request $request)
    {
        $id = $request->id;

        $token = $request->token;

        $quote = $this->quote->find($id);

        if($quote == null)
        return redirect()->route('page.index');
     
        if($quote->token != $token)
         return redirect()->route('page.index');

        
        $this->quote->update($id, ['call_requested' => true]);

        //Return view

        return view('pages.index.call');
    }

    /**
     * 
     */
    public function bookingCallRequest(Request $request)
    {
        $id = $request->id;

        $token = $request->token;

        $order = $this->order->find($id);

        if($order == null)
        return redirect()->route('page.index');
     
        if($order->transaction_id != $token)
         return redirect()->route('page.index');

        $this->order->update($id, ['call_requested' => true]);

        //Return view
        return view('pages.index.call');
    }


}
