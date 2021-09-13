<div>
<img src="{{$app->header_image_path}}" class="position-relative w-100" style="height: 300px;">
<div class="row position-absolute" style="top: 280px;">
    <img src="{{$app->icon_path}}" class="img-rounded bg-white ml-4" width="150" height="150">
    <h1 class="mt-auto ml-3 mb-0">{{$app->name}}</h1>
</div>

<a href="{{ route('apps.topics.create', ['appId' => $app->id]) }}" class="btn btn-primary d-block mt-3 ml-auto mr-5 mb-5" style="width: 150px;">トピック作成</a>

</div>