<?php

namespace App\Webifi\Repositories\Boiler;

use App\Webifi\Repositories\Repository;

class TagRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    public function getModel()
    {
        return 'App\Webifi\Models\Boiler\Tag';
    }
}
