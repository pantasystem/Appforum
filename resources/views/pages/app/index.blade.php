@extends('adminlte::page')

@section('title', 'アプリ・サービス一覧')

@section('content_header')
    <h1>アプリ・サービス一覧</h1>
@stop

@section('content')
    <div>


        <div class="container-fluid">
            <div class="row">
                @foreach($data as $record)
                <div class="col-sm-6 col-lg-4">
                    <div style="background-color: #ccc; margin: 15px; padding: 15px; border-radius: 10px;">
                        <h3>{{$record->name}}</h3>
                        <p>アプリID {{$record->id}}</p>
                        <p>作成者ID {{$record->user_id}}</p>
                        <p>作成日 {{$record->created_at}}</p>

                        <img src="{{$record->icon_path}}" width="100px">
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