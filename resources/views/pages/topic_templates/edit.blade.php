@extends('adminlte::page')

@section('title', 'テンプレート編集')

@section('content_header')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">アプリ一覧</a></li>
    <li class="breadcrumb-item"><a href="{{route('apps.topic-templates.create', ['appId' => $app->id])}}">{{ $app->name}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('apps.topic-templates.index', ['appId' => $app->id ])}}">トピックテンプレート一覧</a></li>
    <li class="breadcrumb-item active" aria-current="page">トピックテンプレート作成</li>
  </ol>
</nav>
@stop

@section('content')
<div clsas="topic-templates.edit.form">
    <form method="POST" action="{{ route('apps.topic-templates.update', ['appId' => $app->id, 'templateId' => $template->id])}}">
        @method('put')
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                    テンプレート名
                    </div>
                    <div>
                        <a class="btn btn-primary" href="{{ route('apps.topic-templates.inputs.create', ['appId' => $app->id, 'templateId' => $template->id])}}">入力を追加する</a>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="topic-template-name">テンプレート名</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="topic-template-name" value="{{old('name', $template->name)}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>  
                    @enderror
                </div>
                <div class="form-group">
                    <label for="topic-template-description">テンプレートの説明</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="topic-template-description">{{old('description', $template->description)}}</textarea>
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>  
                    @enderror
                </div>
                <!-- 下書きの保存状態 -->
                <input  value="{{(string)$template->is_draft}}" name="is_draft" class="@error('is_draft') is-invalid @enderror">
                @error('is_draft')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>  
                    @enderror
                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
            
        </div>
    </form>
    <div>
    <h2 class="mt-2">
        入力一覧
    </h2>
    @foreach($template->inputs as $input)
        
        <div class="card">
            <div class="card-header">
                {{$input->name}}
            </div>
            <div class="card-body">

            </div>
        </div>
        {{$input}}
    @endforeach
    </div>
    
</div>
@stop

@section('css')
@stop

@section('js')
    <script>
      
    </script>
@stop