@extends('adminlte::page')

@section('title', 'アプリ・サービス詳細')

@section('content_header')
    <h1>{{$app->name}}</h1>
@stop

@section('content')
    <div>

        <p class="h2"></p>
        <img src="{{$app->icon_path}}" width="200px">
        <p>アプリID : {{$app->id}}</p>
        <p>作成者 : {{$app->user_id}}</p>
        <p>作成日 : {{$app->created_at}}</p>
        <p>更新日: {{$app->updated_at}}</p>
        <p>{{$app->text}}</p>

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