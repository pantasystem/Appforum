@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>スレッド一覧</h1>
@stop

@section('content')
<div>
    <x-post-view :post="$replyTo" :topic="$topic" :app="$app"/>
    <div class="pl-5">
        @foreach($replies as $reply)
            <x-post-view :post="$reply" :topic="$topic" :app="$app" />
        @endforeach
        <x-post-editor-form :replyTo="$replyTo" :topic="$topic"/>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
    <script> console.log('ページごとJSの記述'); </script>
@stop