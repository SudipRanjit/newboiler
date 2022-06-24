<?php

namespace App\Http\Controllers\CMS\Addon;

use App\Webifi\Models\Addon\Addon;
use App\Webifi\Repositories\Addon\AddonRepository;
use App\Webifi\Repositories\Brand\BrandRepository;
use App\Webifi\Repositories\Category\CategoryRepository;
use App\Webifi\Repositories\Power\PowerRepository;
use App\Webifi\Repositories\Media\MediaRepository;
use App\Http\Requests\AddonRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class AddonController extends Controller
{
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
   * AddonController constructor.
   * @param AddonRepository $addon
   * @param MediaRepository $media
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    AddonRepository $addon,
    BrandRepository $brand,
    CategoryRepository $category,
    PowerRepository $power,
    MediaRepository $media,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->addon = $addon;
    $this->brand = $brand;
    $this->category = $category;
    $this->power = $power;
    $this->media = $media;
    $this->db   = $db;
    $this->log  = $log;
  }

  /**
   * Show all addon
   *
   * @return View
   */
  public function index()
  {
    $this->authorize('view', Addon::class);
    $addons = $this->addon->paginate(40);
    return view('cms.addon.index')->with('addons', $addons);
  }

   /**
   * Show all addon
   *
   * @param Request $request
   * @return View
   */
  public function search(Request $request)
  {
    $this->authorize('view', Addon::class);
    $addons = $this->addon->searchWithMultipleCondition([] ,$request->search_txt, "id", "desc", ['*'], 40);
    return view('cms.addon.index')->with('addons', $addons)->with("searchTxt", $request->search_txt);
  }

  /**
   * Show form to create new addon
   *
   * @return View
   */
  public function create()
  {
    $this->authorize('create', Addon::class);

    $medias = $this->media->paginate(40, "created_at");

    $categories = $this->category->getWithCondition(['publish' => 1, 'type' => 'Category']);
    $brands = $this->brand->getWithCondition(['publish' => 1, 'type' => 'Brand']);
    $powers = $this->power->getWithCondition(['publish' => 1, 'type' => 'Power']);


    return view('cms.addon.create')
      ->with('categories', $categories)
      ->with('brands', $brands)
      ->with('powers', $powers)
      ->with('lastPage', $medias->lastPage());
  }

  /**
   * Store newly created addon
   *
   * @param AddonRequest $request
   * @return $this|\Illuminate\Http\RedirectResponse
   */
  public function store(AddonRequest $request)
  {
    $this->authorize('create', Addon::class);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'addon_name', 'price', 'summary', 'description'
      ]);

      $input['image'] = $request->featured_image;
      $input['user_id'] = auth()->user()->id;

      if($request->featured_image == "")
        $input['image'] = asset('uploads/default.png');

      $input['publish'] = 0;

      if (isset($request->publish))
        $input['publish'] = 1;

      $this->addon->store($input);

      $this->db->commit();

      return redirect()->route('cms::addons.index')
        ->with('success', "Addon added successfully.");
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::addons.create')
        ->with('error', "Failed to add addon. " . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Show form to edit addon
   *
   * @param Addon $addon
   * @return View
   */
  public function edit(Addon $addon)
  {
    $this->authorize('update', Addon::class);

    $medias = $this->media->paginate(40, "created_at");
    $categories = $this->category->getWithCondition(['publish' => 1, 'type' => 'Category']);
    $brands = $this->brand->getWithCondition(['publish' => 1, 'type' => 'Brand']);
    $powers = $this->power->getWithCondition(['publish' => 1, 'type' => 'Power']);

    return view('cms.addon.edit')
      ->with('addon', $addon)
      ->with('categories', $categories)
      ->with('brands', $brands)
      ->with('powers', $powers)
      ->with('lastPage', $medias->lastPage());
  }

  /**
   * Update addon detail
   *
   * @param ProductAddonRequest $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(AddonRequest $request, $id)
  {
    $this->authorize('update', Addon::class);

    $addon = $this->addon->find($id);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'addon_name', 'price', 'summary', 'description'
      ]);

      $input['image'] = $request->featured_image;
      $input['user_id'] = auth()->user()->id;

      if($request->featured_image == "")
        $input['image'] = asset('uploads/default.png');

      $input['publish'] = 0;

      if (isset($request->publish))
        $input['publish'] = 1;

      $this->addon->update($id, $input);
      $this->db->commit();


      return redirect()->route('cms::addons.index')
        ->with('success', 'Addon updated successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::addons.edit', ['addon' => $id])
        ->with('error', 'Filed to update addon. ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Delete given addon
   *
   * @param Addon $addon
   * @return string
   */
  public function delete(Addon $addon)
  {
    $this->authorize('delete', Addon::class);

    try {
      $this->db->beginTransaction();
      $this->addon->delete($addon->id);

      $this->db->commit();
      return redirect()->route('cms::addons.index')
        ->with('success', 'Addon deleted successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::addons.index')
        ->with('error', 'Filed to delete addon. '.$e->getMessage())
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
