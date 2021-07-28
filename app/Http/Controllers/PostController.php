<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private CategoryRepositoryInterface $categoryRepo;
    private PostService $postSvc;

    /**
     * PostController constructor.
     * @param CategoryRepositoryInterface $categoryRepo
     * @param PostService $postSvc
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepo,
        PostService $postSvc
    ) {
        $this->categoryRepo = $categoryRepo;
        $this->postSvc = $postSvc;
    }

    public function show($slug)
    {
        $post = $this->postSvc->findBySlug($slug);

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $categories = $this->categoryRepo->all();

        return view('posts.create', [
            'categories' => $categories,
        ]);
    }

    public function edit($slug)
    {
        $categories = $this->categoryRepo->all();
        $post = $this->postSvc->findBySlug($slug);

        if ($post->author_id !== Auth::id()) {
            return back();
        }

        return view('posts.edit', [
            'categories' => $categories,
            'post'       => $post,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|min:3',
            'content'     => 'required',
            'excerpt'     => 'required|max:250',
            'category_id' => 'required',
        ]);

        $data = $request->except('_token');

        $post = $this->postSvc->store($data);

        if (! $post) {
            return back()->withInput($data);
        }

        return redirect(route('profile.posts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|min:3',
            'content'     => 'required',
            'excerpt'     => 'required|max:250',
            'category_id' => 'required',
        ]);

        $update = $this->postSvc->update($request->except('_token'), $id);

        if (! $update) {
            return back()->withInput($request->except('_token'));
        }

        return redirect(route('profile.posts'));
    }

    public function destroy($id)
    {
        $this->postSvc->delete($id);

        return redirect(route('profile.posts'));
    }
}
