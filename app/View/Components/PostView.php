<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Post;
use App\Models\Topic;
use App\Models\App;


class PostView extends Component
{

    public $post;
    public $app;
    public $topic;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Post $post, App $app, Topic $topic)
    {
        $this->post = $post;
        $this->app = $app;
        $this->topic = $topic;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-view');
    }
}
