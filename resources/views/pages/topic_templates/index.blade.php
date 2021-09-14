@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<nav area-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('apps.index')}}">アプリ一覧</a></li>
        <li class="breadcrumb-item"><a href="{{route('apps.topics.store', ['appId' => $app->id])}}">{{ $app->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            @if($select) 
                トピックテンプレート選択    
            @else 
                トピックテンプレート一覧
            @endif    
        </li>        
    </ol>
</nav>
@stop

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1>
        @if($select) 
        トピックテンプレート選択    
        @else 
        トピックテンプレート一覧
        @endif
        </h1>
    </div>
    <div>
        @if($owner)
        <a class="btn btn-primary" href="{{ route('apps.topic-templates.create', ['appId' => $app->id]) }}">テンプレート作成</a>
        @endif
    </div>
</div>

<div class="card">
    <table class="table">
        <thead>
            <th>ID</th>
            <th>テンプレート名</th>
            <th>アクション</th>
        </thead>
        <tbody>
        @foreach($templates as $template)
        <tr>
            <td>{{$template->id}}</td>
            <td>{{$template->name}}</td>
            <td>
                @if($select)
                <form action="{{ route('apps.topics.create', ['appId' => $app->id ]) }}" method="GET">
                    <button type="submit" class="btn btn-primary">トピック作成</button>
                    <input type="hidden" name="templateId" value="{{$template->id}}">
                </form>
                @endif
                
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop

@section('css')
    {{-- ページごとCSSの指定
    <link rel="stylesheet" href="/css/xxx.css">
    --}}
@stop

@section('js')
    <script> console.log('ページごとJSの記述'); </script>
@stop