<?php

namespace App\Http\Controllers\CMS\Power;

use App\Webifi\Models\Power\Power;
use App\Webifi\Repositories\Power\PowerRepository;
use App\Http\Requests\PowerRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class PowerController extends Controller
{
  /**
   * PowerRepository $power
   */
  private $power;

  /**
   * @var DatabaseManager
   */
  private $db;

  /**
   * @var LoggerInterface
   */
  private $log;

  /**
   * PowerController constructor.
   * @param PowerRepository $power
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    PowerRepository $power,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->power = $power;
    $this->db   = $db;
    $this->log  = $log;
  }

  /**
   * Show all power
   *
   * @return View
   */
  public function index()
  {
    $this->authorize('view', Power::class);
    $powers = $this->power->paginateAllWithCondition(["type" => "Power"], "id", "desc", 40);
    return view('cms.power.index')->with('powers', $powers);
  }

   /**
   * Show all power
   *
   * @param Request $request
   * @return View
   */
  public function search(Request $request)
  {
    $this->authorize('view', Power::class);
    $powers = $this->power->searchCategoryWithMultipleCondition(["type" => "Power"] ,$request->search_txt, "id", "desc", 40);
    return view('cms.power.index')->with('powers', $powers)->with("searchTxt", $request->search_txt);
  }

  /**
   * Show form to create new power
   *
   * @return View
   */
  public function create()
  {
    $this->authorize('create', Power::class);
    $powers = $this->power->getWithCondition(['publish' => 1, 'parent' => 0])->pluck('power', 'id');
    return view('cms.power.create')
      ->with('powers', $powers);
  }

  /**
   * Store newly created power
   *
   * @param PowerRequest $request
   * @return $this|\Illuminate\Http\RedirectResponse
   */
  public function store(PowerRequest $request)
  {
    $this->authorize('create', Power::class);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'category', 'slug', 'parent', 'type'
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

      $this->power->store($input);

      $this->db->commit();

      return redirect()->route('cms::powers.index')
        ->with('success', "Power added successfully.");
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::powers.create')
        ->with('error', "Failed to add tag. " . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Show form to edit power
   *
   * @param Power $power
   * @return View
   */
  public function edit(Power $power)
  {
    $this->authorize('update', Power::class);
    $powers = $this->power->getWithCondition(['publish' => 1, 'parent' => 0])->pluck('power', 'id');
    return view('cms.power.edit')
      ->with('power', $power)
      ->with('powers', $powers);
  }

  /**
   * Update power detail
   *
   * @param ProductPowerRequest $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(PowerRequest $request, $id)
  {
    $this->authorize('update', Power::class);

    $power = $this->power->find($id);
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'category', 'slug', 'parent', 'type'
      ]);
      $input['publish'] = 0;
      $input['show_in_menu'] = 0;

      if (isset($request->publish))
        $input['publish'] = 1;
      if (isset($request->show_in_menu))
        $input['show_in_menu'] = 1;
        
      if ($request->hasFile('icon_dark')) {
        $input['icon_dark'] = uploadImage($request, 'icon_dark', 'uploads/icons');
        if ($power->icon_dark != 'default.png')
          $this->deleteImage($power->icon_dark);
      }

      if ($request->hasFile('icon_light')) {
        $input['icon_light'] = uploadImage($request, 'icon_light', 'uploads/icons');
        if ($power->icon_light != 'default.png')
          $this->deleteImage($power->icon_light);
      }

      $this->power->update($id, $input);
      $this->db->commit();


      return redirect()->route('cms::powers.index')
        ->with('success', 'Power updated successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::powers.edit', ['power' => $id])
        ->with('error', 'Filed to update power. ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Delete given power
   *
   * @param Power $power
   * @return string
   */
  public function delete(Power $power)
  {
    $this->authorize('delete', Power::class);

    $child = $this->power->findWithCondition(['parent' => $power->id]);
    if ($child != null && count($child->toArray()) != 0)
      return redirect()->route('cms::powers.index')
        ->with('error', 'Failed to delete power. Delete child powers first');
    try {
      $this->db->beginTransaction();
      $this->power->delete($power->id);

      if ($power->icon_dark != 'default.png')
        $this->deleteImage($power->icon_dark);

      if ($power->icon_light != 'default.png')
        $this->deleteImage($power->icon_light);

      $this->db->commit();
      return redirect()->route('cms::powers.index')
        ->with('success', 'Power deleted successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::powers.index')
        ->with('error', 'Filed to delete power. '.$e->getMessage())
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
