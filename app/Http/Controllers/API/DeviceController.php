<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Webifi\Repositories\Device\DeviceRepository;
use App\Webifi\Repositories\Media\MediaRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Psr\Log\LoggerInterface;

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
        $this->device = $device;
        $this->media = $media;
        $this->db = $db;
        $this->log = $log;
    }

    /**
     * Get all devices with pagination
     *
     * @return Array
     */
    public function devices()
    {
        $query = request()->query();

        $selection = Session::get('selection');

        $limit = $query['limit'] ?? 4;
        $page = $query['page'] ?? 1;
        $sort_by = $query['sort_by'] ?? 's_order';
        $sort = $query['sort'] ?? 'asc';

        $condition = [];
        $condition['publish'] = 1;

        $type = $selection["boiler_type"];

        if (strtolower($type) == "combi") {
            $condition['combi'] = true;
        }

        if (strtolower($type) == "standard") {
            $condition['standard'] = true;
        }

        if (strtolower($type) == "system") {
            $condition['system'] = true;
        }

        $devices = $this->device->paginateWithCondition($condition, $sort_by, $sort, ["*"], $limit);
        return ["device" => $devices];
    }

}
