<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_user_is_created()
    {
        $user = \App\Models\User::factory()->create();

        $this->assertDatabaseHas('users', ['email' => $user->email]); // Ensure user is in DB
    }
    
    /** @test */
    public function it_creates_an_article()
    {
        // Create an article
        $article = Article::factory()->create([
            'title' => 'Test Article',
        ]);

        // Verify it exists in the database
        $this->assertDatabaseHas('articles', ['title' => 'Test Article']);
    }
}
