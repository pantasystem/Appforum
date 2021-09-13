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

</div>
@stop
@section('js')
<script>
const topicId = {{$topic->id}};
const appId = {{$app->id}};

function setupReactionCounters(element) {
    const reactionCounters = element.getElementsByClassName('reaction-counter');

    for(let i = 0; i < reactionCounters.length; i ++) {
        const reactionCounter = reactionCounters[i];
        reactionCounter.addEventListener('click', onReactionClickedListener);
    }
}

const onReactionClickedListener = function(e) {
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
        }
    });       
}

setupReactionCounters(document);



</script>
@endsection