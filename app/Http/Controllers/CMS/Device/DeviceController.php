<?php

namespace App\Http\Controllers\CMS\Device;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceRequest;
use App\Webifi\Models\Device\Device;
use App\Webifi\Repositories\Brand\BrandRepository;
use App\Webifi\Repositories\Category\CategoryRepository;
use App\Webifi\Repositories\Device\DeviceRepository;
use App\Webifi\Repositories\Media\MediaRepository;
use App\Webifi\Repositories\Power\PowerRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class DeviceController extends Controller
{
    /**
     * DeviceRepository $device
     */
    private $device;

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
     * DeviceController constructor.
     * @param DeviceRepository $device
     * @param BrandRepository $brand
     * @param CategoryRepository $category
     * @param PowerRepository $power
     * @param MediaRepository $media
     * @param DatabaseManager $db
     * @param LoggerInterface $log
     */
    public function __construct(
        DeviceRepository $device,
        BrandRepository $brand,
        CategoryRepository $category,
        PowerRepository $power,
        MediaRepository $media,
        DatabaseManager $db,
        LoggerInterface $log
    ) {
        $this->device = $device;
        $this->brand = $brand;
        $this->category = $category;
        $this->power = $power;
        $this->media = $media;
        $this->db = $db;
        $this->log = $log;
    }

    /**
     * Show all device
     *
     * @return View
     */
    public function index()
    {
        $this->authorize('view', Device::class);
        $devices = $this->device->paginate(40);
        return view('cms.device.index')->with('devices', $devices);
    }

    /**
     * Show all device
     *
     * @param Request $request
     * @return View
     */
    public function search(Request $request)
    {
        $this->authorize('view', Device::class);
        $devices = $this->device->searchWithMultipleCondition([], $request->search_txt, "id", "desc", ['*'], 40);
        return view('cms.device.index')->with('devices', $devices)->with("searchTxt", $request->search_txt);
    }

    /**
     * Show form to create new device
     *
     * @return View
     */
    public function create()
    {
        $this->authorize('create', Device::class);

        $medias = $this->media->paginate(40, "created_at");

        $categories = $this->category->getWithCondition(['publish' => 1, 'type' => 'Category']);
        $brands = $this->brand->getWithCondition(['publish' => 1, 'type' => 'Brand']);
        $powers = $this->power->getWithCondition(['publish' => 1, 'type' => 'Power']);

        return view('cms.device.create')
            ->with('categories', $categories)
            ->with('brands', $brands)
            ->with('powers', $powers)
            ->with('lastPage', $medias->lastPage());
    }

    /**
     * Store newly created device
     *
     * @param DeviceRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(DeviceRequest $request)
    {
        $this->authorize('create', Device::class);
        try {
            $this->db->beginTransaction();

            $input = $request->only([
                'device_name', 'price', 'summary', 'description', 's_order'
            ]);

            $input['image'] = $request->featured_image;
            $input['user_id'] = auth()->user()->id;

            if ($request->featured_image == "") {
                $input['image'] = asset('uploads/default.png');
            }

            $input['publish'] = 0;

            if (isset($request->publish)) {
                $input['publish'] = 1;
            }

            $input['combi'] = 0;

            if (isset($request->combi)) {
                $input['combi'] = 1;
            }

            $input['standard'] = 0;

            if (isset($request->standard)) {
                $input['standard'] = 1;
            }

            $input['system'] = 0;

            if (isset($request->system)) {
                $input['system'] = 1;
            }

            $this->device->store($input);

            $this->db->commit();

            return redirect()->route('cms::devices.index')
                ->with('success', "Device added successfully.");
        } catch (\Exception $e) {
            $this->db->rollback();
            $this->log->error((string) $e);

            return redirect()->route('cms::devices.create')
                ->with('error', "Failed to add device. " . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show form to edit device
     *
     * @param Device $device
     * @return View
     */
    public function edit(Device $device)
    {
        $this->authorize('update', Device::class);

        $medias = $this->media->paginate(40, "created_at");
        $categories = $this->category->getWithCondition(['publish' => 1, 'type' => 'Category']);
        $brands = $this->brand->getWithCondition(['publish' => 1, 'type' => 'Brand']);
        $powers = $this->power->getWithCondition(['publish' => 1, 'type' => 'Power']);

        return view('cms.device.edit')
            ->with('device', $device)
            ->with('categories', $categories)
            ->with('brands', $brands)
            ->with('powers', $powers)
            ->with('lastPage', $medias->lastPage());
    }

    /**
     * Update device detail
     *
     * @param ProductDeviceRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DeviceRequest $request, $id)
    {
        $this->authorize('update', Device::class);

        $device = $this->device->find($id);
        try {
            $this->db->beginTransaction();

            $input = $request->only([
                'device_name', 'price', 'summary', 'description', 's_order'
            ]);

            $input['image'] = $request->featured_image;
            $input['user_id'] = auth()->user()->id;

            if ($request->featured_image == "") {
                $input['image'] = asset('uploads/default.png');
            }

            $input['publish'] = 0;

            if (isset($request->publish)) {
                $input['publish'] = 1;
            }
            
            $input['combi'] = 0;

            if (isset($request->combi)) {
                $input['combi'] = 1;
            }

            $input['standard'] = 0;

            if (isset($request->standard)) {
                $input['standard'] = 1;
            }

            $input['system'] = 0;

            if (isset($request->system)) {
                $input['system'] = 1;
            }

            $this->device->update($id, $input);
            $this->db->commit();

            return redirect()->route('cms::devices.index')
                ->with('success', 'Device updated successfully.');
        } catch (\Exception $e) {
            $this->db->rollback();
            $this->log->error((string) $e);

            return redirect()->route('cms::devices.edit', ['device' => $id])
                ->with('error', 'Filed to update device. ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete given device
     *
     * @param Device $device
     * @return string
     */
    public function delete(Device $device)
    {
        $this->authorize('delete', Device::class);

        try {
            $this->db->beginTransaction();
            $this->device->delete($device->id);

            $this->db->commit();
            return redirect()->route('cms::devices.index')
                ->with('success', 'Device deleted successfully.');
        } catch (\Exception $e) {
            $this->db->rollback();
            $this->log->error((string) $e);

            return redirect()->route('cms::devices.index')
                ->with('error', 'Filed to delete device. ' . $e->getMessage())
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
        if (file_exists(public_path('uploads/icons/' . $image))) {
            unlink(public_path('uploads/icons/' . $image));
        }
    }
}
