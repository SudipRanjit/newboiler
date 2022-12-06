<?php

namespace App\Webifi\Repositories\Booking;

use App\Webifi\Repositories\Repository;

class OrderRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Booking\Order';
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
          $query->where('transaction_id', 'like', '%'.$searchCondition.'%')
                ->orWhere('vendor_transaction_id', 'like', '%'.$searchCondition.'%')
                ->orWhere('amount', 'like', '%'.$searchCondition.'%')
                ->orWhere('discount', 'like', '%'.$searchCondition.'%')
                ->orWhere('created_at', 'like', '%'.$searchCondition.'%')
                ->orWhere('payout_amount', 'like', '%'.$searchCondition.'%')
                
          ->orWhereHas('billing_address', function ($qb) use ($searchCondition) {
            $qb->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%".$searchCondition."%"])
                ->orWhere('email', 'like', '%'.$searchCondition.'%')
                ->orWhere('city', 'like', '%'.$searchCondition.'%')
                ->orWhere('postcode', 'like', '%'.$searchCondition.'%')
                ->orWhere('address_line_1', 'like', '%'.$searchCondition.'%')
                ->orWhere('address_line_2', 'like', '%'.$searchCondition.'%')
                ->orWhere('address_line_3', 'like', '%'.$searchCondition.'%')
                ->orWhere('contact_number', 'like', '%'.$searchCondition.'%')
                ->orWhere('note', 'like', '%'.$searchCondition.'%')
                ;
           })
           ->orWhereHas('booking', function ($qb) use ($searchCondition) {
            $qb->where('appointment_date', 'like', '%'.$searchCondition.'%')
                ;
           })
           ->orWhereHas('payment_gateway', function ($qp) use ($searchCondition) {
            $qp->where('title', 'like', '%'.$searchCondition.'%')
                ;
           }) 
            ;
        });
  
        return $q->orderBy($orderBy, $orderType)->paginate($limit, $columns);
    }

}