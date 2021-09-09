<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Post;
use App\Models\Topic;

class PostEditorForm extends Component
{

    public $replyTo;
    public $post;
    public $text;
    public $parentId;
    public $action;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Topic $topic, ?Post $post = null, ?Post $replyTo = null)
    {
        $this->replyTo = $replyTo;
        $this->post = $post;

        if($replyTo) {
            $this->parentId = $replyTo->id;
        }
        if($post) {
            $this->text = $post->text;
            $action = route('apps.topics.posts.store', ['appId' => $topic->app_id, 'topicId' => $topic->id, 'parentId' => $this->parentId]);
        }else{
            $action = route('apps.topics.posts.store', ['appId' => $topic->app_id, 'topicId' => $topic->id, 'parentId' => $this->parentId]);

        }
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-editor-form');
    }
}
