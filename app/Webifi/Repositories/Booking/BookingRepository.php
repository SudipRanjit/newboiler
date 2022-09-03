<?php

namespace App\Webifi\Repositories\Booking;

use App\Webifi\Repositories\Repository;

class BookingRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Booking\Booking';
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
          $query->where('order_id', 'like', '%'.$searchCondition.'%')
          ->orWhereHas('order', function ($qo) use ($searchCondition) {
            $qo->where('transaction_id',  'like', '%'.$searchCondition.'%');
           })
            ->orWhere('booking_id', 'like', '%'.$searchCondition.'%')
            ->orWhere('amount', 'like', '%'.$searchCondition.'%')
            ->orWhere('discount', 'like', '%'.$searchCondition.'%')
            ->orWhere('appointment_date', 'like', '%'.$searchCondition.'%')
            ->orWhere('created_at', 'like', '%'.$searchCondition.'%')
            ;
        });
  
        return $q->orderBy($orderBy, $orderType)->paginate($limit, $columns);
    }
}