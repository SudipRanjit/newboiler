<?php

namespace App\Http\Controllers\CMS\Booking;

use App\Webifi\Models\Booking\PaymentGateway;
use App\Webifi\Repositories\Booking\PaymentGatewayRepository;
use App\Http\Requests\PaymentGatewayRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class PaymentGatewayController extends Controller
{
  /**
   * PaymentGatewayRepository $payment_gateway
   */
  private $payment_gateway;
  
  /**
   * @var DatabaseManager
   */
  private $db;

  /**
   * @var LoggerInterface
   */
  private $log;

  /**
   * PaymentGatewayController constructor.
   * @param PaymentGatewayRepository $payment_gateway
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    PaymentGatewayRepository $payment_gateway,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->payment_gateway   = $payment_gateway;
    $this->db       = $db;
    $this->log      = $log;
  }

  /**
   * Show all 
   *
   * @return View
   */
  public function index()
  {
    $this->authorize('view', PaymentGateway::class);
    $payment_gateways = $this->payment_gateway->paginate(40);
    return view('cms.booking.payment_gateway.index')->with('payment_gateways', $payment_gateways);
  }

   /**
   * Show all
   *
   * @param Request $request
   * @return View
   */
  public function search(Request $request)
  {
    $this->authorize('view', PaymentGateway::class);
    $payment_gateways = $this->payment_gateway->searchWithMultipleCondition([] ,$request->search_txt, "id", "desc", ['*'], 40);
    return view('cms.booking.payment_gateway.index')->with('payment_gateways', $payment_gateways)->with("searchTxt", $request->search_txt);
  }

  /**
   * Show form to create new payment gateway
   *
   * @return View
   */
  public function create()
  {
    $this->authorize('create', PaymentGateway::class);

    return view('cms.booking.payment_gateway.create');
   
  }

  /**
   * Store newly created payment gateway
   *
   * @param PaymentGatewayRequest $request
   * @return $this|\Illuminate\Http\RedirectResponse
   */
  public function store(PaymentGatewayRequest $request)
  {
    $this->authorize('create', PaymentGateway::class);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'title'
        
      ]);
      
      $payment_gateway = $this->payment_gateway->store($input);
     
      $this->db->commit();

      return redirect()->route('cms::payment_gateways.index')
        ->with('success', "Payment gateway added successfully.");
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::payment_gateways.create')
        ->with('error', "Failed to add payment gateway. " . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Show form to edit payment_gateways
   *
   * @param PaymentGateway $payment_gateway
   * @return View
   */
  public function edit(PaymentGateway $payment_gateway)
  {
    $this->authorize('update', PaymentGateway::class);

    return view('cms.booking.payment_gateway.edit')
                ->with('payment_gateway', $payment_gateway);
      
  }

  /**
   * Update PaymentGateway detail
   *
   * @param PaymentGatewayRequest $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(PaymentGatewayRequest $request, $id)
  {
    $this->authorize('update', PaymentGateway::class);

    $payment_gateway = $this->payment_gateway->find($id);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'title'
      ]);

      $this->payment_gateway->update($id, $input);
      $this->db->commit();

      return redirect()->route('cms::payment_gateways.index')
        ->with('success', 'Payment gateway updated successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::payment_gateways.edit', ['payment_gateway' => $id])
        ->with('error', 'Failed to update payment gateway. ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Delete given payment gateway
   *
   * @param PaymentGateway $payment_gateway
   * @return string
   */
  public function delete(PaymentGateway $payment_gateway)
  {
    $this->authorize('delete', PaymentGateway::class);

    try {
      $this->db->beginTransaction();
      $this->payment_gateway->delete($payment_gateway->id);

      $this->db->commit();
      return redirect()->route('cms::payment_gateways.index')
        ->with('success', 'Payment gateway deleted successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::payment_gateways.index')
        ->with('error', 'Failed to delete payment gateway. '.$e->getMessage())
        ->withInput();
    }
  }

  
}
