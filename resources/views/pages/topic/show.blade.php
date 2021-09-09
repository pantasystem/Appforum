@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <h1>{{ $topic->title }}</h1>
        <!-- TODO breadcrumbを表示する -->
    </div>
@stop

@section('content')
<div class="pb-4">
    <div class="card">
        <div class="card-header">{{$topic->username}}</div>
        <div class="card-body">
            @foreach($topic->contents as $content)
            <div class="card">
                <div class="card-header">
                    {{ $content->name }}
                    @if($content->public)
                    <x-public-badge />
                    @endif
                </div>
                <div class="card-body">
                @if(!($content->public || $app->is_owner || $topic->is_owner ))
                    未公開なフィールドです
                @elseif($content->type == 'singleline')
                    {{$content->text}}
                @elseif($content->type == 'multiline')
                    <x-markdown :text="$content->text"/>
                @else
                    error
                @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div>
        @foreach($posts as $post)
        <x-post-view :post="$post" :app="$app" :topic="$topic"/>
        @endforeach
    </div>

    <x-post-editor-form :topic="$topic"/>

    
</div>
@stop
