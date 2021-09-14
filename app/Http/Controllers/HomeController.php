<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\App;
use App\Models\Topic;
use App\Models\Post;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $appIds = Auth::user()->apps()->get('id')->pluck('id');
        $topics = Topic::whereIn('app_id', $appIds)->with('user', 'app')->orderBy('created_at', 'desc')->get();
        $topicIds = $topics->pluck('id');
        $posts = Post::whereIn('topic_id', $topicIds)->with('topic.app', 'user')->orderBy('created_at', 'desc')->limit(20)->get();
        $topics = $topics->take(20);
        return view('home', compact('posts', 'topics'));
    }


}
