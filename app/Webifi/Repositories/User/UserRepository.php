<?php

namespace App\Webifi\Repositories\User;

use App\Webifi\Repositories\Repository;

class UserRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\User\User';
    }
}