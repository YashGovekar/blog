<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    /**
     * Retrieve all data of repository
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function all(array $columns = ['*']);
}
