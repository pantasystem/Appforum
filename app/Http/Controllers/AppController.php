<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;
use App\Models\Content;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Modeles\User;

class AppController extends Controller
{

    public function index() {

        //appsテーブルに対してselect文を実行し、データを取得 id降順
        // $apps = App::get();


        $apps = App::with('user')->get();
        
        //bladeテンプレートを呼び出し、データを渡す
        return view('pages.app.index',['apps'=>$apps]);
    }

    public function store(Request $request)
    {
    
        $rules = [
            'name' => ['required', 'max:25'],
            'text' => ['nullable', 'max:3000'],
            'icon-path' => ['required', 'image'],
            'header_image_path' => ['required', 'image']
        ];
        $validated = $request->validate(
            $rules
        ); 

        $app = new App($request->only('name'));
            
        $app->user()->associate(Auth::user());

        $icon_path = $request->file('icon-path')->store('icons');
 
        $header_image_path = $request->file('header_image_path')->store('headers');

        $app->$icon_path;
        $app->$header_image_path;

        $app->save();

        // TODO: App詳細画面(投稿一覧画面)へ遷移する
        return redirect()->route('apps.show', ['appId' => $appId]);
    }

    public function create()
    {
        $user = Auth::user();
        return view('pages.app.create', compact('user'));
    }
    
    public function show($appId) {

        //該当するアプリの詳細情報を取得
        $app = App::find($appId);

        //bladeにデータを渡してWebページを表示
        return view('pages.app.show',['app'=>$app]);

    }

}
