<div>
<img src="{{$app->header_image_url}}" class="position-relative w-100" style="height: 300px;">
<div class="row position-absolute" style="top: 280px;">
    <img src="{{$app->icon_url}}" class="img-rounded bg-white ml-4" width="150" height="150">
    <h1 class="mt-auto ml-3 mb-0">{{$app->name}}</h1>
</div>

<div class="w-100" style="margin-bottom: 80px;">
    <a href="{{ route('apps.topics.create', ['appId' => $app->id]) }}" class="btn btn-primary mt-3 mr-5 float-right">トピック作成</a>
</div>

</div>