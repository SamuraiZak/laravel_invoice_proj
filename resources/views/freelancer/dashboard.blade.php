<x-layout>
    <h2>All Clients</h2>

    <ul>
        @foreach ($freelancers as $freelancer)
            <li>
                <x-card
                    href="{{ route('ninjas.show', $ninja->id) }}"
                >
                    <div>
                        <h3>{{ $client->name }}</h3>
                        <p>{{ $client->dojo->name }}</p>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>

    {{ $ninjas->links() }}
</x-layout>