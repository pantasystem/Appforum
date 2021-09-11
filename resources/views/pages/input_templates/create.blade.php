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
                <label for="topic-templates-input-0-name">フィールド名</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="topic-templates-input-0-name" name="name" value="{{old('name')}}">
                @error('name')
                <div class='invalid-feedback'>
                    {{$message }}
                </div>  
                @enderror
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="topic-templates-input-0-description">フィールドについての説明</label>
                    <textarea class="form-control" name="description">{{old('description')}}</textarea>

                </div>
                <div class="form-group">
                    <label for="topic-templates-input-type">フィールドタイプ</label>
                    {{ 
                        Form::select(
                            'type', 
                            [
                                'singleline' => '単数行入力', 
                                'multiline' => '複数業入力'
                            ],
                            old('type'),
                            [
                                'class' => 'custom-select',
                                'id' => 'topic-templates-input-type'
                            ]
                        )
                    }}
                    @error('type')
                    <div class='invalid-feedback'>{{$message}}</div>
                    @enderror
                </div>
                <div clsas="form-group">

                    <x-checkbox :value="old('is_required', true)" name="is_required">必須項目</x-checkbox>

                </div>
                <div class="form-group">
                    <x-checkbox :value="old('public', true)" name="public">公開フィールド</x-checkbox>
                </div>
            </div>
            <div class="card-footer text-right">
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