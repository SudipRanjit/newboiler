<?php

namespace App\Webifi\Repositories\Addon;

use App\Webifi\Repositories\Repository;

class AddonRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\Webifi\Models\Addon\Addon';
    }

    /**
     * Paginate the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function paginateWithCondition(
        $conditions,
        $orderBy='id', 
        $orderType = 'desc', 
        $columns = array('*'),
        $limit = 20
    )
    {
        return $this->model->select($columns)->where($conditions)->orderBy($orderBy, $orderType)->paginate($limit);
    }

    /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function paginateWithConditionInArray(
      $conditions, 
      $id, 
      $array,
      $orderBy='id', 
      $orderType = 'desc', 
      $columns = array('*'),
      $limit = 10
  )
  {
      return $this->model->where($conditions)->whereIn($id, $array)->orderBy($orderBy, $orderType)->select($columns)->paginate($limit);
  }
}