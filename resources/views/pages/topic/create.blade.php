@extends('adminlte::page')

@section('title', 'トピック作成')

@section('content_header')
    <h1>トピック作成</h1>
@stop

@section('content')
<div>
    <form>
        @foreach($template->inputs as $input)
        <div class="card">
            <div class="card-header">{{ $input->name }}</div>
            <div class="card-body">
                {{ $input->description }}
                <div class="form-group">
                </div>
                @if($input->type == 'singleline')
                <input type="text" class="form-control">
                @elseif($input->type == 'multiline')
                <textarea class="form-control"></textarea>
                @else
                error unknown
                @endif
            </div>
            

        </div>
        @endforeach
        <div class="text-right">
            <button type="submit" class="btn btn-primary">投稿</button>
        </div>
    </form>
</div>    
@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('ページごとJSの記述'); </script>
@stop