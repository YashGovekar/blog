<?php

namespace Database\Factories;

use App\Enums\PostState;
use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->realText(20);

        $excerpt = $this->faker->realText(50);

        $paragraphs = $this->faker->paragraphs(rand(2, 6));

        $content = "<h1>{$title}</h1>";
        foreach ($paragraphs as $para) {
            $content .= "<p>{$para}</p>";
        }

        $category = Category::query()->inRandomOrder()->first();

        $author = Author::query()->inRandomOrder()->first();

        return [
            'author_id'   => $author->id,
            'title'       => $title,
            'slug'        => generate_slug($title),
            'category_id' => $category->id,
            'excerpt'     => $excerpt,
            'content'     => $content,
            'state'       => PostState::PUBLISHED,
        ];
    }
}
