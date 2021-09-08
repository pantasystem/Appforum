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
    function index( App $app_id ){
        //投稿一覧画面の表示

        //appsテーブルに対してselect文を実行し、データを取得 id降順
        $topics = Topic::where('app_id',$app_id)->orderBy('id', 'desc') -> get();

        return view('topic', ['data' => $topics]);
    }
}
