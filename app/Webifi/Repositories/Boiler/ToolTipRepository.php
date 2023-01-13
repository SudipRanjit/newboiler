<?php

namespace App\Webifi\Repositories\Boiler;

use App\Webifi\Repositories\Repository;

class ToolTipRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Boiler\ToolTip';
    }
}