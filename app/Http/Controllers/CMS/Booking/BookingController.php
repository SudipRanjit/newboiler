<?php

namespace App\Http\Controllers\CMS\Booking;

use App\Webifi\Models\Booking\Booking;
use App\Webifi\Repositories\Booking\BookingRepository;
use App\Http\Requests\BookingRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

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
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->booking   = $booking;
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
    $bookings = $this->booking->paginate(40);
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
    $bookings = $this->booking->searchWithMultipleCondition([] ,$request->search_txt, "id", "desc", ['*'], 40);
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
        'appointment_date','amount','discount','status' 
        
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

}
