<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    // Eager loading otomatis untuk category dan author
    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                         ->orWhere('body', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function($query, $category) {
            return $query->whereHas('category', function($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['author'] ?? false, fn($query, $author) =>
             $query->whereHas('author', fn($query) => 
                $query->where('username', $author)
            )
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke User sebagai Author
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke User (Alias untuk menghindari error 'undefined relationship user')
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
{
    return $this->hasMany(Like::class);
}

public function isLikedBy($user)
{
    return $this->likes()->where('user_id', $user->id)->exists();
}
}