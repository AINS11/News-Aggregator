<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function ShowNews(Request $request)
    {
        
        // Validate Input to prevent malicious data
        $validated = $request->validate([
            'category' => 'nullable|string|max:255',
            'search' => 'nullable|string|max:255'
        ]);

        $userId = Auth::user()->id;
        $user=User::find($userId);

        $category = $validated['category'] ?? 'All News'; // Default to "All News"
        $search = $validated['search'] ?? null;

        $query = Article::query();

        // Filter by category safely
        if ($category !== 'All News') {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }

        // Apply search safely
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('content', 'LIKE', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        // Paginate with input appended
        $news = $query->latest()->paginate(9)->appends([
            'category' => $category,
            'search' => $search
        ]);
        return view('home', compact('news', 'category', 'search'));
    }
}
