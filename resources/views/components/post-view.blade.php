<div>
<div class="card">
    <div class="card-header">
        {{ $post->username }}
    </div>
    <div class="card-body">
        <x-markdown :text="$post->text"/>
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