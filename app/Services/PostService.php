<?php

namespace App\Services;

use App\Criteria\PostCriteria;
use App\Enums\PostState;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Prettus\Repository\Exceptions\RepositoryException;

class PostService
{
    private PostRepositoryInterface $postRepo;
    private SummernoteService $summernoteSvc;

    /**
     * PostService constructor.
     * @param PostRepositoryInterface $postRepo
     * @param SummernoteService $summernoteSvc
     */
    public function __construct(
        PostRepositoryInterface $postRepo,
        SummernoteService $summernoteSvc
    ) {
        $this->postRepo = $postRepo;
        $this->summernoteSvc = $summernoteSvc;
    }

    private function processPost(array $data, bool $same_slug = false): array
    {
        if (! $same_slug) {
            try {
                $data['slug'] = generate_slug($data['title']);
            } catch (Exception $e) {
                flash('Something went wrong!')->error();
                Log::error($e->getMessage());

                return [];
            }
        }

        if (! $data['slug']) {
            flash('Please choose a different title.')->error();

            return [];
        }

        $data['content'] = $this->summernoteSvc->processText($data['content']);

        if ($data['state'] == PostState::PUBLISHED) {
            $data['posted_at'] = Carbon::now()->toDateTimeString();
        }

        return $data;
    }

    public function store(array $data): bool
    {
        $data = $this->processPost($data);

        if (! count($data)) {
            return false;
        }

        try {
            $this->postRepo->create([
                'author_id'   => Auth::id(),
                'title'       => $data['title'],
                'slug'        => $data['slug'],
                'category_id' => $data['category_id'],
                'excerpt'     => $data['excerpt'],
                'content'     => $data['content'],
                'state'       => $data['state'],
            ]);

            if ((int) $data['state'] == PostState::PUBLISHED) {
                flash('Blog Posted!')->success();
            } else {
                flash('Blog Saved!')->success();
            }

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            flash('Something went wrong!')->error();

            return false;
        }
    }

    public function update(array $data, $slug): bool
    {
        $post = $this->findBySlug($slug);

        $data = $this->processPost($data, $post->title === $data['title']);

        if (! count($data)) {
            return false;
        }

        try {
            $this->postRepo->update([
                'title'       => $data['title'],
                'slug'        => $data['slug'],
                'category_id' => $data['category_id'],
                'excerpt'     => $data['excerpt'],
                'content'     => $data['content'],
                'state'       => $data['state'],
            ], $post->id);

            if ((int) $data['state'] == PostState::PUBLISHED) {
                flash('Blog Posted!')->success();
            } else {
                flash('Blog Saved!')->success();
            }

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            flash('Something went wrong!')->error();

            return false;
        }
    }

    public function published()
    {
        try {
            return $this->postRepo
                ->pushCriteria(new PostCriteria('state', '=', PostState::PUBLISHED))
                ->orderBy('id', 'DESC')
                ->with('author')
                ->paginate(10);
        } catch (RepositoryException $e) {
            Log::error($e->getMessage());

            return collect();
        }
    }

    public function findBySlug($slug)
    {
        return $this->postRepo
            ->findByField('slug', $slug)
            ->first();
    }

    public function getAuthorPosts(?int $id)
    {
        try {
            return $this->postRepo
                ->pushCriteria(new PostCriteria('author_id', '=', $id))
                ->paginate(10);
        } catch (RepositoryException $e) {
            Log::error($e->getMessage());

            return collect();
        }
    }

    public function delete($id): bool
    {
        try {
            $this->postRepo->delete($id);

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            flash('Something went wrong!')->error();

            return false;
        }
    }
}
