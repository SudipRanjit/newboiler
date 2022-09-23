<?php

namespace App\Webifi\Repositories\Booking;

use App\Webifi\Repositories\Repository;

class BlockDateRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Booking\BlockDate';
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
            ->orWhere('date', 'like', '%'.$searchCondition.'%')
            ->orWhere('note', 'like', '%'.$searchCondition.'%');
        });
  
        return $q->orderBy($orderBy, $orderType)->paginate($limit, $columns);
    }

    /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function getWithCondition(
        $conditions, 
        $orderBy='id', 
        $orderType = 'desc', 
        $columns = array('*'),
        $limit = 10
    )
    {
        return $this->model->where($conditions)->where('date','>=',date('Y-m-d'))->orderBy($orderBy, $orderType)->limit($limit)->get($columns);
    }
}