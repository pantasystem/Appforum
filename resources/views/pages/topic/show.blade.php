@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <nav area-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('apps.index')}}">アプリ・サービス一覧</a></li>
            <li class="breadcrumb-item"><a href="{{route('apps.topic.index', ['app' => $app->id])}}">{{$app -> name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $topic->title }}</li>   
        </ol>
    </nav>
    
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
        <div class="post-view-{{$post->id}}">
            <x-post-view :post="$post" :app="$app" :topic="$topic"/>
        </div>
        @endforeach
    </div>

    <x-post-editor-form :topic="$topic"/>

    <div>
        <div class="modal fade" id="stampPickerModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        リアクション
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach($stamps as $stamp)
                        <button class="stamp-picker-stamp reaction-counter m-1 btn btn-light btn-sm" data-stamp-id="{{$stamp->id}}" data-stamp-name="{{$stamp->name}}">{{$stamp->name}}</button>
                        
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
const topicId = {{$topic->id}};
const appId = {{$app->id}};
const stampPickerStamps = document.getElementsByClassName('stamp-picker-stamp');

for(let i = 0; i < stampPickerStamps.length; i ++) {
    stampPickerStamps[i].addEventListener('click', (e)=>{
        $('#stampPickerModal').modal('hide');
    });
}

function setupReactionCounters(element) {
    const reactionCounters = element.getElementsByClassName('reaction-counter');

    for(let i = 0; i < reactionCounters.length; i ++) {
        const reactionCounter = reactionCounters[i];
        reactionCounter.addEventListener('click', onReactionClickedListener);
    }
}

function setupReactionButton(element) {
    const buttons = element.getElementsByClassName('add-reaction-button');
    
    for(let i = 0; i < buttons.length; i ++) {
        const button = buttons[i];
        button.addEventListener('click', (e)=>{
            const names = JSON.parse(e.target.getAttribute('data-selected-stamp-names') ?? '[]');
            console.log(names);
            for(let i = 0; i < stampPickerStamps.length; i ++) {
                const stampButton = stampPickerStamps[i];
                stampButton.setAttribute('data-post-id', e.target.getAttribute('data-post-id'));
                const isReacted = names.includes(stampButton.getAttribute('data-stamp-name'));
                if(isReacted) {
                    stampButton.classList.remove('btn-light');
                    stampButton.classList.add('btn-info');
                }else{
                    stampButton.classList.remove('btn-info');
                    stampButton.classList.add('btn-light');
                }
            }
            $('#stampPickerModal').modal('show');
        });
    }

}


const onReactionClickedListener = (e) => {
    const stampId = e.target.getAttribute('data-stamp-id');
    const postId = e.target.getAttribute('data-post-id');
    const path = `/apps/${appId}/topics/${topicId}/posts/${postId}/reactions`;
    const token = document.getElementsByName('csrf-token').item(0).content; 

    $.ajax({
        type: 'POST',
        url: path,
        data: {
            'stamp_id': stampId
        },
        headers: {
            'X-CSRF-TOKEN': token,
        }
    }).done((res)=>{
        //document.documentElement.innerHTML = res;
        const postElements = document.getElementsByClassName(`post-view-${postId}`);
        console.log(postElements);
        for(let i = 0; i < postElements.length; i ++) {
            postElements[i].innerHTML = res;
            setupReactionCounters(postElements[i]);
            setupReactionButton(postElements[i]);
        }
    });       
}

setupReactionCounters(document);
setupReactionButton(document);


</script>
@endsection