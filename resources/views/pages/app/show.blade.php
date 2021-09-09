@extends('adminlte::page')

@section('title', 'アプリ・サービス詳細')

@section('content_header')
<x-app-header :app="$app"/>
@stop

@section('content')
    <div>

    
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top: 100px;">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">アプリ詳細</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="/apps/{{$app->id}}/topics/" class="nav-link" id="profile-tab" data-bs-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">トピック一覧</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active bg-white p-3" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p>アプリID : {{$app->id}}</p>
                <p>作成者 : {{$app->user_id}}</p>
                <p>作成日 : {{$app->created_at}}</p>
                <p>更新日: {{$app->updated_at}}</p>
                <p><x-markdown :text="$app->text"/></p>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                Lorem ipsum dolor sit amet.
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