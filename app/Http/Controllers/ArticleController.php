<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function ShowNews(Request $request)
    {
        $category = $request->query('category', 'All News'); // Default to "All News"
        $search = $request->query('search'); // Use query() instead of input()

        $query = Article::query();

        // Filter by category if it's not "All News"
        if ($category !== 'All News') {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }

        // Apply search filter if a keyword is entered
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                ->orWhere('content', 'LIKE', "%{$search}%")
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%"); // Search in category name
                });
            });
        }

        // Fetch the filtered articles with pagination
        $news = $query->latest()->paginate(9)->appends([
            'category' => $category,
            'search' => $search
        ]);

        return view('home', compact('news', 'category', 'search'));

    }
}
