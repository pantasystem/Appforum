@extends('adminlte::page')

@section('title', 'アプリ・サービス一覧')

@section('content_header')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">アプリ一覧</a></li>
    <li class="breadcrumb-item"><a href="{{route('apps.topic-templates.create', ['appId' => $app->id])}}">{{ $app->name}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('apps.topic-templates.index', ['appId' => $app->id ])}}">トピックテンプレート一覧</a></li>
    <li class="breadcrumb-item active" aria-current="page">トピックテンプレート作成</li>
  </ol>
</nav>
@stop

@section('content')
<div clsas="topic-templates.edit.form">
    <form method="POST" action="{{ route('apps.topic-templates.store', ['appId' => $app->id])}}">
        @csrf
        <div class="card">
            <div class="card-header">
                テンプレート名
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="topic-template-name">テンプレート名</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="topic-template-name" value="{{old('name')}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>  
                    @enderror
                </div>
                <div class="form-group">
                    <label for="topic-template-description">テンプレートの説明</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="topic-template-description">{{old('description')}}</textarea>
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>  
                    @enderror
                </div>
                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
            
        </div>
    </form>
 
</div>
@stop

@section('css')
    {{-- ページごとCSSの指定
    <link rel="stylesheet" href="/css/xxx.css">
    --}}
@stop

@section('js')
    <script>
        const addButtons = document.getElementsByClassName('topic-templates-add-input');

        //const forms = document.getElementsByClassName('topic-templates-inputs');
        const formBase = document.getElementsByClassName('topic-templates-input-forms');

        const createInput = (attributes) => {
            const el = document.createElement('input');
            el.id = attributes.id;
            el.class = 'form-control';
            el.type = 'text';
            return el;
        }

        const addInputForm = (index) => {
            const formDiv = document.createElement('div');
            formDiv.className = 'card';

            const header = document.createElement('div');
            header.className = 'card-header';
            header.appendChild(
                createInput({
                    id: `topic-templates-input-${index}-name`
                }),
            );
            formDiv.appendChild(
                header
            );


            const cardBody = document.createElement('div');


            for(let i = 0; i < formBase.length; i ++) {
                
                formBase[i].appendChild(formDiv);
            }
            //formDiv.appendChild()
        }
        
        for(let i = 0; i < addButtons.length; i ++) {
            addButtons[i].addEventListener('click', e=> {
                console.log(e);
                addInputForm();
            });
        }
    </script>
@stop