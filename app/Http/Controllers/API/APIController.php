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

class APIController extends Controller
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
  public function index()
  {
    $boilers = $this->boiler->getWithCondition(['publish' => 1], 'boiler_name', 'asc', ["*"], 100);
    return ["boiler" => $boilers];
  }

  /**
   * Show all boiler by power range
   * 
   * @param $type
   * @param $power
   * @return Array
   */
  public function boilers($type, $power)
  {
    $powerRange = explode("-",$power);
    $boilers = $this->boiler->getWithConditionBetween(['publish' => 1, "boiler_type" => $type], $powerRange, 'boiler_name', 'asc', ["*"], 100);
    return ["boiler" => $boilers];
  }

  /**
   * Show all boiler by power range and price
   * 
   * @param $type
   * @param $power
   * @return Array
   */
  public function boilersByPrice($type, $power)
  {
    $powerRange = explode("-",$power);
    $boilers = $this->boiler->getWithConditionBetween(['publish' => 1, "boiler_type" => $type], $powerRange, 'price', 'asc', ["*"], 100);
    return ["boiler" => $boilers];
  }

  /**
   * Show all boiler by power range and price
   * 
   * @param $type
   * @param $power
   * @param $brand
   * @return Array
   */
  public function boilersByBrand($type, $power, $brand)
  {
    $powerRange = explode("-",$power);
    $boilers = $this->boiler->getWithConditionBetween(['publish' => 1, "boiler_type" => $type, "brand" => $brand], $powerRange, 'price', 'asc', ["*"], 100);
    return ["boiler" => $boilers];
  }

  /**
   * Find boiler
   *
   * @param $id
   * @return Array
   */
  public function boiler($id)
  {
    $boiler = $this->boiler->find($id);
    return ["boiler" => $boiler];
  }

   /**
   * Show all brand
   *
   * @return Array
   */
  public function allBrands()
  {
    $brand = $this->brand->getWithCondition(['publish' => 1], 'category', 'asc', ["*"], 100);
    return ["brands" => $brand];
  }

   /**
   * Find brand
   *
   * @param $id
   * @return Array
   */
  public function brand($id)
  {
    $brand = $this->brand->find($id);
    return ["brand" => $brand];
  }

   /**
   * Find addon
   * 
   * @param $id
   * @return Array
   */
  public function addon($id)
  {
    $addon = $this->addon->find($id);
    return ["addon" => $addon];
  }

  /**
   * Show all devices
   * 
   * @return Array
   */
  public function smartDevice()
  {
    return ["device" => $this->device->getWithCondition(['publish' => 1], 'device_name', 'asc', ["*"], 100)];
  }

  /**
   * Get all control devices
   * 
   * @return Array
   */
  public function controlDevices($id)
  {
    return ["device" => $this->addon->getWithCondition(['publish' => 1], 'addon_name', 'asc', ["*"], 100)];
  }
  
}
