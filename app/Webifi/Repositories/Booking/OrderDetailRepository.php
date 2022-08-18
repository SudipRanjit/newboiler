<?php

namespace App\Webifi\Repositories\Booking;

use App\Webifi\Repositories\Repository;

class OrderDetailRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Booking\OrderDetail';
    }

}