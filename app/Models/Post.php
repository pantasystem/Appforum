<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;
use App\Models\User;


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
}
