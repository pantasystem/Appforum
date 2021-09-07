<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InputTemplateController extends Controller
{
    public function store()
    {
        echo 'hogehoge';
    }

    public function create($appId, $templateId)
    {
        $user = Auth::user();
        $app = $user->apps()->findOrFail($appId);
        $template = $app->topicTemplates()->findOrFail($templateId);
        
        return view('pages.input_templates.create', compact('app', 'template'));
    }
}
