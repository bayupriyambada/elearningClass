@props(['name', 'value', 'label', 'type'])

<div>
    <label for="{{ $name }}" class="form-label {{ $attributes->has('required') ? 'required' : '' }} {{ $attributes->has('readonly') ? 'readonly' : '' }}">{{ $label }}</label>
    <input autocomplete="off" type="{{$type}}" wire:model="{{ $name }}" id="{{ $attributes->get('id', '') }}" class="form-control {{ $attributes->get('class', '') }}" name="{{ $name }}"
    @if($attributes->has('required')) required @endif
    @if($attributes->has('readonly')) readonly @endif @if($attributes->has('disabled')) disabled @endif>
    @error('{{$name}}') <small class="form-hint">{{$message}}</small> @enderror

</div>
