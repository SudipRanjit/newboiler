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

    /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function searchWithMultipleCondition(
        $conditions = [],
        $searchCondition, 
        $orderBy='id', 
        $orderType = 'desc', 
        $columns = array('*'),
        $limit = 40
    )
    {
        $q = $this->model;
        if(count($conditions) > 0)
          $q = $q->where($conditions);
  
          $q = $q->where(function($query) use ($searchCondition) {
          $query->where('id', '=', $searchCondition)
                ->orWhere('title', 'like', '%'.$searchCondition.'%');
              
        });
  
        return $q->orderBy($orderBy, $orderType)->paginate($limit, $columns);
    }
}