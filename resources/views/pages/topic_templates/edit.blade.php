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
                テンプレート名
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
    <div class="topic-templates-input-forms">
        
        <div class="card">
            <div class="card-header">
                <label for="topic-templates-input-0-name">入力名</label>
                <input type="text" class="form-control" id="topic-templates-input-0-name">
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
            
        </div>
    </div>
    <button type="button" class="btn btn-primary topic-templates-add-input">入力を追加する</button>
</div>
@stop

@section('css')
@stop

@section('js')
    <script>
      
    </script>
@stop