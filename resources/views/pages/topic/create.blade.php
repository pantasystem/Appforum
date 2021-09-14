@extends('adminlte::page')

@section('title', 'トピック作成')

@section('content_header')
    <nav area-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('apps.index')}}">アプリ一覧</a></li>
            <li class="breadcrumb-item"><a href="{{route('apps.topics.store', ['appId' => $app->id])}}">{{ $app->name}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('apps.topic-templates.index', ['appId' => $app->id])}}">トピックテンプレート選択</a></li>
            <li class="breadcrumb-item active" aria-current="page">トピック作成</li>        
        </ol>
    </nav>
    <h1>トピック作成</h1>
@stop

@section('content')
<div>
    <form action="{{ route('apps.topics.store', ['appId' => $app->id ]) }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header"><span class="mr-1">トピックタイトル</span><x-required-badge /></div>
            <div class="card-body">
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title', $queryInputs['title'] ?? '')}}">
                @error('title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        @foreach($template->inputs as $input)
        <div class="card">
            <div class="card-header">
                {{ $input->name }}
                @if($input->public)
                <x-public-badge />
                @endif
                @if($input->is_required)
                <x-required-badge />
                @endif
            </div>
            <div class="card-body">
                {{ $input->description }}
                <div class="form-group">
                </div>
                @if($input->type == 'singleline')
                <input type="text" class="form-control @error('input-' . $input->id) is-invalid @enderror" name="input-{{ $input->id }}" value="{{ old('input-' . $input->id, $queryInputs['input-' . $input->id] ?? '') }}">
                @elseif($input->type == 'multiline')
                <textarea class="form-control @error('input-' . $input->id) is-invalid @enderror" name="input-{{ $input->id }}">{{ old('input-' . $input->id, $queryInputs['input-' . $input->id] ?? '') }}</textarea>
                @else
                error unknown
                @endif
                @error('input-'.$input->id)
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        @endforeach

        <input type="hidden" name="templateId" value="{{ $template->id }}">
        <div class="text-right">
            <button type="submit" class="btn btn-primary">投稿</button>
        </div>
    </form>
</div>    
@stop

