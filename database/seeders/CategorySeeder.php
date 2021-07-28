<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'World', 'Technology', 'Design', 'Culture', 'Business',
            'Politics', 'Style', 'Science', 'Health', 'Travel',
        ];

        foreach ($categories as $category) {
            Category::query()->create([
                'name' => $category,
            ]);
        }
    }
}
