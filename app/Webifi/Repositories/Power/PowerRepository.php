<?php

namespace App\Webifi\Repositories\Power;

use App\Webifi\Repositories\Repository;

class PowerRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Power\Power';
    }
}