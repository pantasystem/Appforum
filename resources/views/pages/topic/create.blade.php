@extends('adminlte::page')

@section('title', 'トピック作成')

@section('content_header')
    <h1>トピック作成</h1>
@stop

@section('content')
<div>
    <form action="{{ route('apps.topics.store', ['appId' => $app->id ]) }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">トピックタイトル</div>
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
            <div class="card-header">{{ $input->name }}</div>
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

