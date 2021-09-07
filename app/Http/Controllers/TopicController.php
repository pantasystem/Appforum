<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;

class TopicController extends Controller
{
    
    
    public function store($appId)
    {

    }


    public function create($appId, Request $request)
    {
        $app = App::findOrFail($appId);
        $templateId = $request->input('templateId');
        if(!$templateId) {
            return redirect()->route('apps.topic-templates', ['appId' => $appId]);
        }

        $template = $app->topicTemplates()->where('is_draft', false)->with('inputs')->findOrFail($templateId);
        return view('pages.topic.create', compact('template'));
    }
}
