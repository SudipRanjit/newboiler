<?php

namespace App\Webifi\Repositories\Radiator;

use App\Webifi\Repositories\Repository;

class RadiatorPriceRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Radiator\RadiatorPrice';
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
          ->orWhereHas('radiator_type', function ($qrt) use ($searchCondition) {
            $qrt->where('type',  'like', '%'.$searchCondition.'%');
           })
           ->orWhereHas('radiator_height', function ($qrh) use ($searchCondition) {
            $qrh->where('height',  'like', '%'.$searchCondition.'%');
           })
           ->orWhereHas('radiator_length', function ($qrl) use ($searchCondition) {
            $qrl->where('length',  'like', '%'.$searchCondition.'%');
           })
            ->orWhere('price', 'like', '%'.$searchCondition.'%')
            ->orWhere('btu', 'like', '%'.$searchCondition.'%');
        });
  
        return $q->orderBy($orderBy, $orderType)->paginate($limit, $columns);
    }

}