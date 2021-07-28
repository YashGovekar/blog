<?php

namespace App\Repositories;

use App\Repositories\Interfaces\AuthorRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface
{
    public function model(): string
    {
        return 'App\Models\Author';
    }
}
