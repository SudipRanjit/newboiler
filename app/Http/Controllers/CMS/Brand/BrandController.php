<?php

namespace App\Http\Controllers\CMS\Brand;

use App\Webifi\Models\Brand\Brand;
use App\Webifi\Repositories\Brand\BrandRepository;
use App\Webifi\Repositories\Media\MediaRepository;
use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class BrandController extends Controller
{
  /**
   * BrandRepository $brand
   */
  private $brand;

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
   * BrandController constructor.
   * @param BrandRepository $brand
   * @param MediaRepository $media
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    BrandRepository $brand,
    MediaRepository $media,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->brand = $brand;
    $this->media = $media;
    $this->db   = $db;
    $this->log  = $log;
  }

  /**
   * Show all brand
   *
   * @return View
   */
  public function index()
  {
    $this->authorize('view', Brand::class);
    $brands = $this->brand->paginateAllWithCondition(["type" => "Brand"], "id", "desc", 40);
    return view('cms.brand.index')->with('brands', $brands);
  }

   /**
   * Show all brand
   *
   * @param Request $request
   * @return View
   */
  public function search(Request $request)
  {
    $this->authorize('view', Brand::class);
    $brands = $this->brand->searchCategoryWithMultipleCondition(["type" => "Brand"] ,$request->search_txt, "id", "desc", 40);
    return view('cms.brand.index')->with('brands', $brands)->with("searchTxt", $request->search_txt);
  }

  /**
   * Show form to create new brand
   *
   * @return View
   */
  public function create()
  {
    $this->authorize('create', Brand::class);

    $medias = $this->media->paginate(40, "created_at");

    $brands = $this->brand->getWithCondition(['publish' => 1, 'parent' => 0])->pluck('brand', 'id');
    return view('cms.brand.create')
      ->with('brands', $brands)
      ->with('lastPage', $medias->lastPage());
  }

  /**
   * Store newly created brand
   *
   * @param BrandRequest $request
   * @return $this|\Illuminate\Http\RedirectResponse
   */
  public function store(BrandRequest $request)
  {
    $this->authorize('create', Brand::class);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'category', 'slug', 'parent', 'type', 'description', 'url'
      ]);

      $input['publish'] = 0;
      $input['show_in_menu'] = 0;

      if (isset($request->publish))
        $input['publish'] = 1;

      if (isset($request->show_in_menu))
        $input['show_in_menu'] = 1;

      if ($request->hasFile('icon_dark')) {
        $input['icon_dark'] = uploadImage($request, 'icon_dark', 'uploads/icons');
      }

      if ($request->hasFile('icon_light')) {
        $input['icon_light'] = uploadImage($request, 'icon_light', 'uploads/icons');
      }

      $this->brand->store($input);

      $this->db->commit();

      return redirect()->route('cms::brands.index')
        ->with('success', "Brand added successfully.");
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::brands.create')
        ->with('error', "Failed to add tag. " . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Show form to edit brand
   *
   * @param Brand $brand
   * @return View
   */
  public function edit(Brand $brand)
  {
    $this->authorize('update', Brand::class);
    $brands = $this->brand->getWithCondition(['publish' => 1, 'parent' => 0])->pluck('brand', 'id');
    $medias = $this->media->paginate(40, "created_at");

    return view('cms.brand.edit')
      ->with('brand', $brand)
      ->with('brands', $brands)
      ->with('lastPage', $medias->lastPage());
  }

  /**
   * Update brand detail
   *
   * @param ProductBrandRequest $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(BrandRequest $request, $id)
  {
    $this->authorize('update', Brand::class);

    $brand = $this->brand->find($id);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'category', 'slug', 'parent', 'type', 'description', 'url'
      ]);
      $input['publish'] = 0;
      $input['show_in_menu'] = 0;

      if (isset($request->publish))
        $input['publish'] = 1;
      if (isset($request->show_in_menu))
        $input['show_in_menu'] = 1;
        
      if ($request->hasFile('icon_dark')) {
        $input['icon_dark'] = uploadImage($request, 'icon_dark', 'uploads/icons');
        if ($brand->icon_dark != 'default.png')
          $this->deleteImage($brand->icon_dark);
      }

      if ($request->hasFile('icon_light')) {
        $input['icon_light'] = uploadImage($request, 'icon_light', 'uploads/icons');
        if ($brand->icon_light != 'default.png')
          $this->deleteImage($brand->icon_light);
      }

      $this->brand->update($id, $input);
      $this->db->commit();


      return redirect()->route('cms::brands.index')
        ->with('success', 'Brand updated successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::brands.edit', ['brand' => $id])
        ->with('error', 'Filed to update brand. ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Delete given brand
   *
   * @param Brand $brand
   * @return string
   */
  public function delete(Brand $brand)
  {
    $this->authorize('delete', Brand::class);

    $child = $this->brand->findWithCondition(['parent' => $brand->id]);
    if ($child != null && count($child->toArray()) != 0)
      return redirect()->route('cms::brands.index')
        ->with('error', 'Failed to delete brand. Delete child brands first');
    try {
      $this->db->beginTransaction();
      $this->brand->delete($brand->id);

      if ($brand->icon_dark != 'default.png')
        $this->deleteImage($brand->icon_dark);

      if ($brand->icon_light != 'default.png')
        $this->deleteImage($brand->icon_light);

      $this->db->commit();
      return redirect()->route('cms::brands.index')
        ->with('success', 'Brand deleted successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::brands.index')
        ->with('error', 'Filed to delete brand. '.$e->getMessage())
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
