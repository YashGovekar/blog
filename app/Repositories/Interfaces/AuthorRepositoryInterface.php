<?php

namespace App\Repositories\Interfaces;

interface AuthorRepositoryInterface
{
    public function create(array $attributes);

    public function find($id);

    public function with($relations);
}
