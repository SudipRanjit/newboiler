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
    public function getModel()
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
        $orderBy = 'id',
        $orderType = 'desc',
        $columns = array('*'),
        $limit = 20
    ) {
        return $this->model->where($conditions)->whereBetween("central_heating_output", $betWeenCondition)->orderBy($orderBy, $orderType)->limit($limit)->get($columns);
    }

    /**
     * Paginate the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function paginateWithConditionBetween(
        $conditions,
        $betWeenCondition,
        $orderBy = 'id',
        $orderType = 'desc',
        $columns = array('*'),
        $limit = 20
    ) {
        return $this->model->select($columns)->where($conditions)->whereBetween("central_heating_output", $betWeenCondition) /*->orderBy($orderBy, $orderType)*/->orderByRaw("$orderBy $orderType")->paginate($limit);
    }

    /**
     * Paginate the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function paginateAndSortWithConditionBetween(
        $conditions,
        $betWeenCondition,
        $orderBy = 'id',
        $orderType = 'desc',
        $columns = array('*'),
        $limit = 20
    ) {
        return $this->model->from('boilers as b')
            ->join('categories as c', 'c.id', 'b.brand')
            ->select($columns)->where($conditions)
            ->whereBetween("central_heating_output", $betWeenCondition) 
            // ->orderBy($orderBy, $orderType)
            ->orderByRaw("c.s_order asc, $orderBy $orderType")
            ->with(['tags', 'features'])
            ->paginate($limit);
    }
}
