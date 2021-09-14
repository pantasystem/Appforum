<div class="w-100 position-relative" style="background-image: url('{{$app->header_image_url}}'); background-position:center; background-size:cover; height:300px; margin-bottom:70px;">

    <div class="position-absolute row w-100" style="bottom:-60px;">
        <img src="{{$app->icon_url}}" class="img-rounded bg-white ml-4" style="width:150px; height:150px; object-fit:cover;">
        <h1 class="ml-3 mt-auto mb-0">{{$app->name}}</h1>
        <div class="ml-auto mt-auto">
            <a href="{{ route('apps.topics.create', ['appId' => $app->id]) }}" class="btn btn-primary ">トピック作成</a>
        </div>
    </div>

</div>