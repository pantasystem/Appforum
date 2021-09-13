<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use App\Models\App;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    public function store($appId, $topicId, CreatePostRequest $request)
    {
        $app = App::findOrFail($appId);
        $topic = $app->topics()->findOrFail($topicId);
        $post = new Post($request->only('text'));
        if($request->parentId) {
            $parent = $topic->posts()->findOrFail($request->parentId);

            $post->replyTo()->associate($parent);
        }
        if(Auth::check()) {
            $post->user()->associate(Auth::user());
        }
        
        $topic->posts()->save($post);
        return redirect()->back();
    }

    public function index($appId, $topicId, Request $request)
    {
        $app = App::findOrFail($appId);
        $topic = $app->topics()->findOrFail($topicId);
        $replyToId = $request->input('replyTo');
        if(!$replyToId) {
            return redirect()->route('apps.topics.show', ['appId' => $appId, 'topicId' => $topicId]);  
        }

        $replyTo = $topic->posts()->with('user', 'reactions')->withCount('replies')->findOrFail($replyToId);
        $replies = $replyTo->replies()->with('user', 'reactions')->withCount('replies')->get();
        return view('pages.post.index', ['app' => $app, 'topic' => $topic, 'replies' => $replies, 'replyTo' => $replyTo]);
        
    }
}
