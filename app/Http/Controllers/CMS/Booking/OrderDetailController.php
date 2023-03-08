<?php

namespace App\Http\Controllers\CMS\Booking;

use App\Webifi\Models\Booking\OrderDetail;
use App\Webifi\Repositories\Booking\OrderDetailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class OrderDetailController extends Controller
{
  /**
   * OrderRepository $order
   */
  private $order_detail;
  
  /**
   * @var DatabaseManager
   */
  private $db;

  /**
   * @var LoggerInterface
   */
  private $log;

  /**
   * OrderDetailController constructor.
   * @param OrderRepository $boiler
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    OrderDetailRepository $order_detail,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->order_detail   = $order_detail;
    $this->db       = $db;
    $this->log      = $log;
  }

  /**
   * Show all order detail
   * @param $order_id
   * @return View
   */
  public function index($order_id)
  {
    $order_details = $this->order_detail->getWithCondition(['order_id'=>$order_id],'id','asc',array('*'),1000);
    if ($order_details->isEmpty())
        abort(404); 
    $order = $order_details[0]->order;
    $billing_address = $order_details[0]->order->billing_address;
    $booking = $order_details[0]->order->booking;
    
    return view('cms.booking.order_detail.index',compact('order_details','order','billing_address','booking'));
  }
  
}
