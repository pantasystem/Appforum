@extends('adminlte::page')

@section('title', 'アプリ・サービス一覧')


@section('content')
<div>
<x-app-detail :app="$app">
<ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top: 100px;">
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="{{ route('apps.show', ['app' => $app])}}" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">アプリ詳細</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{route('apps.topic.index', ['app' => $app])}}" class="nav-link  active" id="profile-tab" data-bs-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">トピック一覧</a>
            </li>
        </ul>
<div>
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
                <td>{{$topics->username}}</td>
                <td>{{$topics->created_at}}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('apps.topics.show', ['appId' => $topics->app_id, 'topicId' => $topics->id]) }}">選択</a>      
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-app-detail>
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