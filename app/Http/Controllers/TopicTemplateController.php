<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TopicTemplate;
use App\Http\Requests\CreateTopicTemplateRequest;
use App\Http\Requests\UpdateTopicTemplateRequest;
use App\Models\App;

class TopicTemplateController extends Controller
{

    public function index(Request $request, $appId) 
    {
        $select = $request->input('action') == 'select';
        $app = App::findOrFail($appId);
        $owner = Auth::check() && $app->user_id == Auth::id();
        $templatesQuery =  $app->topicTemplates();

        // オーナーではない場合は下書きを除外する
        if(!$owner) {
            $templatesQuery = $templatesQuery->where('is_draft', '=', false);
        }
        $templates = $templatesQuery->get();
        return view('pages.topic_templates.index', compact('select', 'app', 'owner', 'templates'));
    }
    
    public function create($appId)
    {
        $user = Auth::user();
        $app = $user->apps()->findOrFail($appId);
        return view('pages.topic_templates.create', compact('app'));
    }

    public function store($appId, CreateTopicTemplateRequest $request)
    {
        $user = Auth::user();
        $app = $user->apps()->findOrFail($appId);
        $topicTemplate = new TopicTemplate(
            array_merge(
                $request->only('name', 'description'),
                ['is_private' => (boolean)$request->input('is_private')]
            )
        );
        $topicTemplate->app()->associate($app);
        $topicTemplate->save();

        return redirect()->route('apps.topic-templates.edit', ['appId' => $app->id, 'templateId' => $topicTemplate->id]);
    }

    public function edit($appId, $templateId) 
    {
        $user = Auth::user();
        $app = $user->apps()->findOrFail($appId);
        $template = $app->topicTemplates()->with('inputs')->findOrFail($templateId);

        return view('pages.topic_templates.edit', compact('app', 'template'));
    }

    public function update($appId, $templateId, UpdateTopicTemplateRequest $request) 
    {
        $user = Auth::user();
        $app = $user->apps()->findOrFail($appId);
        $template = $app->topicTemplates()->findOrFail($templateId);
        $template->fill(
            array_merge(
                $request->only('name', 'description'),
                [
                    'is_draft' => (boolean)$request->input('is_draft'),
                    'is_private' => (boolean)$request->input('is_private'),
                ]
            )
        );
        $template->save();
        
        return redirect()->back();
    }

    public function show($appId, $topicId)
    {

    }

}
