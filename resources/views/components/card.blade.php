@props([])

<div @class(['card'])>
    {{ $slot }}
    <a href="{{ $attributes->get('href') }}" class="btn-green">View Details</a>
</div>
