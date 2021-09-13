<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;
use App\Models\Stamp;

class PostReaction extends Model
{
    use HasFactory;

    protected $fillable = ['stamp_id', 'post_id', 'user_id'];

    protected $with = ['stamp'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function stamp()
    {
        return $this->belongsTo(Stamp::class, 'stamp_id');
    }

}
