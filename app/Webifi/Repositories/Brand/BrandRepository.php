<?php

namespace App\Webifi\Repositories\Brand;

use App\Webifi\Repositories\Repository;

class BrandRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Brand\Brand';
    }
}