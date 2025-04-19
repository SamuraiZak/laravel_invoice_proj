<x-layout>

    <div class="flex flex-row items-center justify-between gap-x-4 bg-white p-6 rounded shadow max-w-4xl">
        <h2>Client Name: {{ $client->name }}</h2>

        <div class="flex gap-x-8">
            <button class="btn-green">Add a project</button>
            <button class="btn">Delete Client</button>
        </div>

    </div>

    <div class="border-2 border-dashed bg-white px-4 pb-4 my-4 rounded">
        <div class="flex flex-row justify-between">
            <h3>Client Information</h3>
             <button class="btn-green mt-4">Edit </button>
        </div>

        <p><strong>Email: </strong>{{ $client->email }}</p>
        <p><strong>phone: </strong>{{ $client->phone }}</p>
        <p><strong>Company: </strong>{{ $client->company }}</p>
        <p><strong>Address: </strong>{{ $client->address }}</p>
    </div>

    <h2>Ongoing Projects</h2>

    <ul>
        @foreach ($projects as $project)
            <li>
                <x-card href="{{ route('show.project', $project->id) }}">
                    <div>
                        <h3>{{ $project->name }}</h3>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>

</x-layout>
