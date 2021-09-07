@extends('adminlte::page')

@section('title', '入力フォーム作成')

@section('content_header')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">アプリ一覧</a></li>
    <li class="breadcrumb-item"><a href="{{route('apps.topic-templates.create', ['appId' => $app->id])}}">{{ $app->name}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('apps.topic-templates.index', ['appId' => $app->id ])}}">トピックテンプレート一覧</a></li>
    <li class="breadcrumb-item"><a href="{{route('apps.topic-templates.edit', ['appId' => $app->id, 'templateId' => $template->id])}}">{{ $template->name }}編集</a></li>
    <li class="breadcrumb-item active" aria-current="page">入力フォーム作成</li>
  </ol>
</nav>
@stop

@section('content')
<div class="topic-templates-input-forms">
    <form action="{{ route('apps.topic-templates.inputs.store', ['appId' => $app->id, 'templateId' => $template->id])}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <label for="topic-templates-input-0-name">入力名</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="topic-templates-input-0-name">
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="topic-templates-input-0-description">入力についての説明</label>
                    <textarea class="form-control"></textarea>

                </div>
                <div class="form-group">
                    <label for="topic-templates-input-0-type">入力タイプ</label>
                    <select class="custom-select">
                        <option value="singleline">単数行入力</option>
                        <option value="multiline">複数行入力</option>
                    </select>
                </div>
                <div clsas="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Default checkbox
                        </label>
                            
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </div>
    </form>
    
</div>
@stop

@section('css')
@stop

@section('js')
    <script>
      
    </script>
@stop