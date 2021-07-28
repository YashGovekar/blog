<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

interface PostRepositoryInterface
{
    /**
     * Save a new post in repository
     *
     * @param array $attributes
     *
     * @return mixed
     * @throws ValidatorException
     *
     */
    public function create(array $attributes);

    /**
     * Update a post in repository by id
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     * @throws ValidatorException
     *
     */
    public function update(array $attributes, $id);

    /**
     * Delete a post in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id);

    /**
     * Find data by field and value
     *
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findByField($field, $value = null, array $columns = ['*']);

    /**
     * Retrieve all data of repository, paginated
     *
     * @param int|null $limit
     * @param array $columns
     * @param string $method
     *
     * @return mixed
     */
    public function paginate(int $limit = null, array $columns = ['*'], string $method = "paginate");

    /**
     * Push Criteria for filter the query
     *
     * @param $criteria
     *
     * @return $this
     * @throws RepositoryException
     */
    public function pushCriteria($criteria);

    /**
     * Retrieve all data of repository
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function all(array $columns = ['*']);

    /**
     * Set the "orderBy" value of the query.
     *
     * @param mixed $column
     * @param string $direction
     *
     * @return $this
     */
    public function orderBy($column, string $direction);

    /**
     * Load relations
     *
     * @param array|string $relations
     *
     * @return $this
     */
    public function with($relations);
}
