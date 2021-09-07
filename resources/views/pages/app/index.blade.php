@extends('adminlte::page')

@section('title', 'アプリ・サービス一覧')

@section('content_header')
    <h1>アプリ・サービス一覧</h1>
@stop

@section('content')
    <div>

        @foreach($data as $record)
        <div style="box-sizing: border-box; background-color: #ccc; padding: 15px; margin: 20px; border-radius: 10px;">
            <h3>{{$record->name}}</h3>
            <p>アプリID {{$record->id}}</p>
            <p>作成者ID {{$record->user_id}}</p>
            <p>作成日 {{$record->created_at}}</p>
        </div>
        @endforeach

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