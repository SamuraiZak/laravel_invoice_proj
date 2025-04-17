@props([])

<div @class(['card'])>
    {{ $slot }}
    <a href="{{ $attributes->get('href') }}" class="btn">View Details</a>
</div>
