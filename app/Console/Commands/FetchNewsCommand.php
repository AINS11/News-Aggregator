<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch news articles from an external API and store them in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $this->fetchNewsAPI();
        $this->fetchNewsSportAPI();
        $this->fetchGuardianAPI();
        $this->fetchMediaStackAPI();

    }  
    private function fetchNewsAPI()
    {
        $apiUrl = 'https://newsapi.org/v2/top-headlines';
        $apiKey = env('NEWSAPI','18e7347639f34608a0ef43b2b1ff81d6');
        $response = Http::get($apiUrl, [
            'country' => 'us',
            'category' => 'technology',
            'apiKey' => $apiKey
        ]);

        if ($response->successful()) {
            $articles = $response->json()['articles'];

            foreach ($articles as $articleData) {
                // Find or create category
                $category = Category::firstOrCreate(['name' => 'Technology']);

                // Prevent duplicate entries
                if (!Article::where('title', $articleData['title'])->exists()) {
                    Article::create([
                        'title' => $articleData['title'],
                        'content' => $articleData['description'] ?? 'No content available',
                        'image' => $articleData['urlToImage'] ?? null,
                        'source_url' => $articleData['url'] ?? null,
                        'category_id' => $category->id
                    ]);

                    $this->info("Article saved: " . $articleData['title']);
                } else {
                    $this->info("Skipping duplicate: " . $articleData['title']);
                }
            }
        } else {
            $this->error('Failed to fetch news. Check API key and endpoint.');
        }
    }
    private function fetchNewsSportAPI()
    {
        $apiUrl = 'https://newsapi.org/v2/top-headlines';
        $apiKey = env('NEWSAPI','18e7347639f34608a0ef43b2b1ff81d6');
        $response = Http::get($apiUrl, [
            'country' => 'us',
            'category' => 'sports',
            'apiKey' => $apiKey
        ]);

        if ($response->successful()) {
            $articles = $response->json()['articles'];

            foreach ($articles as $articleData) {
                // Find or create category
                $category = Category::firstOrCreate(['name' => 'Sports']);

                // Prevent duplicate entries
                if (!Article::where('title', $articleData['title'])->exists()) {
                    Article::create([
                        'title' => $articleData['title'],
                        'content' => $articleData['description'] ?? 'No content available',
                        'image' => $articleData['urlToImage'] ?? null,
                        'source_url' => $articleData['url'] ?? null,
                        'category_id' => $category->id
                    ]);

                    $this->info("Article saved: " . $articleData['title']);
                } else {
                    $this->info("Skipping duplicate: " . $articleData['title']);
                }
            }
        } else {
            $this->error('Failed to fetch news. Check API key and endpoint.');
        }
    }
    private function fetchGuardianAPI()
    {
        $apiUrl = 'https://content.guardianapis.com/search';
        $apiKey = env('GUARDIANAPI', '6b253945-e6cb-4ac6-8caa-b9e28c02362b');

        $response = Http::get($apiUrl, [
            'q'=>'health',
            'api-key' => $apiKey,
        ]);

        if ($response->successful()) {
            $articles = $response->json()['response']['results'];

            // Format articles to match our structure
            $formattedArticles = array_map(function ($article) {
                return [
                    'title' => $article['webTitle'],
                    'content' => 'No content available', 
                    'image' => $article['fields']['thumbnail'] ?? asset('storage/images/no-image.png'),
                    'source_url' => $article['webUrl'],
                    'category' => $article['sectionName'] ?? 'Uncategorized',
                    'source' => 'The Guardian'
                ];
            }, $articles);

            $this->storeArticles($formattedArticles, 'Health');
        } else {
            $this->error('Failed to fetch news from The Guardian.');
        }
    }

    private function fetchMediastackAPI()
    {
        $apiUrl = 'http://api.mediastack.com/v1/news';
        $apiKey = env('MEDIASTACKAPI', '2ea25acb71d57e4f09ed376aefedc47c');

        $response = Http::get($apiUrl, [
            'access_key' => $apiKey,
            'keywords' => 'politics',
            'languages' => 'en',
            'countries' => 'us,in',
            'limit' =>100
        ]);

        if ($response->successful()) {
            $articles = $response->json()['data'];

            // Format articles to match our structure
            $formattedArticles = array_map(function ($article) {
                return [
                    'title' => $article['title'],
                    'content' => $article['description'] ?? 'No content available',
                    'image' => $article['image'] ?? asset('storage/images/no-image.png'),
                    'source_url' => $article['url'],
                    'category' => ucfirst($article['category']) ?? 'Uncategorized',
                    'source' => ucfirst($article['source']) ?? 'Mediastack'
                ];
            }, $articles);

            $this->storeArticles($formattedArticles, 'Politics');
        } else {
            $this->error('Failed to fetch news from Mediastack.');
        }
    }

    /**
     * Store articles in the database
     */
    private function storeArticles(array $articles, string $source)
    {
        foreach ($articles as $articleData) {
            // Find or create category
            $category = Category::firstOrCreate(['name' => $source]);

            // Prevent duplicate entries
            if (!Article::where('title', $articleData['title'])->exists()) {
                Article::create([
                    'title' => $articleData['title'],
                    'content' => $articleData['content'] ?? 'No content available',
                    'image' => $articleData['image'] ?? asset('storage/images/no-image.png'),
                    'source_url' => $articleData['source_url'] ?? null,
                    'category_id' => $category->id
                ]);
                $this->info("Article saved from {$source}: " . $articleData['title']);
            } else {
                $this->info("Skipping duplicate from {$source}: " . $articleData['title']);
            }
        }
    }

}
