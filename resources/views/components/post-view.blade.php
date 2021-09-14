<div>
<div class="card">
    <div class="card-header">
        {{ $post->username }}
    </div>
    <div class="card-body">
        <x-markdown :text="$post->text"/>
        <div>
            @foreach($post->reaction_counts as $reactionCount)
                @if($reactionCount->isReacted())
                <button class="reaction-counter reacted m-1 btn btn-info btn-sm" data-post-id="{{$post->id}}" data-stamp-id="{{$reactionCount->stamp->id}}">{{$reactionCount->stamp->name}} {{$reactionCount->reactions->count()}}</button>
                @else
                <button class="reaction-counter m-1 btn btn-light btn-sm" data-post-id="{{$post->id}}" data-stamp-id="{{$reactionCount->stamp->id}}">{{$reactionCount->stamp->name}} {{$reactionCount->reactions->count()}}</button>
                @endif
            @endforeach
        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-between">
            <div>
                <form action="{{ route('apps.topics.posts.index', ['appId' => $app->id, 'topicId' => $topic->id])}}">
                    <button class="btn btn-link" type="submit">
                        <input type="hidden" name="replyTo" value="{{$post->id}}">
                            <i class="fas fa-reply mr-1"></i>{{ $post->replies_count }}
                        </button>
                </form>
                        
            </div>
            <div>
                <button class="btn btn-link add-reaction-button" data-post-id="{{$post->id}}" data-app-id="{{$app->id}}" data-topic-id="{{$topic->id}}" data-selected-stamp-names="{{$post->selected_stamp_names}}">
                    <i class="far fa-grin-beam mr-1"></i>{{ $post->reactions->count() }}
                </button>
            </div>
        </div>
    </div>
</div>
</div>