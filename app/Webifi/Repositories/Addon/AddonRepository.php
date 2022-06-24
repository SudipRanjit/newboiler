<?php

namespace App\Webifi\Repositories\Addon;

use App\Webifi\Repositories\Repository;

class AddonRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Addon\Addon';
    }
}