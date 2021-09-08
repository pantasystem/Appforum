<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;

class AppController extends Controller
{

    public function index() {

        //appsテーブルに対してselect文を実行し、データを取得 id降順
        $apps = App::orderBy('id', 'desc')->get();
        
        //bladeテンプレートを呼び出し、データを渡す
        return view('pages.app.index',['data'=>$apps]);
    }
}
