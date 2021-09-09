<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateInputTemplateRequest;


class InputTemplateController extends Controller
{
    public function store($appId, $templateId, CreateInputTemplateRequest $request)
    {
        $user = Auth::user();
        $app = $user->apps()->findOrFail($appId);
        $template = $app->topicTemplates()->findOrFail($templateId);
        $template->inputs()->create(array_merge(
            $request->only('name', 'description', 'type'),
            [
                'is_required' => (boolean)$request->input('is_required')
            ]
        ));
        return redirect()->route('apps.topic-templates.edit', ['appId' => $app->id, 'templateId' => $template->id]);
    }

    public function create($appId, $templateId)
    {
        $user = Auth::user();
        $app = $user->apps()->findOrFail($appId);
        $template = $app->topicTemplates()->findOrFail($templateId);
        
        return view('pages.input_templates.create', compact('app', 'template'));
    }
}
