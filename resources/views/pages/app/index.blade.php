@extends('adminlte::page')

@section('title', 'アプリ・サービス一覧')

@section('content_header')
    <h1>アプリ・サービス一覧</h1>
@stop

@section('content')
    <div>


        <div class="container-fluid">
            <div class="row">
                @foreach($data as $app)
                <div class="col-sm-6 col-xl-4">
                    <div class="m-3 p-3 bg-secondary rounded-lg">
                        <img src="{{$app->icon_path}}" width="100px">
                        <p class="h2">{{$app->name}}</p>
                        <p>作成者ID : {{$app->user_id}}</p>
                        <p>作成日 : {{$app->created_at}}</p>
                    </div>
                </div>
                @endforeach
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