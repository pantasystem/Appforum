<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TopicTemplate;
use App\Http\Requests\CreateTopicTemplateRequest;
use App\Http\Requests\UpdateTopicTemplateRequest;

class TopicTemplateController extends Controller
{
    
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
        $topicTemplate = new TopicTemplate($request->only('name', 'description'));
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
                    'is_draft' => $request->input('is_draft') != 0,
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
