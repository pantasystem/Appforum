<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TopicTemplate;
use App\Models\Topic;
use App\Models\User;
use App\Models\Label;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class App extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'header_image_path', 'icon_path'];

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
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

    public function getIsOwnerAttribute()
    {
        return Auth::id() == $this->user_id;
    }

    public function getHeaderImageUrlAttribute()
    {
        if(Storage::disk('public')->exists($this->header_image_path)){
            return Config::get('apps.url') . Storage::url($this->header_image_path);
        }
        return Config::get('apps.url') . $this->header_image_path;
    }

    public function getIconUrlAttribute()
    {
        if(Storage::disk('public')->exists($this->icon_path)){
            return Config::get('apps.url') . Storage::url($this->icon_path);
        }
        return Config::get('apps.url') . $this->icon_path;
    }   
}
