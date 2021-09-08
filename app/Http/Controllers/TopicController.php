<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;
use Illuminate\Support\Facades\Validator;
use App\Models\TopicTemplate;

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
            $rules[$key] = $rule;
        }
        Validator::make($request->all(), $rules)->validate();

    }


    public function create($appId, Request $request)
    {
        $app = App::findOrFail($appId);
        $templateId = $request->input('templateId');
        if(!$templateId) {
            return redirect()->route('apps.topic-templates', ['appId' => $appId]);
        }

        $template = $app->topicTemplates()->where('is_draft', false)->with('inputs')->findOrFail($templateId);
        return view('pages.topic.create', compact('template', 'app'));
    }
}
