<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Webifi\Repositories\Boiler\BoilerRepository;
use App\Webifi\Repositories\Quote\QuoteRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;
use Illuminate\Mail\Mailer;

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
     * Mailer $mailer
     */
    private $mailer;

    /**
     * QuoteController constructor.
     * @param QuoteRepository $quote
     * @param BoilerRepository $boiler
     * @param DatabaseManager $db
     * @param LoggerInterface $log
     * @param Mailer $mailer
     */
    public function __construct(
        QuoteRepository $quote,
        BoilerRepository $boiler,
        DatabaseManager $db,
        LoggerInterface $log,
        Mailer $mailer
    ) {
        $this->quote = $quote;
        $this->boiler = $boiler;
        $this->db = $db;
        $this->log = $log;
        $this->mailer = $mailer;
    }

/**
 * Save quote
 *
 * @return View
 */
    public function saveQuote(Request $request)
    {
        $quote = $this->quote->findWithCondition(['email' => $request->email, 'boiler' => $request->boiler]);
        if($quote != null)
        {
            return ['message' => 'You\'ve already saved quote for this boiler!'];
        }

        try {
            $this->db->beginTransaction();

            $input = $request->only([
                'selection',
                'boiler',
                'email',
                'contact',
            ]);

            $boiler = $this->boiler->find($request->boiler);

            $input['offered_price'] = $boiler->price - $boiler->discount;
            $input['total_price'] = $boiler->price;


            $this->quote->store($input);
            $this->db->commit();

            $data = [];

            $this->mailer->send('email.save_quote', $data, function ($message) use ($data) {
                $message->from("no-reply@gasking.co.uk", "Gasking");
                $message->to('lycansu@gmail.com');
                $message->subject("Your fixed price for Boiler");
            });

            return ['message' => 'Your quote has been saved! We\'ll email you shortly!'];

        } catch (\Exception $e) {
            $this->db->rollback();
            $this->log->error((string) $e);
            return ['message' => 'Error occured!'];
        }
    }

}
