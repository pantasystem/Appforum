<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;
use App\Models\Stamp;
use App\Models\PostReaction;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    public function store($appId, $topicId, $postId, Request $request)
    {
        $stamp = Stamp::findOrFail($request->stamp_id);
        $app = App::findOrFail($appId);
        $topic = $app->topics()->findOrFail($topicId);
        $post = $topic->posts()->findOrFail($postId);

        if(($reaction = $post->reactions()->where('stamp_id', '=', $stamp->id)->where('user_id', '=', Auth::id())->first()) != null) {
            $reaction->delete();
        }else{
            $reaction = new PostReaction();
            $reaction->post()->associate($post);
            $reaction->stamp()->associate($stamp);
            $reaction->user()->associate(Auth::user());
            $post->reactions()->save($reaction);
        }
        
        $post->load('user', 'reactions')->loadCount('replies');

        return view('components.post-view', compact('post', 'topic', 'app'));

    }
}
