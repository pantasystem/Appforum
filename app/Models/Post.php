<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;
use App\Models\User;
use App\Models\PostReaction;
use App\Models\ReactionCount;


class Post extends Model
{
    use HasFactory;

    protected $fillable = ['text',' parent_id'];

    /**
     * 投稿先トピック
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    /**
     * 投稿者
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 返信先へのリレーション
     */
    public function replyTo()
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    /**
     * この投稿への返信
     */
    public function replies()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function getUsernameAttribute()
    {
        if($this->user) {
            return $this->user->username;
        }
        return '匿名ユーザー';
    }

    public function reactions()
    {
        return $this->hasMany(PostReaction::class, 'post_id');
    }

    public function getReactionCountsAttribute()
    {
        $nameAndStamp = [];
        $nameAndReactions = [];
        foreach($this->reactions as $reaction) {
            $nameAndStamp[$reaction->stamp->name] = $reaction->stamp;
            $reactions = $nameAndReactions[$reaction->stamp->name] ?? [];
            $reactions[] = $reaction;
            $nameAndReactions[$reaction->stamp->name] = $reactions;
        }
        
        $reactionCounts = collect($nameAndReactions)->map(function($reactions, $stampName) use ($nameAndStamp){
            $stamp = $nameAndStamp[$stampName];
            
            return new ReactionCount($stamp, $reactions);
        });

        return $reactionCounts;
    }
}
