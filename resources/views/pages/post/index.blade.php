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

@section('css')
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