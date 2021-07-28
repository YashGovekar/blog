<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private PostService $postSvc;

    /**
     * ProfileController constructor.
     * @param PostService $postSvc
     */
    public function __construct(PostService $postSvc)
    {
        $this->postSvc = $postSvc;
    }

    public function posts()
    {
        $posts = $this->postSvc->getAuthorPosts(Auth::id());

        return view('profile.posts', compact('posts'));
    }
}
