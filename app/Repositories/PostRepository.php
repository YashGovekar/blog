<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PostRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function model(): string
    {
        return 'App\Models\Post';
    }
}
