<?php

namespace App\Http\Controllers\CMS\Quote;

use App\Webifi\Repositories\Quote\QuoteRepository;
use App\Webifi\Models\Quote\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class QuoteController extends Controller
{
  /**
   * QuoteRepository $quote
   */
  private $quote;

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
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    QuoteRepository $quote,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->quote   = $quote;
    $this->db       = $db;
    $this->log      = $log;
  }

  /**
   * Show all quote
   *
   * @return View
   */
  public function index()
  {
    $quotes = $this->quote->paginate(50);

    return view('cms.quote.index')->with('quotes', $quotes);
  }

   /**
   * Show all quote
   *
   * @param Request $request
   * @return View
   */
  public function search(Request $request)
  {
    $this->authorize('view', Radiator::class);
    $quotes = $this->quote->searchWithMultipleCondition([] ,$request->search_txt, "id", "desc", ['*'], 40);
    return view('cms.quote.index')->with('quotes', $quotes)->with("searchTxt", $request->search_txt);
  }

}
