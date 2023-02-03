<?php

namespace App\Http\Controllers\API;

use App\Webifi\Models\Boiler\Boiler;
use App\Webifi\Repositories\Boiler\BoilerRepository;
use App\Webifi\Repositories\Brand\BrandRepository;
use App\Webifi\Repositories\Category\CategoryRepository;
use App\Webifi\Repositories\Power\PowerRepository;
use App\Webifi\Repositories\Media\MediaRepository;
use App\Webifi\Repositories\Addon\AddonRepository;
use App\Webifi\Repositories\Device\DeviceRepository;
use App\Http\Requests\BoilerRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;
use \Illuminate\Pagination\Paginator;

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
   * DeviceRepository $device
   */
  private $device;

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
   * APIController constructor.
   * @param BoilerRepository $boiler
   * @param AddonRepository $addon
   * @param DeviceRepository $device
   * @param MediaRepository $media
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    BoilerRepository $boiler,
    BrandRepository $brand,
    AddonRepository $addon,
    DeviceRepository $device,
    CategoryRepository $category,
    PowerRepository $power,
    MediaRepository $media,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->boiler   = $boiler;
    $this->addon    = $addon;
    $this->device   = $device;
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
   * @return Array
   */
  /*public function index($limit = 20, $currentPage = 1)
  {
    Paginator::currentPageResolver(function () use ($currentPage) {
      return $currentPage;
    });

    $boilers = $this->boiler->getWithCondition(['publish' => 1], 'boiler_name', 'asc', ["*"], $limit);
    return ["boiler" => $boilers];
  }*/
  
  /**
   * Show all boiler by power range
   * 
   * @param $type
   * @param $power
   * @return Array
   */
  public function boilers($type, $power)
  {
    $query = request()->query();
    
    $cat = $query['cat']??''; 
    $limit = $query['limit']??10;
    $page = $query['page']??1;
    $sort_by = $query['sort_by']??'boiler_name';
    $sort = $query['sort']??'asc';

    $condition = [];
    $condition['publish'] = 1;
    $condition['boiler_type'] = $type;
    if ($cat)
      $condition['brand'] = $cat;

    if ($sort_by == "net_price")
      $sort_by = 'price - ifnull(discount,0)';

    $powerRange = explode("-",$power);
    $boilers = $this->boiler->paginateWithConditionBetween($condition, $powerRange, $sort_by, $sort, ["*"], $limit);
    return ["boiler" => $boilers];
  }
  
}
