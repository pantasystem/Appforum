@extends('adminlte::page')

@section('title', 'アプリ・サービス一覧')

@section('content_header')
<div class="d-flex align-items-center justify-content-between">
    <div>
        <h1>アプリ・サービス一覧</h1>
    </div>
    <div>
        <a href="{{ route('apps.create') }}" class="btn btn-primary">アプリ作成</a>
    </div>
</div>
@stop

@section('content')
    <div>
            <div class="row">
                @foreach($apps as $app)
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="card">

                        <img src="{{$app->header_image_url}}" width="100%" height="150">
                        <div class="row position-absolute ml-3" style="top: 100px">
                            <img src="{{$app->icon_url}}" class="bg-white" style="width:80px; height:80px; object-fit:cover;">
                            <h3 class="card-title h4 ml-1 mt-auto">{{$app->name}}</h3>
                        </div>

                        <div class="card-body pt-5">
                            <p class="card-text text-muted mb-1">{{$app->user->username}}</p>
                            <p class="card-text text-muted">{{$app->created_at}}</p>
                            <a href="/apps/{{$app->id}}" class="btn btn-primary">詳しく見る</a>
                        </div>

                    </div>
                </div>
                @endforeach
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