<?php

namespace App\Webifi\Repositories\Boiler;

use App\Webifi\Repositories\Repository;

class BoilerTagRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    public function getModel()
    {
        return 'App\Webifi\Models\Boiler\BoilerTag';
    }
}
