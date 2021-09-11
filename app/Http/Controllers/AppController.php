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
        $apps = App::orderBy('id', 'desc')->get();
        
        //bladeテンプレートを呼び出し、データを渡す
        return view('pages.app.index',['apps'=>$apps]);
    }

    public function store($user, Request $request)
    {
        $userId = Auth::id();
        $user = Auth::id();

        $rules = [
            'name' => ['required', 'max:25'],
            'text' => ['nullable', 'max:255']
        ];
        $attributeNames = ['name' => 'タイトル'];
        foreach($request->inputs as $input) {
            $key = 'input-' . $input->id;
            $rule = [];
            if($input->is_required) {
                $rule[] = 'required';
            }else{
                $rule[] = 'nullable';
            }
            if($input->type == 'singleline') {
                $rule[] = 'max:255';
            }
            $attributeNames[$key] = $input->name;
            $rules[$key] = $rule;
        }
        $validator = Validator::make($request->all(), $rules);
        foreach($request->inputs as $input) {
            $validator->setAttributeNames($attributeNames);
        }
        $validator->validate();

        $app = DB::transaction(function() use ($request, $user){
            $app = new App($request->only('name'));
            //$topic->app()->associate($app);
            if(Auth::check()) {
                $app->user()->associate(Auth::user());
            }
            $app->save();

            $filename=$request->store('public');       //storageフォルダに投稿した画像を保存しファイルパスを格納
            $picture->image=str_replace('public/','',$filename);        //ファイル名から「public/」を取り除く
            $picture->save();

            $contents = $request->inputs->map(function($input) use ($request){
                return new Content([ 
                    'name' => $input->name,
                    'type' => $input->type,
                    'text' => $request->input('input-' . $input->id)
                ]);
            });
            $app->contents()->saveMany($contents);

            return $app;
        });

        // TODO: App詳細画面(投稿一覧画面)へ遷移する
        return redirect()->route('apps.show', ['appId' => $appId, 'userId' => $user->id]);
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
