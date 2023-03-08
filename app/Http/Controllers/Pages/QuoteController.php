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
     * QuoteController constructor.
     * @param QuoteRepository $quote
     * @param BoilerRepository $boiler
     * @param DatabaseManager $db
     * @param LoggerInterface $log
     */
    public function __construct(
        QuoteRepository $quote,
        BoilerRepository $boiler,
        DatabaseManager $db,
        LoggerInterface $log
    ) {
        $this->quote = $quote;
        $this->boiler = $boiler;
        $this->db = $db;
        $this->log = $log;
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

            $input['boiler_name'] = $boiler->boiler_name;

            // $this->mailer->send('email.save_quote', $input, function ($message) use ($input, $boiler) {
            //     $message->from("no-reply@gasking.co.uk", "Gasking");
            //     $message->to($input['email']);
            //     $message->subject("Your fixed price for ".$boiler->boiler_name);
            // });
            Mail::to($input['email'])->send(new SaveQuote($id));

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

}
