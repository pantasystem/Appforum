@extends('adminlte::page')

@section('title', 'アプリ・サービス一覧')

@section('content_header')
    <h1>トピック一覧</h1>
@stop

@section('content')
    <div>


        <div class="container-fluid">
            <div class="row">
                @foreach($data as $topics)
                <div class="col-sm-12">
                    <div class="m-4 p-4 bg-secondary rounded-lg">
                        <p class="h2">{{$topics->title}}</p>
                        <p>作成者ID : {{$topics->user_id}}</p>
                        <p>作成日 : {{$topics->created_at}}</p>
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