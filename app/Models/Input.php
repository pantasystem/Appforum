<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;
use Illuminate\Validation\Rule;

class Input extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'name', 'description', 'is_required', 'public'];

    protected function rules()
    {
        return [
            'type' => [Rule::in(['multiline', 'singleline'])],
            'name' => ['required', 'max:40'],
            'description' => ['nullable', 'max:255'],
            'is_required' => ['required', 'boolean']
        ];
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

}
