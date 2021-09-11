@extends('adminlte::page')

@section('title', 'App作成')

@section('content_header')
    <h1>App作成</h1>
@stop

@section('content')
<div>
<form action="{{ route('apps.store', ['user' => $user ?? ''->id ]) }}" method="POST">
    @csrf
    <div class="card">
            <div class="card-header">
                App作成画面
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="Appname">Appタイトル</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>  
                    @enderror
                </div>
                <div class="form-group">
                    <label for="topic-template-description">Appの説明</label>
                    <textarea name="app-text" class="form-control @error('app-text') is-invalid @enderror" id="app-text">{{old('app-text')}}</textarea>
                    @error('text')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>  
                    @enderror
                </div>
                <div class="icon-pfoto">
                    <label for="photo-icon">アプリアイコン:</label>
                    <input type="file" class="form-control" name="icon-path" value="{{ old('icon-path')}}" class="@error('icon-path') is-invalid @enderror">
                    @error('icon-path')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="header-photo">
                    <label for="photo-header">ヘッダー画像:</label>
                    <input type="file" class="form-control" name="header_image_path" value="{{old('header_image_path')}}" class="@error('header_image_path') is-invalid @enderror">
                    @error('header_image_path')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>  
        </div>
</form>
@stop

@section('css')
    {{-- ページごとCSSの指定
    <link rel="stylesheet" href="/css/xxx.css">
    --}}
@stop

@section('js')
    <script> console.log('ページごとJSの記述'); </script>
@stop
