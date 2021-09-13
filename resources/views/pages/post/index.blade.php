@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>スレッド一覧</h1>
@stop

@section('content')
<div>
    <div class="post-view-{{$replyTo->id}}">
        <x-post-view :post="$replyTo" :topic="$topic" :app="$app"/>
    </div>
    <div class="pl-5">
        @foreach($replies as $reply)
            <div class="post-view-{{$reply->id}}">
            <x-post-view :post="$reply" :topic="$topic" :app="$app" />
            </div>
        @endforeach
        <x-post-editor-form :replyTo="$replyTo" :topic="$topic"/>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
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
@stop