<?php

namespace App\Http\Controllers\CMS\ToolTip;

use App\Webifi\Repositories\Boiler\ToolTipRepository;
use App\Webifi\Models\Boiler\ToolTip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class ToolTipController extends Controller
{
  /**
   * ToolTipRepository $tooltip
   */
  private $tooltip;

  /**
   * @var DatabaseManager
   */
  private $db;

  /**
   * @var LoggerInterface
   */
  private $log;

  /**
   * ToolTipController constructor.
   * @param ToolTipRepository $tooltip
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    ToolTipRepository $tooltip,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->tooltip   = $tooltip;
    $this->db       = $db;
    $this->log      = $log;
  }

  /**
   * Show all tooltip
   *
   * @return View
   */
  public function index()
  {
    $this->authorize('view', ToolTip::class);
    $tooltip = $this->tooltip->find(1);
    return view('cms.tooltip.index')->with('tooltip', $tooltip);
  }

  /**
   * Show form to create new tooltip
   *
   * @return View
   */
  public function create()
  {
    $this->authorize('create', ToolTip::class);

    return view('cms.tooltip.create');
  }

  /**
   * Store newly created tooltip
   *
   * @param Request $request
   * @return $this|\Illuminate\Http\RedirectResponse
   */
  public function store(Request $request)
  {
    $this->authorize('create', ToolTip::class);
    try {
      $this->db->beginTransaction();

      
      $this->db->commit();

      return redirect()->route('cms::tooltips.index')
        ->with('success', "ToolTip added successfully.");
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::tooltips.create')
        ->with('error', "Failed to add tooltip. " . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Show form to edit tooltip
   *
   * @param ToolTip $tooltip
   * @return View
   */
  public function edit($tip)
  {
    $this->authorize('update', ToolTip::class);

    $tooltip = $this->tooltip->find(1);

    return view('cms.tooltip.edit')
      ->with('tip', $tip)
      ->with('tooltip', $tooltip);
  }

  /**
   * Update tooltip detail
   *
   * @param ProductRequest $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, $id)
  {
    $this->authorize('update', ToolTip::class);

    try {
      $this->db->beginTransaction();

      $input[$request->title] = $request->tip;

      $this->tooltip->update($id, $input);
      $this->db->commit();


      return redirect()->route('cms::tooltips.index')
        ->with('success', 'ToolTip updated successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::tooltips.edit', ['tooltip' => $id])
        ->with('error', 'Filed to update tooltip. ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Delete given tooltip
   *
   * @param ToolTip $tooltip
   * @return string
   */
  public function delete(ToolTip $tooltip)
  {
    $this->authorize('delete', ToolTip::class);

    try {
      $this->db->beginTransaction();
      $this->tooltip->delete($tooltip->id);

      $this->db->commit();
      return redirect()->route('cms::tooltips.index')
        ->with('success', 'ToolTip deleted successfully.');
    } catch (\Exception $e) {
      $this->db->rollback();
      $this->log->error((string)$e);

      return redirect()->route('cms::tooltips.index')
        ->with('error', 'Filed to delete tooltip. '.$e->getMessage())
        ->withInput();
    }
  }

}
