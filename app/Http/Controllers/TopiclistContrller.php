<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Content;
use App\Models\Topic;
use App\Models\App;
use Illuminate\Support\Facades\Auth;

class TopiclistContrller extends Controller
{
    function index( App $app ){
        //投稿一覧画面の表示

        //topicsテーブルに対してselect文を実行し、データを取得 id昇順
        $topics = Topic::where('app_id',$app->id)->orderBy('id', 'asc') -> get();

        return view('topic', ['data' => $topics]);
    }
}
