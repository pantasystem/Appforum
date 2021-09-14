<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;
use App\Models\User;
use App\Models\Stamp;


class TopicReaction extends Model
{
    use HasFactory;

    protected $fillable = ['topic_id', 'stamp_id', 'user_id'];

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
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
