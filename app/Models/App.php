<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TopicTemplate;
use App\Models\Topic;
use App\Models\User;
use App\Models\Label;

class App extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'header_image_path', 'icon_path'];

    public function user() 
    {
        return $this->belongsTo(App::class, 'user_id');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class, 'app_id');
    }

    public function topicTemplates()
    {
        return $this->hasMany(TopicTemplate::class, 'app_id');
    }

    public function labels()
    {
        return $this->hasMany(Label::class, 'app_id');
    }
}
