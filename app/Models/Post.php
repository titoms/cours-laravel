<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'description', 'image', 'likes_count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get all users that liked this post
     */
    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'post_likes', 'post_id', 'user_id')->withTimestamps();
    }
    
    /**
     * Toggle like status for a user
     */
    public function toggleLike(User $user)
    {
        $isLiked = $this->likedBy()->where('user_id', $user->id)->exists();
        
        if ($isLiked) {
            // Unlike
            $this->likedBy()->detach($user->id);
            $this->decrement('likes_count');
        } else {
            // Like
            $this->likedBy()->attach($user->id);
            $this->increment('likes_count');
        }
        
        return !$isLiked; // Return the new state (true = liked, false = unliked)
    }
}
