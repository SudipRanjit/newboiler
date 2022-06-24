<?php

namespace App\Webifi\Repositories\Media;

use App\Webifi\Repositories\Repository;

class MediaRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Media\Media';
    }
}