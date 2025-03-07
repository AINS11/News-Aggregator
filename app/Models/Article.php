<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory; 
    protected $fillable = ['title', 'content', 'image', 'source_url', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'article_user')->withPivot('liked', 'bookmarked');
    }
}
