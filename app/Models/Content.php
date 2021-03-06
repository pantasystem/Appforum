<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Models\Topic;


class Content extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'text', 'name', 'public'];
    protected function rules()
    {
        return [
            'type' => ['required', Rule::in(['multiline', 'singleline'])],
            'text' => ['required'],
            'name' => ['required'],
        ];
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

}
