@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ホーム</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    最近作成されたトピック
                </div>
                <div class="card-body p-0">
                    @if($topics->count() == 0)
                    表示するものは何もありません
                    @else
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>トピック名</th>
                            <th>アプリ名</th>
                            <th>作成者</th>
                            <th>作成日時</th>
                        </thread>
                        <tbody>
                            @foreach($topics as $topic)
                            <tr>
                                <td><a href="{{route('apps.topics.show', ['appId' => $topic->app->id, 'topicId' => $topic->id])}}">{{$topic->id}}</a></td>
                                <td>{{$topic->title}}</td>
                                <td>{{$topic->app->name}}</td>
                                <td>{{$topic->username}}</td>
                                <td>{{$topic->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">最近投稿があったトピック</div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>トピック</th>
                            <th>アプリ</th>
                            <th>投稿作成者</th>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td><a href="{{ route('apps.topics.posts.index',['appId' => $post->topic->app_id, 'topicId' => $post->topic_id, 'replyTo' => $post->id]) }}">{{$post->id}}</a></td>
                                <td>{{$post->topic->title}}</td>
                                <td>{{$post->topic->app->name}}</td>
                                <td>{{$post->username}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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