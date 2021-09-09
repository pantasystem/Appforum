<div class="form-check">   
    @if((boolean)$value)
    <input class="form-check-input" type="checkbox" value="1" name="{{$name}}" id="{{$id}}" checked="">
    @else
    <input class="form-check-input" type="checkbox" value="1" name="{{$name}}" id="{{$id}}">
    @endif

    <label class="form-check-label" for="{{$id}}">
        {{ $slot }}
    </label>
</div>