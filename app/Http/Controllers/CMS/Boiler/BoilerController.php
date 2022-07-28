<?php

namespace App\Http\Controllers\CMS\Boiler;

use App\Webifi\Models\Boiler\Boiler;
use App\Webifi\Repositories\Boiler\BoilerRepository;
use App\Webifi\Repositories\Brand\BrandRepository;
use App\Webifi\Repositories\Category\CategoryRepository;
use App\Webifi\Repositories\Power\PowerRepository;
use App\Webifi\Repositories\Media\MediaRepository;
use App\Webifi\Repositories\Addon\AddonRepository;
use App\Http\Requests\BoilerRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class BoilerController extends Controller
{
  /**
   * BoilerRepository $boiler
   */
  private $boiler;

  /**
   * AddonRepository $addon
   */
  private $addon;

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
   * BoilerController constructor.
   * @param BoilerRepository $boiler
   * @param AddonRepository $addon
   * @param MediaRepository $media
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    BoilerRepository $boiler,
    BrandRepository $brand,
    AddonRepository $addon,
    CategoryRepository $category,
    PowerRepository $power,
    MediaRepository $media,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->boiler   = $boiler;
    $this->addon    = $addon;
    $this->brand    = $brand;
    $this->category = $category;
    $this->power    = $power;
    $this->media    = $media;
    $this->db       = $db;
    $this->log      = $log;
  }

  /**
   * Show all boiler
   *
   * @return View
   */
  public function index()
  {
    $this->authorize('view', Boiler::class);
    $boilers = $this->boiler->paginate(40);
    return view('cms.boiler.index')->with('boilers', $boilers);
  }

   /**
   * Show all boiler
   *
   * @param Request $request
   * @return View
   */
  public function search(Request $request)
  {
    $this->authorize('view', Boiler::class);
    $boilers = $this->boiler->searchWithMultipleCondition([] ,$request->search_txt, "id", "desc", ['*'], 40);
    return view('cms.boiler.index')->with('boilers', $boilers)->with("searchTxt", $request->search_txt);
  }

  /**
   * Show form to create new boiler
   *
   * @return View
   */
  public function create()
  {
    $this->authorize('create', Boiler::class);

    $medias = $this->media->paginate(40, "created_at");

    $categories = $this->category->getWithCondition(['publish' => 1, 'type' => 'Category']);
    $brands = $this->brand->getWithCondition(['publish' => 1, 'type' => 'Brand']);
    $powers = $this->power->getWithCondition(['publish' => 1, 'type' => 'Power']);
    $addons = $this->addon->getWithCondition(['publish' => 1]);

    return view('cms.boiler.create')
      ->with('categories', $categories)
      ->with('brands', $brands)
      ->with('powers', $powers)
      ->with('addons', $addons)
      ->with('lastPage', $medias->lastPage());
  }

  /**
   * Store newly created boiler
   *
   * @param BoilerRequest $request
   * @return $this|\Illuminate\Http\RedirectResponse
   */
  public function store(BoilerRequest $request)
  {
    $this->authorize('create', Boiler::class);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'boiler_name', 'price', 'addon_id', 'discount', 'summary', 'description', 'brand', 'category', 'power_range', 'measurements',
        'height',
        'width',
        'depth',
        'warranty',
        'boiler_type',
        'fuel_type',
        'solar_compatibility',
        'flow_rate',
        'central_heating_output',
        'hot_water_output',
        'effiency_rating',
        'multiple_addons'
      ]);

      $input['image'] = $request->featured_image;
      $input['user_id'] = auth()->user()->id;

      if($request->featured_image == "")
        $input['image'] = asset('uploads/default.png');

      $input['publish'] = 0;

      if (isset($request->publish))
        $input['publish'] = 1;

      $boiler = $this->boiler->store($input);

      if (!empty($input['multiple_addons']))
        $boiler->addons()->attach($input['multiple_addons']);
      
      $this->db->commit();

      return redirect()->route('cms::boilers.index')
        ->with('success', "Boiler added successfully.");
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::boilers.create')
        ->with('error', "Failed to add boiler. " . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Show form to edit boiler
   *
   * @param Boiler $boiler
   * @return View
   */
  public function edit(Boiler $boiler)
  {
    $this->authorize('update', Boiler::class);

    $medias = $this->media->paginate(40, "created_at");
    $categories = $this->category->getWithCondition(['publish' => 1, 'type' => 'Category']);
    $brands = $this->brand->getWithCondition(['publish' => 1, 'type' => 'Brand']);
    $powers = $this->power->getWithCondition(['publish' => 1, 'type' => 'Power']);
    $addons = $this->addon->getWithCondition(['publish' => 1]);

    return view('cms.boiler.edit')
      ->with('boiler', $boiler)
      ->with('categories', $categories)
      ->with('brands', $brands)
      ->with('addons', $addons)
      ->with('powers', $powers)
      ->with('lastPage', $medias->lastPage());
  }

  /**
   * Update boiler detail
   *
   * @param ProductBoilerRequest $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(BoilerRequest $request, $id)
  {
    $this->authorize('update', Boiler::class);

    $boiler = $this->boiler->find($id);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'boiler_name', 'price', 'addon_id', 'discount', 'summary', 'description', 'brand', 'category', 'power_range', 'measurements',
        'height',
        'width',
        'depth',
        'warranty',
        'boiler_type',
        'fuel_type',
        'solar_compatibility',
        'flow_rate',
        'central_heating_output',
        'hot_water_output',
        'effiency_rating',
        'multiple_addons'
      ]);

      $input['image'] = $request->featured_image;
      $input['user_id'] = auth()->user()->id;

      if($request->featured_image == "")
        $input['image'] = asset('uploads/default.png');

      $input['publish'] = 0;

      if (isset($request->publish))
        $input['publish'] = 1;

      
      if (!empty($input['multiple_addons']))
        $boiler->addons()->sync($input['multiple_addons']);
      else
        $boiler->addons()->detach();

      $this->boiler->update($id, $input);
      $this->db->commit();


      return redirect()->route('cms::boilers.index')
        ->with('success', 'Boiler updated successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::boilers.edit', ['boiler' => $id])
        ->with('error', 'Filed to update boiler. ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Delete given boiler
   *
   * @param Boiler $boiler
   * @return string
   */
  public function delete(Boiler $boiler)
  {
    $this->authorize('delete', Boiler::class);

    try {
      $this->db->beginTransaction();
      $this->boiler->delete($boiler->id);

      $this->db->commit();
      return redirect()->route('cms::boilers.index')
        ->with('success', 'Boiler deleted successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::boilers.index')
        ->with('error', 'Filed to delete boiler. '.$e->getMessage())
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
