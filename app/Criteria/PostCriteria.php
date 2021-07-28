<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class PostCriteria implements CriteriaInterface
{
    private string $column;
    private string $value;
    private string $condition;

    /**
     * PostCriteria constructor.
     * @param $column
     * @param $condition
     * @param $value
     */
    public function __construct($column, $condition, $value)
    {
        $this->column = $column;
        $this->condition = $condition;
        $this->value = $value;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where($this->column, $this->condition, $this->value);
    }
}
