@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<nav area-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">アプリ一覧</a></li>
        <li class="breadcrumb-item"><a href="{{route('apps.topic-templates.create', ['appId' => $app->id])}}">{{ $app->name}}</a></li>
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
<h1>
@if($select) 
トピックテンプレート選択    
@else 
トピックテンプレート一覧
@endif
</h1>
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
                <a class="btn btn-primary">選択</a>
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