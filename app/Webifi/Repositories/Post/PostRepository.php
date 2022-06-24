<?php

namespace App\Webifi\Repositories\Post;

use App\Webifi\Repositories\Repository;

class PostRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Post\Post';
    }
}