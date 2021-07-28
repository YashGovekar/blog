<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Prettus\Repository\Exceptions\RepositoryException;

class HomeController extends Controller
{
    private PostService $postSvc;

    /**
     * HomeController constructor.
     * @param PostService $postSvc
     */
    public function __construct(PostService $postSvc)
    {
        $this->postSvc = $postSvc;
    }

    public function index()
    {
        $posts = $this->postSvc->published();

        return view('index', compact('posts'));
    }
}
