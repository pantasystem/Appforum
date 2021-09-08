@extends('adminlte::page')

@section('title', 'アプリ・サービス一覧')

@section('content')
<h1>
トピック一覧
</h1>
<div class="card">
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Topicタイトル</th>
            <th>作成者名</th>
            <th>作成日</th>
            <th>アクション</th>
        </thead>
        <tbody>
        @foreach($data as $topics)
        <tr>
            <td>{{$topics->id}}</td>
            <td>{{$topics->title}}</td>
            <td>{{$topics->user->username}}</td>
            <td>{{$topics->created_at}}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('apps.topics.show', ['appId' => $topics->app_id, 'topicId' => $topics->id]) }}">選択</a>      
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