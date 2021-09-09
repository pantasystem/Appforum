<div>
    <form action="{{$action}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="card-title">
                    @if($text)
                    投稿を編集
                    @else
                    投稿を作成
                    @endif
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">投稿</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    @if($replyTo)
                    <input type="hidden" name="parentId" value="{{$parentId}}" />
                    @endif
                    <textarea name="text" class="form-control @error('text') is-invalid @enderror">{{old('text', $text)}}</textarea>
                    @error('text')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </form>
</div>