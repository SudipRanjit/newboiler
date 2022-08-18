<?php

namespace App\Webifi\Repositories\Booking;

use App\Webifi\Repositories\Repository;

class PaymentGatewayRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Booking\PaymentGateway';
    }

}