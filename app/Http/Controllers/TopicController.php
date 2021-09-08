<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;
use Illuminate\Support\Facades\Validator;
use App\Models\TopicTemplate;
use App\Models\Topic;
use App\Models\Content;
use DB;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    
    
    public function store($appId, Request $request)
    {
        $templateId = $request->input('templateId');
        $app = App::findOrFail($appId);

        $template = $app->topicTemplates()->with('inputs')->findOrFail($templateId);
        $rules = [
            'title' => ['required', 'max:25']
        ];
        $attributeNames = ['title' => 'タイトル'];
        foreach($template->inputs as $input) {
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
        foreach($template->inputs as $input) {
            $validator->setAttributeNames($attributeNames);
        }
        $validator->validate();

        $topic = DB::transaction(function() use ($request, $app, $template){
            $topic = new Topic($request->only('title'));
            $topic->app()->associate($app);
            if(Auth::check()) {
                $topic->user()->associate(Auth::user());
            }
            $topic->save();

            $contents = $template->inputs->map(function($input) use ($request){
                return new Content([ 
                    'name' => $input->name,
                    'type' => $input->type,
                    'text' => $request->input('input-' . $input->id)
                ]);
            });
            $topic->contents()->saveMany($contents);

            return $topic;
        });

        // TODO: トピック詳細画面(投稿一覧画面)へ遷移する
        return $topic->load('contents');
    }


    public function create($appId, Request $request)
    {
        $app = App::findOrFail($appId);
        $templateId = $request->input('templateId');
        if(!$templateId) {
            return redirect()->route('apps.topic-templates', ['appId' => $appId]);
        }

        $template = $app->topicTemplates()->where('is_draft', false)->with('inputs')->findOrFail($templateId);
        $queryInputs = $request->all();
        return view('pages.topic.create', compact('template', 'app', 'queryInputs'));
    }
}
