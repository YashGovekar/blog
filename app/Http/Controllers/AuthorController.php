<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private AuthorService $authorSvc;

    /**
     * AuthorController constructor.
     * @param AuthorService $authorSvc
     */
    public function __construct(AuthorService $authorSvc)
    {
        $this->authorSvc = $authorSvc;
    }

    public function show($id)
    {
        $author = $this->authorSvc->find($id);
        $posts = $author->posts()->paginate(7);

        return view('authors.show', compact('author', 'posts'));
    }
}
