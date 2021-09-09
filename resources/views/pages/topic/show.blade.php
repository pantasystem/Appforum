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

    <div>
        @foreach($posts as $post)
        <div class="card">
            <div class="card-header">
                {{ $post->username }}
            </div>
            <div class="card-body">
                <x-markdown :text="$post->text"/>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <div>
                        <form action="{{ route('apps.topics.posts.index', ['appId' => $app->id, 'topicId' => $topic->id])}}">
                            <button class="btn btn-link" type="submit">
                                <input type="hidden" name="replyTo" value="{{$post->id}}">
                                <i class="fas fa-reply mr-1"></i>{{ $post->replies_count }}
                            </button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <form action="{{ route('apps.topics.posts.store', ['appId' => $app->id, 'topicId' => $topic->id])}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="card-title">
                    投稿を作成
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">投稿</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <textarea name="text" class="form-control @error('text') is-invalid @enderror">{{old('text')}}</textarea>
                    @error('text')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </form>


    
</div>
@stop
