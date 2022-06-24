<?php

namespace App\Webifi\Repositories\Boiler;

use App\Webifi\Repositories\Repository;

class BoilerRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Boiler\Boiler';
    }

     /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function getWithConditionBetween(
      $conditions,
      $betWeenCondition, 
      $orderBy='id', 
      $orderType = 'desc', 
      $columns = array('*'),
      $limit = 20
  )
  {
      return $this->model->where($conditions)->whereBetween("central_heating_output", $betWeenCondition)->orderBy($orderBy, $orderType)->limit($limit)->get($columns);
  }
}