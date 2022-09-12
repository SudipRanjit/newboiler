<?php

namespace App\Http\Controllers\CMS\Booking;

use App\Webifi\Models\Booking\Order;
use App\Webifi\Repositories\Booking\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class OrderController extends Controller
{
  /**
   * OrderRepository $order
   */
  private $order;
  
  /**
   * @var DatabaseManager
   */
  private $db;

  /**
   * @var LoggerInterface
   */
  private $log;

  /**
   * OrderController constructor.
   * @param OrderRepository $boiler
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    OrderRepository $order,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->order   = $order;
    $this->db       = $db;
    $this->log      = $log;
  }

  /**
   * Show all order
   *
   * @return View
   */
  public function index()
  {
    $this->authorize('view', Order::class);
    $orders = $this->order->paginate(20);
    return view('cms.booking.order.index')->with('orders', $orders);
  }

   /**
   * Show all order
   *
   * @param Request $request
   * @return View
   */
  public function search(Request $request)
  {
    $this->authorize('view', Order::class);
    $orders = $this->order->searchWithMultipleCondition([] ,$request->search_txt, "id", "desc", ['*'], 20);
    return view('cms.booking.order.index')->with('orders', $orders)->with("searchTxt", $request->search_txt);
  }
  
  
}
