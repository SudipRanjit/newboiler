<?php

namespace App\Webifi\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Carbon\Carbon;


/**
 * Class Repository
 * @package App\MNepal\Repositories
 */
abstract class Repository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Repository constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->model = $this->makeModel($app);
    }

    /**
     * Get model name with namespace
     *
     * @return String
     */
    abstract function getModel();



    /**
     * Get model
     *
     * @param Application $app
     * @return Model
     */
    protected function makeModel($app)
    {
        return $app->make($this->getModel());
    }

    /**
     * Get all resources
     * @param array $columns
     * @return Collection
     */
    public function all($columns = array('*'))
    {
        return $this->model->all($columns);
    }

    /**
     * Get all resources
     * @param array $columns
     * @return Collection
     */
    public function getAll($columns = array('*'))
    {
        return $this->model->orderBy('id', 'DESC')->get($columns);
    }

    /**
     * Get paginated resources with given limit
     * @param int $limit
     * @param string $orderBy
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($limit = 15,$order = "id", $orderBy = 'desc')
    {
        return $this->model->orderBy($order,$orderBy)->paginate($limit);
    }
    /**
     * Store newly created resource
     * @param array $data
     * @return Model
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update specific resource.
     * @param array $data
     * @param $id
     * @return bool
     */
    public function update($id,array $data)
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * Update specific resource.
     * @param $field
     * @param $value
     * @param array $data
     * @return bool
     */
    public function updateWith($field, $value,array $data)
    {
        return $this->model->where($field, $value)->update($data);
    }

    /**
     * Delete specific resource
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Find specific resource
     * @param $id
     * @param array $columns
     * @return Object
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Find specific resource by given attribute
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return Object
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * Find all the resources by given attribute
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return Object
     */
    public function getBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->get($columns);
    }

    /**
     * Get list of resources
     *
     * @param $id
     * @param $value
     * @return mixed
     */
    public function pluck($id, $value){
        return $this->model->pluck($id, $value);
    }

    /**
     * Find an object with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Object
     */
    public function findWithCondition($conditions, $columns = array('*'))
    {
        return $this->model->where($conditions)->first($columns);
    }

    /**
     * Find an object with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Object
     */
    public function findWithConditionFront($conditions, $columns = array('*'))
    {
        return $this->model->where($conditions)->whereBetween('published_on',[ '2021-01-01 00:00:00',date('Y-m-d H:i:s')])->first($columns);
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
        return $this->model->where($conditions)->orderBy($orderBy, $orderType)->limit($limit)->get($columns);
    }

    /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function getWithConditionFront(
      $conditions, 
      $orderBy='id', 
      $orderType = 'desc', 
      $columns = array('*'),
      $limit = 10
  )
  {
      return $this->model->where($conditions)->whereBetween('published_on',[ '2021-01-01 00:00:00',date('Y-m-d H:i:s')])->orderBy($orderBy, $orderType)->limit($limit)->get($columns);
  }

  /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function getWithConditionFrontNotNull(
      $conditions, 
      $orderBy='id', 
      $orderType = 'desc', 
      $orderBy2 = 'saturday_priority',
      $orderType2 = 'asc',
      $columns = array('*'),
      $null = 'id',
      $limit = 40
  )
  {
      return $this->model->where($conditions)->orderBy($orderBy, $orderType)->orderBy($orderBy2, $orderType2)->whereNotNull($null)->distinct()
      ->groupBy('saturday_date')->paginate($limit, $columns);
  }

    /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function getInArray(
      $conditions, 
      $id, 
      $array,
      $orderBy='id', 
      $orderType = 'desc', 
      $columns = array('*'),
      $limit = 10
  )
  {
      return $this->model->where($conditions)->whereIn($id, $array)->orderBy($orderBy, $orderType)->limit($limit)->get($columns);
  }

  /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function getInArrayFront(
      $conditions, 
      $id, 
      $array,
      $orderBy='id', 
      $orderType = 'desc', 
      $columns = array('*'),
      $limit = 10
  )
  {
      return $this->model->where($conditions)->whereIn($id, $array)->whereBetween('published_on',[ '2021-01-01 00:00:00',date('Y-m-d H:i:s')])->orderBy($orderBy, $orderType)->limit($limit)->get($columns);
  }

      /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function paginateInArray(
      $conditions, 
      $id, 
      $array,
      $orderBy='id', 
      $orderType = 'desc', 
      $columns = array('*'),
      $limit = 10
  )
  {
      return $this->model->where($conditions)->whereIn($id, $array)->whereBetween('published_on',[ '2021-01-01 00:00:00',date('Y-m-d H:i:s')])->orderBy($orderBy, $orderType)->select($columns)->paginate($limit);
  }

   /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function paginateInArrayFront(
      $conditions, 
      $id, 
      $array,
      $orderBy='id', 
      $orderType = 'desc', 
      $columns = array('*'),
      $limit = 10
  )
  {
      return $this->model->where($conditions)->whereIn($id, $array)->whereBetween('published_on',[ '2021-01-01 00:00:00',date('Y-m-d H:i:s')])->orderBy($orderBy, $orderType)->select($columns)->paginate($limit);
  }

    /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function paginateWithCondition(
      $column,
      $condition, 
      $orderBy='id', 
      $orderType = 'desc', 
      $limit = 40
  )
  {
      return $this->model->where($column, 'like', '%'.$condition.'%')->orderBy($orderBy, $orderType)->paginate($limit);
  }

  /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function paginateWithConditionFront(
      $column,
      $condition, 
      $orderBy='id', 
      $orderType = 'desc', 
      $limit = 40
  )
  {
      return $this->model->where($column, 'like', '%'.$condition.'%')->whereBetween('published_on',[ '2021-01-01 00:00:00',date('Y-m-d H:i:s')])->orderBy($orderBy, $orderType)->paginate($limit);
  }

  /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function paginateAllWithCondition(
      $condition, 
      $orderBy='id', 
      $orderType = 'desc', 
      $limit = 40,
      $column = ['*']
  )
  {
      return $this->model->where($condition)->orderBy($orderBy, $orderType)->select($column)->paginate($limit);
  }

  
  /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function paginateAllWithConditionFront(
      $condition, 
      $orderBy='id', 
      $orderType = 'desc', 
      $limit = 40,
      $column = ['*']
  )
  {
      return $this->model->where($condition)->whereBetween('published_on',[ '2021-01-01 00:00:00',date('Y-m-d H:i:s')])->orderBy($orderBy, $orderType)->select($column)->paginate($limit);
  }

  /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function paginateWithMultipleCondition(
      $conditions, 
      $orderBy='id', 
      $orderType = 'desc', 
      $columns = array('*'),
      $limit = 40
  )
  {
      return $this->model->where($conditions)->orderBy($orderBy, $orderType)->paginate($limit, $columns);
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
      $q = $this->model->where(["in_stock" => "0"]); //Temporary workaround :(
      if(count($conditions) > 0)
        $q = $this->model->where($conditions);

        $q = $q->where(function($query) use ($searchCondition) {
        $query->where('id', '=', $searchCondition)
          ->orWhere('boiler_name', 'like', '%'.$searchCondition.'%')
          ->orWhere('summary', 'like', '%'.$searchCondition.'%');
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
    public function searchCategoryWithMultipleCondition(
      $conditions,
      $searchCondition, 
      $orderBy='id', 
      $orderType = 'desc', 
      $limit = 40,
      $columns = array('*')
    )
    {
      $q = $this->model->where($conditions);

      $q = $q->where(function($query) use ($searchCondition) {
        $query->where('id', '=', $searchCondition)
          ->orWhere('category', 'like', '%'.$searchCondition.'%');
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
    public function paginateWithMultipleConditionFront(
      $conditions, 
      $orderBy='id', 
      $orderType = 'desc', 
      $columns = array('*'),
      $limit = 40
  )
  {
      return $this->model->where($conditions)->whereBetween('published_on',[ '2021-01-01 00:00:00',date('Y-m-d H:i:s')])->orderBy($orderBy, $orderType)->paginate($limit, $columns);
  }

  /**
     * Get the resources with given condition(s)
     *
     * @param $conditions
     * @param array $columns
     * @return Collection
     */
    public function paginateRawWithMultipleConditionFront(
      $conditions, 
      $orderBy='id', 
      $orderType = 'desc', 
      $columns = array('*'),
      $limit = 40
  )
  {
      return $this->model->where($conditions)->whereBetween('published_on',[ '2021-01-01 00:00:00',date('Y-m-d H:i:s')])->orderBy($orderBy, $orderType)->paginate($limit, $columns);
  }

  /**
   * Create row if value doesn't exist
   * 
   * @param $column
   * @param $value
   * @return Collection
   */
  public function firstOrCreate($column, $value)
  {
    return $this->model->firstOrCreate([$column => $value]);
  }
}
