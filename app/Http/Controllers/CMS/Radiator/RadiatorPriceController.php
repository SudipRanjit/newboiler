<?php

namespace App\Http\Controllers\CMS\Radiator;

use App\Webifi\Models\Radiator\RadiatorPrice;
use App\Webifi\Repositories\Radiator\RadiatorPriceRepository;
use App\Webifi\Repositories\Radiator\RadiatorTypeRepository;
use App\Webifi\Repositories\Radiator\RadiatorHeightRepository;
use App\Webifi\Repositories\Radiator\RadiatorLengthRepository;
use App\Http\Requests\RadiatorPriceRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class RadiatorPriceController extends Controller
{
 
  /**
   * RadiatorRepository $radiator
   */
  private $radiator_price;

  /**
   * RadiatorTypeRepository $radiator_type
   */
  private $radiator_type;

  /**
   * RadiatorHeightRepository $radiator_height
   */
  private $radiator_height;

  /**
   * RadiatorLengthRepository $radiator_length
   */
  private $radiator_length;

  /**
   * @var DatabaseManager
   */
  private $db;

  /**
   * @var LoggerInterface
   */
  private $log;

  /**
   * RadiatorController constructor.
   * @param RadiatorRepository $radiator
   * @param AddonRepository $addon
   * @param MediaRepository $media
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    RadiatorPriceRepository $radiator_price,
    RadiatorTypeRepository $radiator_type,
    RadiatorHeightRepository $radiator_height,
    RadiatorLengthRepository $radiator_length,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    
    $this->radiator_price    = $radiator_price;
    $this->radiator_type    = $radiator_type;
    $this->radiator_height    = $radiator_height;
    $this->radiator_length    = $radiator_length;
    $this->db       = $db;
    $this->log      = $log;
  }

  /**
   * Show all radiator
   *
   * @return View
   */
  public function index()
  {
    $this->authorize('view', RadiatorPrice::class);
    $radiator_prices = $this->radiator_price->paginate(40);
    return view('cms.radiator_price.index')->with('radiator_prices', $radiator_prices);
  }

   /**
   * Show all radiator
   *
   * @param Request $request
   * @return View
   */
  public function search(Request $request)
  {
    $this->authorize('view', RadiatorPrice::class);
    $radiator_prices = $this->radiator_price->searchWithMultipleCondition([] ,$request->search_txt, "id", "desc", ['*'], 40);
    return view('cms.radiator_price.index')->with('radiator_prices', $radiator_prices)->with("searchTxt", $request->search_txt);
  }

  /**
   * Show form to create new radiator
   *
   * @return View
   */
  public function create()
  {
    $this->authorize('create', RadiatorPrice::class);

    $radiator_types = $this->radiator_type->pluck('type','id')->toArray();
    $radiator_heights = $this->radiator_height->pluck('height','id')->toArray();
    $radiator_lengths = $this->radiator_length->pluck('length','id')->toArray();
    
    return view('cms.radiator_price.create')
      ->with('radiator_types', $radiator_types)
      ->with('radiator_heights', $radiator_heights)
      ->with('radiator_lengths', $radiator_lengths)
      ;
  }

  /**
   * Store newly created radiator
   *
   * @param RadiatorRequest $request
   * @return $this|\Illuminate\Http\RedirectResponse
   */
  public function store(RadiatorPriceRequest $request)
  {
    $this->authorize('create', RadiatorPrice::class);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'radiator_type_id','radiator_height_id','radiator_length_id', 'price', 'btu',
        ]);
      
      $input['user_id'] = auth()->user()->id;

      $record = $this->radiator_price->findWithCondition(['radiator_type_id'=>$input['radiator_type_id'],'radiator_height_id'=>$input['radiator_height_id'],'radiator_length_id'=>$input['radiator_length_id']]);  

      if ($record)
      {
        $error_message = "Price already submitted for radiator type: ".$record->radiator_type->type.', radiator height: '.$record->radiator_height->height.', radiator length: '.$record->radiator_length->length; 
        return  redirect()->route('cms::radiator_prices.create') 
        ->with('error', $error_message)
        ->withInput();   
      }
        
      $radiator_price = $this->radiator_price->store($input);
      
      
      $this->db->commit();

      return redirect()->route('cms::radiator_prices.index')
        ->with('success', "Radiator Price added successfully.");
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::radiator_prices.create')
        ->with('error', "Failed to add radiator price. " . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Show form to edit radiator
   *
   * @param Radiator $radiator
   * @return View
   */
  public function edit(RadiatorPrice $radiator_price)
  {
    $this->authorize('update', RadiatorPrice::class);

    $radiator_types = $this->radiator_type->pluck('type','id')->toArray();
    $radiator_heights = $this->radiator_height->pluck('height','id')->toArray();
    $radiator_lengths = $this->radiator_length->pluck('length','id')->toArray();
      
    return view('cms.radiator_price.edit')
      ->with('radiator_price', $radiator_price)
      ->with('radiator_types', $radiator_types)
      ->with('radiator_heights', $radiator_heights)
      ->with('radiator_lengths', $radiator_lengths)
      ;
  }

  /**
   * Update Radiator detail
   *
   * @param ProductradiatorRequest $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(RadiatorPriceRequest $request, $id)
  {
    $this->authorize('update', RadiatorPrice::class);

    $radiator_price = $this->radiator_price->find($id);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'radiator_type_id','radiator_height_id','radiator_length_id', 'price', 'btu',
        ]);

     
      $input['user_id'] = auth()->user()->id;

      $record = $this->radiator_price->findWithCondition(['radiator_type_id'=>$input['radiator_type_id'],'radiator_height_id'=>$input['radiator_height_id'],'radiator_length_id'=>$input['radiator_length_id']]);  

      if (!empty($record) && $record->id!=$id)
      {
        $error_message = "Price already submitted for radiator type: ".$record->radiator_type->type.', radiator height: '.$record->radiator_height->height.', radiator length: '.$record->radiator_length->length; 
        return  redirect()->route('cms::radiator_prices.edit',$id) 
        ->with('error', $error_message)
        ->withInput();   
      }
      
      $this->radiator_price->update($id, $input);
      
      $this->db->commit();

      return redirect()->route('cms::radiator_prices.index')
        ->with('success', 'Radiator price updated successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::radiator_prices.edit', ['radiator_price' => $id])
        ->with('error', 'Failed to update radiator price. ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Delete given radiator
   *
   * @param Radiator $radiator
   * @return string
   */
  public function delete(RadiatorPrice $radiator_price)
  {
    $this->authorize('delete', RadiatorPrice::class);

    try {
      $this->db->beginTransaction();
      $this->radiator_price->delete($radiator_price->id);

      $this->db->commit();
      return redirect()->route('cms::radiator_prices.index')
        ->with('success', 'Radiator price deleted successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::radiator_prices.index')
        ->with('error', 'Failed to delete radiator price. '.$e->getMessage())
        ->withInput();
    }
  }

  /**
   * Delete unused icons
   * 
   * @param $image
   */
  private function deleteImage($image)
  {
    if (file_exists(public_path('uploads/icons/' . $image)))
      unlink(public_path('uploads/icons/' . $image));
  }
}
