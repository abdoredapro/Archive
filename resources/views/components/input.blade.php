@props([
    'placeholder' => '',
    'type' => 'text',
    
])

<input type="{{ $type }}" name="{{$name}}" value="{{ old($name) }}" placeholder="{{$placeholder}}" style="border: 1px solid #ccc">
