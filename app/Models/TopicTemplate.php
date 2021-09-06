<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\App;
use App\Models\Input;

class TopicTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function inputs()
    {
        return $this->hasMany(Input::class, 'topic_template_id');
    }

    public function app()
    {
        return $this->belongsTo(App::class, 'app_id');
    }
}
