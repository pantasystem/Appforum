<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\App;
use App\Models\Input;

class TopicTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'is_draft'];
    protected $casts = ['is_draft' => 'boolean'];

    protected function rules()
    {
        return [
            'name' => ['required', 'max:25'],
            'description' => ['nullable', 'max:255'],
        ];
    }

    public function inputs()
    {
        return $this->hasMany(Input::class, 'topic_template_id');
    }

    public function app()
    {
        return $this->belongsTo(App::class, 'app_id');
    }
}
