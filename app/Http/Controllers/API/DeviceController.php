<?php

namespace App\Http\Controllers\API;

use App\Webifi\Repositories\Device\DeviceRepository;
use App\Webifi\Repositories\Media\MediaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;
use \Illuminate\Pagination\Paginator;

class DeviceController extends Controller
{
  
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
   * @param DeviceRepository $device
   * @param MediaRepository $media
   * @param DatabaseManager $db
   * @param LoggerInterface $log
   */
  public function __construct(
    DeviceRepository $device,
    MediaRepository $media,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->device   = $device;
    $this->media    = $media;
    $this->db       = $db;
    $this->log      = $log;
  }

  /**
   * Get all devices with pagination
   * 
   * @return Array
   */
  public function devices()
  {
    $query = request()->query();
    
    $limit = $query['limit']??4;
    $page = $query['page']??1;
    $sort_by = $query['sort_by']??'device_name';
    $sort = $query['sort']??'asc';
   
    $condition = [];
    $condition['publish'] = 1;
       
    $devices = $this->device->paginateWithCondition($condition, $sort_by, $sort, ["*"], $limit);
    return ["device" => $devices];
  }

  
}
