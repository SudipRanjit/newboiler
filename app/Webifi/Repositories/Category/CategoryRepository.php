<?php

namespace App\Webifi\Repositories\Category;

use App\Webifi\Repositories\Repository;

class CategoryRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Category\Category';
    }
}