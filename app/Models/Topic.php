<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Content;
use App\Models\App;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\TopicReaction;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function app() 
    {   
        return $this->belongsTo(App::class, 'app_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'topic_id');
    }

    public function contents()
    {
        return $this->hasMany(Content::class, 'topic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getUsernameAttribute() 
    {
        if($this->user == null) {
            return '匿名ユーザー';
        }
        return $this->user->username;
    }

    public function getIsOwnAttribute()
    {
        return Auth::id() == $this->user_id;
    }

    public function reactions()
    {
        return $this->hasMany(TopicReaction::class, 'topic_id');
    }
    
}
