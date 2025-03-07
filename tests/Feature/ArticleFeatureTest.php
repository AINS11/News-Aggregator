<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_requires_authentication_to_access_dashboard()
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect('/login');
    }

    /** @test */
    public function it_displays_news_for_authenticated_users()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create(['title' => 'Breaking News']);

        $this->actingAs($user, 'web')
             ->withoutMiddleware()
             ->get(route('dashboard'))
             ->assertStatus(200)
             ->assertSee('Breaking News');
    }
}

