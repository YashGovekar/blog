<?php

use App\Models\Post;

if (! function_exists('generate_slug')) {
    function generate_slug($string): ?string
    {
        $slug =  strtolower(
            preg_replace(
                '/[^A-Za-z0-9\-]/',
                '',
                str_replace(' ', '-', $string)
            )
        );

        $createSlugsAll = Post::query()->where('slug', 'like', $slug.'%')->get();

        if (! $createSlugsAll->contains('slug', $slug)){
            return $slug;
        }

        for ($i = 1; $i <= 10; $i++) {
            $makeSlug = $slug.'-'.$i;
            if (! $createSlugsAll->contains('slug', $makeSlug)) {
                return $makeSlug;
            }
        }

        return null;
    }
}
