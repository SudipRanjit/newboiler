<?php

namespace App\Http\Controllers\CMS\BoilerFeature;

use App\Webifi\Models\Boiler\BoilerFeature;
use App\Webifi\Models\Boiler\Boiler;
use App\Webifi\Repositories\Boiler\BoilerFeatureRepository;
use App\Webifi\Repositories\Brand\BrandRepository;
use App\Webifi\Repositories\Category\CategoryRepository;
use App\Webifi\Repositories\Power\PowerRepository;
use App\Webifi\Repositories\Media\MediaRepository;
use App\Http\Requests\BoilerFeatureRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class BoilerFeatureController extends Controller
{
  /**
   * BoilerFeatureRepository $feature
   */
  private $feature;
  /**
   * BrandRepository $brand
   */
  private $brand;
  /**
   * CategoryRepository $category
   */
  private $category;
  /**
   * PowerRepository $power
   */
  private $power;
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
   * BoilerFeatureController constructor.
   * @param BoilerFeatureRepository $feature
   * @param BrandRepository $brand
   * @param CategoryRepository $category
   * @param PowerRepository $power
   * @param MediaRepository $media
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    BoilerFeatureRepository $feature,
    BrandRepository $brand,
    CategoryRepository $category,
    PowerRepository $power,
    MediaRepository $media,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->feature = $feature;
    $this->brand = $brand;
    $this->category = $category;
    $this->power = $power;
    $this->media = $media;
    $this->db   = $db;
    $this->log  = $log;
  }

  /**
   * Show all feature
   *
   * @return View
   */
  public function index()
  {
    $this->authorize('view', Boiler::class);
    $features = $this->feature->paginate(40);
    return view('cms.boiler.feature.index')->with('features', $features);
  }

   /**
   * Show all feature
   *
   * @param Request $request
   * @return View
   */
  public function search(Request $request)
  {
    $this->authorize('view', Boiler::class);
    $features = $this->feature->searchWithMultipleCondition([] ,$request->search_txt, "id", "desc", ['*'], 40);
    return view('cms.boiler.feature.index')->with('features', $features)->with("searchTxt", $request->search_txt);
  }

  /**
   * Show form to create new feature
   *
   * @return View
   */
  public function create()
  {
    $this->authorize('create', Boiler::class);

    $medias = $this->media->paginate(40, "created_at");

    return view('cms.boiler.feature.create')
      ->with('lastPage', $medias->lastPage());
  }

  /**
   * Store newly created feature
   *
   * @param BoilerFeatureRequest $request
   * @return $this|\Illuminate\Http\RedirectResponse
   */
  public function store(BoilerFeatureRequest $request)
  {
    $this->authorize('create', Boiler::class);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'name', 'description', 's_order'
      ]);

      $input['image'] = $request->image;
      $input['user_id'] = auth()->user()->id;

      if($request->image == "")
        $input['image'] = asset('uploads/default.png');

      $this->feature->store($input);

      $this->db->commit();

      return redirect()->route('cms::boiler.features.index')
        ->with('success', "Boiler Feature added successfully.");
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::boiler.features.create')
        ->with('error', "Failed to add feature. " . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Show form to edit feature
   *
   * @param BoilerFeature $feature
   * @return View
   */
  public function edit(BoilerFeature $feature)
  {
    $this->authorize('update', Boiler::class);

    $medias = $this->media->paginate(40, "created_at");
   
    return view('cms.boiler.feature.edit')
      ->with('feature', $feature)
      ->with('lastPage', $medias->lastPage());
  }

  /**
   * Update feature detail
   *
   * @param ProductBoilerFeatureRequest $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(BoilerFeatureRequest $request, $id)
  {
    $this->authorize('update', Boiler::class);

    $feature = $this->feature->find($id);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'name', 'description', 's_order'
      ]);

      $input['image'] = $request->image;

      if($request->image == "")
        $input['image'] = asset('uploads/default.png');

      $this->feature->update($id, $input);
      $this->db->commit();


      return redirect()->route('cms::boiler.features.index')
        ->with('success', 'Boiler Feature updated successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::boiler.features.edit', ['feature' => $id])
        ->with('error', 'Filed to update feature. ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Delete given feature
   *
   * @param BoilerFeature $feature
   * @return string
   */
  public function delete(BoilerFeature $feature)
  {
    $this->authorize('delete', Boiler::class);

    try {
      $this->db->beginTransaction();
      $this->feature->delete($feature->id);

      $this->db->commit();
      return redirect()->route('cms::boiler.features.index')
        ->with('success', 'BoilerFeature deleted successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::boiler.features.index')
        ->with('error', 'Filed to delete feature. '.$e->getMessage())
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
