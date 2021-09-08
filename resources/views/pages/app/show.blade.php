@extends('adminlte::page')

@section('title', 'アプリ・サービス詳細')

@section('content_header')
    <!-- nothing -->
@stop

@section('content')
    <div>

        <img src="{{$app->header_image_path}}" class="position-relative w-100" style="height: 300px;">

        <div class="row position-absolute" style="top: 270px;">
            <img src="/assets/app_icon_skyblue.png" class="img-rounded ml-4" width="200" height="200">
            <p class="h1 mt-auto ml-3">{{$app->name}}</p>
        </div>

        

        <div class="border border-secondary" style="margin-top: 90px">
            <p class="h3">アプリ詳細</p>
            <p>アプリID : {{$app->id}}</p>
            <p>作成者 : {{$app->user_id}}</p>
            <p>作成日 : {{$app->created_at}}</p>
            <p>更新日: {{$app->updated_at}}</p>
            <p>{{$app->text}}</p>
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