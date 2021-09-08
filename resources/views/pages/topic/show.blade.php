@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <h1>{{ $topic->title }}</h1>
        <!-- TODO breadcrumbを表示する -->
    </div>
@stop

@section('content')
<div>
    <div class="card">
        <div class="card-header card-title">
            {{ $topic->user_name ?? '匿名ユーザー' }}
        </div>
        <div class="card-body">
        @foreach($topic->contents as $content)
            <h3>{{$content->name}}</h3>
            @if($content->type == 'singleline')
            <p>{{$content->text}}</p>
            @elseif($content->type == 'multiline')
            <p>{{$content->text}}</p>
            @else
            error
            @endif
        @endforeach
        </div>
    </div>
    
</div>
@stop
