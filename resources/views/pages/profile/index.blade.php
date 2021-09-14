@extends('adminlte::page')

@section('title', 'プロフィール')

@section('content_header')
    <h1>プロフィール</h1>
@stop

@section('content')

    <div class="row: 100px;" style="top: 280px;">
        <img src="{{$user->avatar_url}}" class="img-rounded bg-white ml-4" width="150" height="150">
    </div>

    <div style="margin-top: 30px;">
        <table class="table table-striped">  
            <tr>
            <th>氏名</th>
            <td>{{$user->username}}</td>
            </tr>  
            <tr>
            <th>メールアドレス</th>
            <td>{{$user->email}}</td>
            </tr>  
            <tr>
            <th>作成日</th>
            <td>{{$user->updated_at}}</td>
            </tr>
        </table>
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