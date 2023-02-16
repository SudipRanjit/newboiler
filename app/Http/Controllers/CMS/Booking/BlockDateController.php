<?php

namespace App\Http\Controllers\CMS\Booking;

use App\Webifi\Models\Booking\BlockDate;
use App\Webifi\Repositories\Booking\BlockDateRepository;
use App\Http\Requests\BlockDateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class BlockDateController extends Controller
{
  /**
   * BlockDateRepository $block_date
   */
  private $block_date;
  
  /**
   * @var DatabaseManager
   */
  private $db;

  /**
   * @var LoggerInterface
   */
  private $log;

  /**
   * BlockDateController constructor.
   * @param BlockDateRepository $block_date
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    BlockDateRepository $block_date,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->block_date   = $block_date;
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
    $this->authorize('view', BlockDate::class);
    $block_dates = $this->block_date->paginate(40);
    return view('cms.booking.block_date.index')->with('block_dates', $block_dates);
  }

   /**
   * Show all
   *
   * @param Request $request
   * @return View
   */
  public function search(Request $request)
  {
    $this->authorize('view', BlockDate::class);
    $block_dates = $this->block_date->searchWithMultipleCondition([] ,$request->search_txt, "id", "desc", ['*'], 40);
    return view('cms.booking.block_date.index')->with('block_dates', $block_dates)->with("searchTxt", $request->search_txt);
  }

  /**
   * Show form to create new block date
   *
   * @return View
   */
  public function create()
  {
    $this->authorize('create', BlockDate::class);

    return view('cms.booking.block_date.create');
   
  }

  /**
   * Store newly created block date
   *
   * @param BlockDateRequest $request
   * @return $this|\Illuminate\Http\RedirectResponse
   */
  public function store(BlockDateRequest $request)
  {
    $this->authorize('create', BlockDate::class);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'date', 'note', 'time'
        
      ]);

     
      $input['user_id'] = auth()->user()->id;

      $input['publish'] = 0;

      if (isset($request->publish))
        $input['publish'] = 1;

      $block_date = $this->block_date->store($input);

      
      $this->db->commit();

      return redirect()->route('cms::block_dates.index')
        ->with('success', "Block date added successfully.");
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::block_dates.create')
        ->with('error', "Failed to add block date. " . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Show form to edit block_dates
   *
   * @param BlockDate $block_date
   * @return View
   */
  public function edit(BlockDate $block_date)
  {
    $this->authorize('update', BlockDate::class);

    return view('cms.booking.block_date.edit')
                ->with('block_date', $block_date);
      
  }

  /**
   * Update BlockDate detail
   *
   * @param BlockDateRequest $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(BlockDateRequest $request, $id)
  {
    $this->authorize('update', BlockDate::class);

    $block_date = $this->block_date->find($id);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'date', 'note', 'time'
      ]);

     
      $input['user_id'] = auth()->user()->id;

      $input['publish'] = 0;

      if (isset($request->publish))
        $input['publish'] = 1;
      
     
      $this->block_date->update($id, $input);
      $this->db->commit();


      return redirect()->route('cms::block_dates.index')
        ->with('success', 'Block date updated successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::block_dates.edit', ['block_date' => $id])
        ->with('error', 'Failed to update block date. ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Delete given block date
   *
   * @param BlockDate $block_date
   * @return string
   */
  public function delete(BlockDate $block_date)
  {
    $this->authorize('delete', BlockDate::class);

    try {
      $this->db->beginTransaction();
      $this->block_date->delete($block_date->id);

      $this->db->commit();
      return redirect()->route('cms::block_dates.index')
        ->with('success', 'Block date deleted successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::block_dates.index')
        ->with('error', 'Failed to delete block date. '.$e->getMessage())
        ->withInput();
    }
  }

  
}
