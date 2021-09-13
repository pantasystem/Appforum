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
                <a class="badge badge-info badge-pill p-2 m-1" href="#">{{$reactionCount->stamp->name}} {{$reactionCount->reactions->count()}}</a>
                @else
                <a class="badge badge-light badge-pill p-2 m-1" href="#">{{$reactionCount->stamp->name}} {{$reactionCount->reactions->count()}}</a>
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
        </div>
    </div>
</div>
</div>