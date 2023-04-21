@props(['url','title', 'colorButton'])
<a href="{{ $url }}" class="{{$colorButton}}"
@if($attributes->has('target')) target="_blank" @endif>
    {{$title}}
</a>
