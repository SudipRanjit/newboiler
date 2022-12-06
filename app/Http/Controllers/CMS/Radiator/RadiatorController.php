<?php

namespace App\Http\Controllers\CMS\Radiator;

use App\Webifi\Models\Radiator\Radiator;
use App\Webifi\Repositories\Radiator\RadiatorRepository;
use App\Webifi\Repositories\Radiator\RadiatorTypeRepository;
use App\Webifi\Repositories\Radiator\RadiatorHeightRepository;
use App\Webifi\Repositories\Radiator\RadiatorLengthRepository;
use App\Webifi\Repositories\Media\MediaRepository;
use App\Http\Requests\RadiatorRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class RadiatorController extends Controller
{
 
  /**
   * RadiatorRepository $radiator
   */
  private $radiator;

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
   * MediaRepository $media
   */
  private $media;

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
    RadiatorRepository $radiator,
    RadiatorTypeRepository $radiator_type,
    RadiatorHeightRepository $radiator_height,
    RadiatorLengthRepository $radiator_length,
    MediaRepository $media,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    
    $this->radiator    = $radiator;
    $this->radiator_type    = $radiator_type;
    $this->radiator_height    = $radiator_height;
    $this->radiator_length    = $radiator_length;
    $this->media    = $media;
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
    $this->authorize('view', Radiator::class);
    $radiators = $this->radiator->paginate(40);
    return view('cms.radiator.index')->with('radiators', $radiators);
  }

   /**
   * Show all radiator
   *
   * @param Request $request
   * @return View
   */
  public function search(Request $request)
  {
    $this->authorize('view', Radiator::class);
    $radiators = $this->radiator->searchWithMultipleCondition([] ,$request->search_txt, "id", "desc", ['*'], 40);
    return view('cms.radiator.index')->with('radiators', $radiators)->with("searchTxt", $request->search_txt);
  }

  /**
   * Show form to create new radiator
   *
   * @return View
   */
  public function create()
  {
    $this->authorize('create', Radiator::class);

    if ($this->radiator->all()->count())
      return redirect()->route('cms::radiators.index')
        ->with('error', "Only one radiator can be added.");
    
    $medias = $this->media->paginate(40, "created_at");

    $radiator_types = $this->radiator_type->all();
    $radiator_heights = $this->radiator_height->all();
    $radiator_lengths = $this->radiator_length->all();
       
    return view('cms.radiator.create')
      ->with('lastPage', $medias->lastPage())
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
  public function store(RadiatorRequest $request)
  {
    $this->authorize('create', Radiator::class);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'radiator_name', 'price', 'summary', 'description', 'btu', 'publish', 'image',
        'radiator_types', 'radiator_heights', 'radiator_lengths'
       
      ]);

      $input['image'] = $request->featured_image;
      $input['user_id'] = auth()->user()->id;

      if($request->featured_image == "")
        $input['image'] = asset('uploads/default.png');

      $input['publish'] = 0;

      if (isset($request->publish))
        $input['publish'] = 1;
     
      if (empty($input['radiator_types']))
          return  redirect()->route('cms::radiators.create') 
            ->with('error', "Please provide radiator types.")
            ->withInput();

      if (empty($input['radiator_heights']))
            return  redirect()->route('cms::radiators.create') 
              ->with('error', "Please provide radiator heights.")
              ->withInput();

      if (empty($input['radiator_lengths']))
              return  redirect()->route('cms::radiators.create') 
                ->with('error', "Please provide radiator lengths.")
                ->withInput();
        
              
      $radiator = $this->radiator->store($input);
      
      if (!empty($input['radiator_types']))
        {
          (app($this->radiator_type->getModel()))::truncate();
          foreach($input['radiator_types'] as $type)
            {
              $data = ['type'=>$type, 'user_id'=>auth()->user()->id];
              (app($this->radiator_type->getModel()))::create($data);
            }
        }

      if (!empty($input['radiator_heights']))
        {
          (app($this->radiator_height->getModel()))::truncate();
          foreach($input['radiator_heights'] as $height)
            {
              $data = ['height'=>$height, 'user_id'=>auth()->user()->id];
              (app($this->radiator_height->getModel()))::create($data);
            }
        }
        
      if (!empty($input['radiator_lengths']))
        {
          (app($this->radiator_length->getModel()))::truncate();
          foreach($input['radiator_lengths'] as $length)
            {
              $data = ['length'=>$length, 'user_id'=>auth()->user()->id];
              (app($this->radiator_length->getModel()))::create($data);
            }
        }  
      
      $this->db->commit();

      return redirect()->route('cms::radiators.index')
        ->with('success', "Radiator added successfully.");
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::radiators.create')
        ->with('error', "Failed to add radiator. " . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Show form to edit radiator
   *
   * @param Radiator $radiator
   * @return View
   */
  public function edit(Radiator $radiator)
  {
    $this->authorize('update', Radiator::class);

    $medias = $this->media->paginate(40, "created_at");

    $radiator_types = $this->radiator_type->all();
    $radiator_heights = $this->radiator_height->all();
    $radiator_lengths = $this->radiator_length->all();
      
    return view('cms.radiator.edit')
      ->with('radiator', $radiator)
      ->with('lastPage', $medias->lastPage())
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
  public function update(RadiatorRequest $request, $id)
  {
    $this->authorize('update', Radiator::class);

    $radiator = $this->radiator->find($id);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'radiator_name', 'price', 'summary', 'description', 'btu', 'publish', 'image',
        'radiator_types', 'radiator_heights', 'radiator_lengths'
       
      ]);

      $input['image'] = $request->featured_image;
      $input['user_id'] = auth()->user()->id;

      if($request->featured_image == "")
        $input['image'] = asset('uploads/default.png');

      $input['publish'] = 0;

      if (isset($request->publish))
        $input['publish'] = 1;

      if (empty($input['radiator_types']))
        return redirect()->route('cms::radiators.edit', ['radiator' => $id]) 
            ->with('error', "Please provide radiator types.")
            ->withInput();

      if (empty($input['radiator_heights']))
        return redirect()->route('cms::radiators.edit', ['radiator' => $id]) 
              ->with('error', "Please provide radiator heights.")
              ->withInput();

      if (empty($input['radiator_lengths']))
        return redirect()->route('cms::radiators.edit', ['radiator' => $id]) 
                ->with('error', "Please provide radiator lengths.")
                ->withInput();
    

      $this->radiator->update($id, $input);

        if (!empty($input['radiator_types']))
        {
          (app($this->radiator_type->getModel()))::truncate();
          foreach($input['radiator_types'] as $type)
            {
              $data = ['type'=>$type, 'user_id'=>auth()->user()->id];
              (app($this->radiator_type->getModel()))::create($data);
            }
        }

      if (!empty($input['radiator_heights']))
        {
          (app($this->radiator_height->getModel()))::truncate();
          foreach($input['radiator_heights'] as $height)
            {
              $data = ['height'=>$height, 'user_id'=>auth()->user()->id];
              (app($this->radiator_height->getModel()))::create($data);
            }
        }
        
      if (!empty($input['radiator_lengths']))
        {
          (app($this->radiator_length->getModel()))::truncate();
          foreach($input['radiator_lengths'] as $length)
            {
              $data = ['length'=>$length, 'user_id'=>auth()->user()->id];
              (app($this->radiator_length->getModel()))::create($data);
            }
        }  
      

      
      $this->db->commit();


      return redirect()->route('cms::radiators.index')
        ->with('success', 'Radiator updated successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::radiators.edit', ['radiator' => $id])
        ->with('error', 'Failed to update radiator. ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Delete given radiator
   *
   * @param Radiator $radiator
   * @return string
   */
  public function delete(Radiator $radiator)
  {
    $this->authorize('delete', Radiator::class);

    try {
      $this->db->beginTransaction();
      $this->radiator->delete($radiator->id);

      $this->db->commit();
      return redirect()->route('cms::radiators.index')
        ->with('success', 'Radiator deleted successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::radiators.index')
        ->with('error', 'Failed to delete radiator. '.$e->getMessage())
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
