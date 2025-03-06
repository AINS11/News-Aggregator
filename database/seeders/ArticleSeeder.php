<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $techCategory = Category::where('name', 'Technology')->first();

        Article::create([
            'title' => 'Tech Advances in 2024',
            'content' => 'The tech industry is evolving...',
            'image' => asset('storage/images/no-image.png'),
            'source_url' => 'https://example.com/tech',
            'category_id' => $techCategory->id
        ]);
    }
}
