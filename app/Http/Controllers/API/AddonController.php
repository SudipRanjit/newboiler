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

class AddonController extends Controller
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
   * Get all control devices with pagination
   * 
   * @return Array
   */
  public function controls()
  {
    $query = request()->query();
    
    $limit = $query['limit']??4;
    $page = $query['page']??1;
    $sort_by = $query['sort_by']??'addon_name';
    $sort = $query['sort']??'asc';
   
    $condition = [];
    $condition['publish'] = 1;
       
    $boilers = $this->addon->paginateWithCondition($condition, $sort_by, $sort, ["*"], $limit);
    return ["boiler" => $boilers];
  }

  
}
