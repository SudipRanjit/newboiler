<?php

namespace App\Webifi\Repositories\Device;

use App\Webifi\Repositories\Repository;

class DeviceRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Device\Device';
    }
}