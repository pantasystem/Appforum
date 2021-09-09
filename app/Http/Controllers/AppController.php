<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;

class AppController extends Controller
{

    public function index() {

        //appsテーブルに対してselect文を実行し、データを取得 id降順
        // $apps = App::get();


        $apps = App::with('user')->get();
        
        //bladeテンプレートを呼び出し、データを渡す
        return view('pages.app.index',['apps'=>$apps]);
    }

    public function show($appId) {

        //該当するアプリの詳細情報を取得
        $app = App::find($appId);

        //bladeにデータを渡してWebページを表示
        return view('pages.app.show',['app'=>$app]);

    }

}
