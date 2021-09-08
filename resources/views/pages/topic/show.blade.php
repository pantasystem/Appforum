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
                </div>
                <div class="card-body">
                @if($content->type == 'singleline')
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

    @foreach($posts as $post)
    <div class="card">
        <div class="card-header">
            {{ $post->username }}
        </div>
        <div class="card-body">
            <x-markdown :text="$post->text"/>
        </div>
    </div>
    @endforeach

            

    
</div>
@stop
